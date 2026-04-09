/**
 * Rythm Global Application Scripts
 */

$(document).ready(function() {
    console.log("Rythm Application Initialized");
});

/**
 * Sidebar Toggle Logic - Using Class-based approach
 */
function openSidebar() {
    $("#secondarySidebar").addClass("active");
}

function closeSidebar() {
    $("#secondarySidebar").removeClass("active");
}

function thirdddddopenSidebar() {
    $("#thirdsidebarddd").addClass("active");
}

function thirdclssidebr() {
    $("#thirdsidebarddd").removeClass("active");
}

/**
 * Common Logic for all pages
 */
function logout() {
    window.location.href = '/rythm/login/login.php';
}
