/**
 * Rythm UI Helper Logic
 */

$(document).ready(function() {
    // Dynamic Height Adjustments
    adjustMainHeight();
    $(window).resize(adjustMainHeight);
});

/**
 * Ensure main content area always fills the screen properly
 */
function adjustMainHeight() {
    const vh = window.innerHeight;
    const headerH = $('.navbar').outerHeight();
    const footerH = $('.footer').outerHeight();
    $('.main-content').css('min-height', vh - headerH - footerH);
}

/**
 * Modal & Overlay Management
 */
function showModal(id) {
    const modal = new bootstrap.Modal(document.getElementById(id));
    modal.show();
}

/**
 * Handle Animation Triggers
 */
function triggerFadeIn(selector) {
    $(selector).hide().fadeIn(400);
}
