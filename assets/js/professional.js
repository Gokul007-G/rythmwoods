/**
 * Rythm Professional Module Bridge
 * Loads legacy modules into the modern 3-column UI
 */

function loadProfessionalModule(url, element) {
    // Determine the content container
    const container = $('.main-content').length ? $('.main-content') : $('#centerconteid');
    
    if (!container.length) {
        window.location.href = url;
        return;
    }

    // Sidebar Highlighting Logic
    if (element) {
        $('.sidebar ul li').removeClass('active-pro');
        $(element).closest('li').addClass('active-pro');
    }

    // Show loading state
    container.html('<div class="d-flex justify-content-center p-5"><div class="spinner-border text-pink"></div></div>');

    $.ajax({
        url: url,
        type: 'POST',
        success: function(response) {
            container.html(response);
            // Hide right panel for professional modules to provide full width for tables
            $('.right-panel').hide();
        },
        error: function() {
            container.html('<div class="alert alert-danger mx-4 mt-4">Failed to load professional module.</div>');
        }
    });
}

function showdirectors(el) {
    loadProfessionalModule('/rythm/professional_singer/music_directors/showdirectors.php', el);
}

function showlanguage(el) {
    loadProfessionalModule('/rythm/professional_singer/language/language_shows.php', el);
}

function showmusic(el) {
    loadProfessionalModule('/rythm/professional_singer/music/music_view.php', el);
}

function showevent(el) {
    loadProfessionalModule('/rythm/professional_singer/addevent.php', el);
}

function showeventlist(el) {
    loadProfessionalModule('/rythm/professional_singer/calendar/calendar_form.php', el);
}

function viewEventDetails(id) {
    console.log("Viewing event details:", id);
    loadProfessionalModule('/rythm/eventdetailsshow.php?id=' + id);
}

function addsongs(id) {
    console.log("Opening song management for:", id);
    loadProfessionalModule('/rythm/addsongsconcept.php?id=' + id);
}

function editEvent(id) {
    console.log("Editing event:", id);
    $.ajax({
        type: "POST",
        url: "/rythm/edit_event_modal.php",
        data: { id: id },
        success: function(data) {
            $('body').append(data);
            var editModal = new bootstrap.Modal(document.getElementById('editEventModal'));
            editModal.show();
            document.getElementById('editEventModal').addEventListener('hidden.bs.modal', function() {
                this.remove();
            });
        },
        error: function(xhr, status, error) {
            console.error("Edit modal error:", error);
        }
    });
}

function deleteEvent(id) {
    console.log("Requested deletion for:", id);
    if (confirm("Are you sure you want to delete this event?")) {
        $.ajax({
            type: "POST",
            url: "/rythm/delete_event.php",
            data: { id: id },
            success: function(response) {
                if (response == "1") {
                    alert("Event deleted successfully.");
                    // Refresh the current module (Event List)
                    showevent();
                } else {
                    alert("Failed to delete event. Response: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert("Error deleting event: " + error);
            }
        });
    }
}

// Map to window for absolute global access
window.viewEventDetails = viewEventDetails;
window.addsongs = addsongs;
window.editEvent = editEvent;
window.deleteEvent = deleteEvent;

window.updateEvent = function(e) {
    e.preventDefault();
    const formData = $('#editEventForm').serialize();
    $.ajax({
        type: "POST",
        url: "/rythm/update_event.php",
        data: formData,
        success: function(response) {
            // Check for success string or response
            alert("Event updated successfully!");
            // Hide the modal
            var modalEl = document.getElementById('editEventModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
            
            // Refresh the current module (Event List)
            showevent();
        },
        error: function() {
            alert("Failed to update event.");
        }
    });
};
