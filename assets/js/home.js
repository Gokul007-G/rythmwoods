/**
 * Rythm Home Page Scripts
 */

$(document).ready(function() {
    // EmojiArea Initialization
    if ($(".emoji_act").length) {
        $(".emoji_act").emojioneArea({
            emojiPlaceholder: ":smile_cat:",
            searchPlaceholder: "Search",
            buttonTitle: "Use your TAB key to insert emoji faster",
            searchPosition: "bottom",
            pickerPosition: "bottom"
        });
    }
});

/**
 * Search and Content Updates
 */
function updateCenterContent(val) {
    if (val.trim() !== "") {
        $.ajax({
            url: 'search_results.php',
            type: 'POST',
            data: { searchTerm: val },
            success: function(response) {
                $("#centerconteid").html(response);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    } else {
        $.ajax({
            url: 'center_content_two.php',
            type: 'GET',
            success: function(response) {
                $("#centerconteid").html(response);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }
}

function logout() {
    window.location.href = '/rythm/login/login.php';
}

function usernamegetsearchicon() {
    var inputid = $("#form1").val();
    if (inputid != '') {
        $.ajax({
            url: 'getameinsreach.php',
            type: 'POST',
            data: { namekey: inputid },
            success: function(getidnameinsearch) {
                if (getidnameinsearch != '') {
                    $("#sreachenamedisplay").html(getidnameinsearch).show();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        });
    } else {
        $("#sreachenamedisplay").hide();
    }
}

function usernameget(val) {
    if (val != '') {
        $.ajax({
            url: 'getameinsreach.php',
            type: 'POST',
            data: { namekey: val },
            success: function(getidnameinsearch) {
                if (getidnameinsearch != '') {
                    $("#sreachenamedisplay").html(getidnameinsearch).show();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        });
    }
}

/**
 * Following / Unfollowing Logic
 */
function followeingload(dyidgett, useriddd) {
    var $btn = $("#sugessfollobtn_" + dyidgett);
    if ($btn.text().trim() === 'Following') {
        showPopupCard(dyidgett, useriddd);
        return;
    }
    $btn.html('<img src="/rythm/assets/images/loadinggif.gif" alt="Loading..." style="height:50px;width:50px;">').prop('disabled', true);
    
    setTimeout(function() {
        $.ajax({
            type: 'POST',
            url: 'followingsts.php',
            data: { followingsts: 1, user_id: useriddd },
            success: function(gotresponse) {
                if (gotresponse == 1) {
                    $btn.text('Following').css('color', 'gray');
                    $btn.one('click', function() { showPopupCard(dyidgett, useriddd); });
                } else {
                    $btn.text('Follow').css('color', 'blue');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
                $btn.text('Follow');
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    }, 1500);
}

function showPopupCard(dyidgett, useriddd) {
    $("#dyiiidesett").val(dyidgett);
    $("#useridsetinto").val(useriddd);

    var popupHtml = '<div id="afterfollowingpopcard" class="afterfollowpop" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 10000;">' +
        '<div class="afterfollowpop-content" style="background: white; padding: 20px; border-radius: 17px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 400px; text-align: center;">' +
        '<img src="/rythm/assets/images/rsz_logo2.png" style="height:50px;width:50px;border-radius:50%;"><br><br>' +
        '<label id="usernamedisply" style="font-size:18px; font-weight: bold;"></label><br><hr>' +
        '<label onclick="unfollowfunc(' + dyidgett + ',' + useriddd + ')" style="color:red; font-size:18px; cursor: pointer; display: block; padding: 10px;">Unfollow</label><hr>' +
        '<label onclick="closePopupfollowing()" style="color:black; font-size:18px; cursor: pointer; display: block; padding: 10px;">Cancel</label>' +
        '</div>' +
        '</div>';

    $('body').append(popupHtml);
    $('#afterfollowingpopcard').show();

    $.ajax({
        url: 'fetche_following_name.php',
        type: 'POST',
        data: { userid: useriddd },
        success: function(getusername) {
            $("#usernamedisply").text("Unfollow @ " + getusername);
        }
    });
}

function closePopupfollowing() {
    $('#afterfollowingpopcard').remove();
}

function unfollowfunc(dyidgett, useriddd) {
    $('#afterfollowingpopcard').remove();
    var $btn = $("#sugessfollobtn_" + dyidgett);
    $btn.html('<img src="/rythm/assets/images/loadinggif.gif" alt="Loading..." style="height:50px;width:50px;">');

    setTimeout(function() {
        $.ajax({
            url: 'unfollowdet.php',
            type: 'POST',
            data: { userid: useriddd },
            success: function(unflowwww) {
                if (unflowwww == 1) {
                    $btn.text('Follow').css('color', 'blue');
                } else {
                    $btn.text('Following').css('color', 'gray');
                }
            }
        });
    }, 1000);
}

/**
 * Sidebar and UI Control
 */
function homesidebar() {
    window.location.href = '/rythm/home.php';
}

function openSidebar() {
    document.getElementById("secondarySidebar").classList.add("active");
}

function closeSidebar() {
    document.getElementById("secondarySidebar").classList.remove("active");
}

function thirdddddopenSidebar() {
    document.getElementById("thirdsidebarddd").classList.add("active");
}

function thirdclssidebr() {
    document.getElementById("thirdsidebarddd").classList.remove("active");
}

/**
 * Page Navigation via AJAX
 */
function showprofile() {
    $.ajax({
        type: "POST",
        url: "profiledetails.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function reeelss() {
    $.ajax({
        url: 'reels.php',
        type: 'POST',
        success: function(explodreer) {
            $('#centerconteid').html(explodreer);
        }
    });
}

function messages() {
    $.ajax({
        type: "POST",
        url: "message.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function showaccoun(id) {
    $.ajax({
        type: "POST",
        url: "account_details.php?id=" + id,
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function showdirectors() {
    $.ajax({
        type: "POST",
        url: "/rythm/professional_singer/music_directors/showdirectors.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function createpost() {
    $.ajax({
        url: 'postercreation.php',
        type: 'POST',
        success: function(explodreer) {
            $('#centerconteid').html(explodreer);
        }
    });
}

function showmusic() {
    $.ajax({
        type: "POST",
        url: "/rythm/professional_singer/music/music_view.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function showlanguage() {
    $.ajax({
        type: "POST",
        url: "/rythm/professional_singer/language/language_shows.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function showevent() {
    $.ajax({
        type: "POST",
        url: "/rythm/professional_singer/addevent.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function showeventlist() {
    $.ajax({
        type: "POST",
        url: "/rythm/professional_singer/calendar/calendar_form.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

function showprof() {
    $.ajax({
        type: "POST",
        url: "/rythm/profile_verification.php",
        success: function(data) {
            $("#centerconteid").html(data);
        }
    });
}

/**
 * Global Fallback for Song Addition
 */
window.addsongs = function(id) {
    $.ajax({
        type: "POST",
        url: "/rythm/addsongsconcept.php?id=" + id,
        success: function(data) {
            const container = $('.main-content').length ? $('.main-content') : $('#centerconteid');
            container.html(data);
            if ($('.right-panel').length) $('.right-panel').hide();
        }
    });
};

