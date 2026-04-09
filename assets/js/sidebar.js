/**
 * Rythm Sidebar Interaction Logic
 */

$(document).ready(function() {
    // Menu Activation Logic (if not handled by PHP)
    const currentPath = window.location.pathname;
    $('.sidebar .nav-link').each(function() {
        if ($(this).attr('href').includes(currentPath)) {
            $(this).addClass('active');
        }
    });

    // Sidebar Toggling for Mobile (if needed)
    // Custom logic can be added here
});

/**
 * Navigation Shortcut Handlers (AJAX or Redirects)
 * Handled via professional.js or location.href
 */
