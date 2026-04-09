/**
 * Rythm Reels Page Scripts
 */

let isLiked = false;

function toggleLike(dyyid) {
    isLiked = !isLiked;
    var likeIcon = document.getElementById('likeIcon_' + dyyid);
    var postimgvideoid = document.getElementById('postimgvideoid' + dyyid).value;

    if (isLiked) {
        likeIcon.src = "/rythm/assets/images/likeredhreat.png";
        likeIcon.style.filter = "brightness(1.2)";
        updateLikeStatus(postimgvideoid, 1, dyyid);
    } else {
        likeIcon.src = "/rythm/assets/images/likeheart.png";
        likeIcon.style.filter = "brightness(1)";
        updateLikeStatus(postimgvideoid, 0, dyyid);
    }
}

function updateLikeStatus(postId, likeStatus, dyyid) {
    $.ajax({
        type: 'POST',
        url: 'updatelikests.php',
        data: {
            post_id: postId,
            like_status: likeStatus
        },
        success: function(dta) {
            document.getElementById('likelbelidd_' + dyyid).innerText = dta;
        }
    });
}

function messagepopup(id, dyn) {
    document.getElementById('popup-container_' + dyn).style.display = 'block';
    
    $.ajax({
        type: 'POST',
        url: 'messagecontent.php',
        data: { post_id: id },
        dataType: 'json',
        success: function(response) {
            var messagePopupContent = document.querySelector('.messagepopup-img' + dyn);
            if (!messagePopupContent) return;
            
            messagePopupContent.innerHTML = '';
            
            if (response.postType === 'image') {
                var img = document.createElement('img');
                img.src = response.content;
                img.classList.add('popup-media');
                messagePopupContent.appendChild(img);
            } else if (response.postType === 'video') {
                var video = document.createElement('video');
                video.controls = true;
                video.classList.add('popup-media');
                video.style.background = 'black';
                var source = document.createElement('source');
                source.src = response.content;
                source.type = 'video/mp4';
                video.appendChild(source);
                messagePopupContent.appendChild(video);
            }
        }
    });
    centerPopup(dyn);
}

function messageclosePopup(dyn) {
    document.getElementById('popup-container_' + dyn).style.display = 'none';
}

function centerPopup(dyn) {
    var popup = document.getElementById('popup-container_' + dyn);
    var left = (window.innerWidth - popup.offsetWidth) / 2;
    var top = (window.innerHeight - popup.offsetHeight) / 2;
    popup.style.left = left + 'px';
    popup.style.top = top + 'px';
}

function sharePost(dyn) {
    document.getElementById('popup-sharePostcontainer_' + dyn).style.display = 'block';
}

function shareclosePopup(dyn) {
    document.getElementById('popup-sharePostcontainer_' + dyn).style.display = 'none';
}

function savedpost(dynmic) {
    var icon = document.getElementById('savebtnicon_' + dynmic);
    var id = document.getElementById('postimgvideoid' + dynmic).value;
    var path = document.getElementById('posterspath' + dynmic).value;
    var saveStatus = (icon.src.includes('savedpost.png')) ? 0 : 1;

    icon.src = (saveStatus === 1) ? "/rythm/assets/images/savedpost.png" : "/rythm/assets/images/bookmark.png";
    
    $.ajax({
        type: 'POST',
        url: 'updateposters_saved.php',
        data: { post_id: id, save_status: saveStatus, posters_path: path },
        success: function(resp) {
            alert(resp == 1 ? 'Post saved!' : 'Post updated!');
        }
    });
}


// 🔥 Autoplay Logic with IntersectionObserver
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.6 // 60% of video must be visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target;
            if (entry.isIntersecting) {
                video.play().catch(error => {
                    console.log("Autoplay prevented: ", error);
                });
            } else {
                video.pause();
            }
        });
    }, observerOptions);

    // Observe all reel videos
    document.querySelectorAll('.reel-box video').forEach(video => {
        observer.observe(video);
    });
});

// 🔊 Sound Toggle function (reused from home)
function toggleSound(event, videoId, btn) {
    event.stopPropagation();
    const video = document.getElementById(videoId);
    const icon = btn.querySelector("i");

    video.muted = !video.muted;

    if (video.muted) {
        icon.classList.remove("fa-volume-high");
        icon.classList.add("fa-volume-xmark");
        showMuteOverlay(video.parentElement, "Muted");
    } else {
        icon.classList.remove("fa-volume-xmark");
        icon.classList.add("fa-volume-high");
        showMuteOverlay(video.parentElement, "Unmuted");
    }
}

function showMuteOverlay(container, text) {
    let existing = container.querySelectorAll(".mute-overlay");
    existing.forEach(el => el.remove());

    let overlay = document.createElement("div");
    overlay.className = "mute-overlay";
    overlay.innerText = text;
    container.appendChild(overlay);
    
    setTimeout(() => {
        overlay.classList.add("fade-out");
        setTimeout(() => overlay.remove(), 400);
    }, 800);
}
