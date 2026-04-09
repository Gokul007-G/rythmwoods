/**
 * Rythm Event Page JS
 */
function searchEvents() {
    const input = document.getElementById('searchTitle');
    const filter = input.value.toUpperCase();
    const table = document.querySelector('.event-table');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) { // Skip header
        const td = tr[i].getElementsByTagName('td')[3]; // Title column
        if (td) {
            const txtValue = td.textContent || td.innerText;
            tr[i].style.display = txtValue.toUpperCase().includes(filter) ? "" : "none";
        }
    }
}

// Action Handlers
function editEvent(id) {
    console.log('Editing event:', id);
    // Ajax load or redirect
}

function deleteEvent(id, title) {
    if (confirm(`Are you sure you want to delete event: ${title}?`)) {
        window.location.href = `deleteold.php?id=${id}`;
    }
}

function viewEventDetails(id) {
    console.log('Viewing event details:', id);
    // Ajax load
}
