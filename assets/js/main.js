/**
 * Rythm Global Application Logic
 */

$(document).ready(function() {
    console.log("Rythm Application Initialized");
    
    // Initialize tooltips/popovers if needed
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

/**
 * Handle Logout
 */
function logout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "/rythm/pages/logout.php";
    }
}

/**
 * Global Search Functionality
 */
function updateCenterContent(query) {
    if (query.length < 2) return;
    
    console.log("Searching for:", query);
    // Future: AJAX call to search_results.php
}

/**
 * Helper: Smooth Scroll to Top
 */
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
