/**
 * Rythm Profile Page JS
 */
function showSection(sectionId) {
    const sections = ['posts', 'reels', 'saved'];
    sections.forEach(s => {
        const el = document.getElementById(s);
        if (el) el.style.display = (s === sectionId) ? 'grid' : 'none';
        
        const btn = document.getElementById(s + '-tab');
        if (btn) btn.classList.toggle('active', s === sectionId);
    });
}

function openPostModal(postId) {
    console.log('Opening post:', postId);
    // Modal logic here
}
