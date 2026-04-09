<?php
/**
 * Rythm Reels - Unified Professional Version
 */
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$pageTitle = "Rythm - Reels";
$extraCSS = "/rythm/assets/css/reels.css";
$extraJS = "/rythm/assets/js/reels.js";
include("includes/header.php");
?>

<div class="reels-container d-flex flex-column align-items-center gap-5 py-4">
    <?php
    try {
        $sql = $con->query("SELECT * FROM `posters` WHERE status = '1' AND post_type = 'video' ORDER BY id DESC");
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $data['id'];
            $postvideos = $data['postvideos'];
            $vid_src = (strpos($postvideos, '/') === 0 || strpos($postvideos, 'http') === 0) ? $postvideos : "/rythm/$postvideos";
    ?>
    
    <!-- Reel Item -->
    <div class="reel-box shadow-lg rounded-4 overflow-hidden position-relative bg-black" 
         style="width: 100%; max-width: 450px; aspect-ratio: 9/16; height: 85vh;">
        
        <video id="reel_video_<?php echo $post_id; ?>" class="w-100 h-100" style="object-fit: cover;" loop muted playsinline onclick="this.paused ? this.play() : this.pause();">
            <source src="<?php echo $vid_src; ?>" type="video/mp4">
        </video>

        <!-- 🔊 PREMIUM SOUND BUTTON -->
        <button class="mute-btn" 
                onclick="toggleSound(event, 'reel_video_<?php echo $post_id; ?>', this)">
            <i class="fa-solid fa-volume-xmark"></i>
        </button>

        <!-- Reel Overlay -->
        <div class="position-absolute bottom-0 start-0 p-4 w-100 text-white" 
             style="background: linear-gradient(transparent, rgba(0,0,0,0.9));">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="/rythm/assets/images/lion.png" alt="User" class="rounded-circle border border-2 border-white" style="width: 40px; height: 40px; object-fit: cover;">
                <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($data['username']); ?></h6>
                <button class="btn btn-outline-light btn-sm rounded-pill px-3 py-0">Follow</button>
            </div>
            <p class="small mb-0 opacity-85"><?php echo htmlspecialchars($data['posters_caption']); ?></p>
        </div>

        <!-- Reel Actions -->
        <div class="position-absolute bottom-0 end-0 p-4 d-flex flex-column gap-4 align-items-center mb-5 pb-5">
            <div class="text-center text-white">
                <button class="btn btn-dark rounded-circle shadow border-0 mb-1 toggle-like" 
                        data-id="<?php echo $post_id; ?>" 
                        style="width: 45px; height: 45px; background: rgba(0,0,0,0.5);">
                    <i class="fa-regular fa-heart fs-4"></i>
                </button>
                <?php
                $like_stmt = $con->prepare("SELECT SUM(likestatus) FROM `posters` WHERE id=?");
                $like_stmt->execute([$post_id]);
                $likecount = intval($like_stmt->fetchColumn() ?? 0);
                ?>
                <small class="d-block fw-bold" id="like-count-<?php echo $post_id; ?>"><?php echo $likecount; ?></small>
            </div>
            <div class="text-center text-white">
                <button class="btn btn-dark rounded-circle shadow border-0 mb-1" 
                        onclick="openCommentModal(<?php echo $post_id; ?>, <?php echo $post_id; ?>)"
                        style="width: 45px; height: 45px; background: rgba(0,0,0,0.5);">
                    <i class="fa fa-comment fs-4"></i>
                </button>
                <small class="d-block fw-bold">Comments</small>
            </div>
            <div class="text-center text-white">
                <button class="btn btn-dark rounded-circle shadow border-0 mb-1" 
                        onclick="sharePost(<?php echo $post_id; ?>)"
                        style="width: 45px; height: 45px; background: rgba(0,0,0,0.5);">
                    <i class="fa fa-paper-plane fs-4"></i>
                </button>
            </div>
            <div class="text-center text-white">
                <button class="btn btn-dark rounded-circle shadow border-0 mb-1" 
                        onclick="showReelOptions(<?php echo $post_id; ?>)"
                        style="width: 45px; height: 45px; background: rgba(0,0,0,0.5);">
                    <i class="fa fa-ellipsis-v fs-4"></i>
                </button>
            </div>
        </div>
    </div>

    <?php 
        }
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Error loading reels.</div>";
    }
    ?>
</div>

<!-- Social Modals (Reused from Home) -->
<div id="commentModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content overflow-hidden border-0 rounded-4" style="height: 80vh;">
            <div class="row g-0 h-100">
                <div class="col-md-7 bg-black d-flex align-items-center justify-content-center h-100">
                    <div id="modalMediaContainer" class="w-100 h-100 d-flex align-items-center justify-content-center"></div>
                </div>
                <div class="col-md-5 h-100 d-flex flex-column bg-white">
                    <div class="modal-header border-bottom p-3">
                        <div class="d-flex align-items-center gap-2">
                            <img id="modalUserImg" src="" alt="User" class="rounded-circle border" style="width: 35px; height: 35px; object-fit: cover;">
                            <h6 class="modal-title fw-bold" id="modalUsername">Username</h6>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body flex-grow-1 overflow-auto p-3" id="modalCommentsList"></div>
                    <div class="modal-footer border-top p-2 bg-white sticky-bottom">
                        <div class="w-100 d-flex gap-2 align-items-center">
                            <input type="text" id="commentInput" class="form-control rounded-pill border-0 bg-light px-3" placeholder="Add a comment...">
                            <button class="btn btn-link text-primary fw-bold text-decoration-none" id="postCommentBtn">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Share Modal -->
<div id="shareModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-bottom">
                <h6 class="modal-title fw-bold">Share Reel</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="px-3 py-2 border-bottom">
                    <input type="text" id="userSearch" class="form-control border-0 shadow-none px-0" placeholder="Search followers...">
                </div>
                <div class="user-list overflow-auto px-3 py-2" style="max-height: 300px;" id="shareUserList">
                    <?php
                    $rolemaster_id = $_SESSION['rolemaster_id'];
                    $stmt = $con->prepare("SELECT * FROM user_master WHERE role_master_id != ?");
                    $stmt->execute([$rolemaster_id]);
                    while($u = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo !empty($u['profile_img']) ? $u['profile_img'] : '/rythm/assets/images/lion.png'; ?>" class="rounded-circle border" style="width: 35px; height: 35px; object-fit: cover;">
                            <span class="small fw-bold"><?php echo htmlspecialchars($u['user_name']); ?></span>
                        </div>
                        <input type="checkbox" class="share-user-check form-check-input" value="<?php echo $u['role_master_id']; ?>">
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="px-3 py-2 border-top">
                    <textarea id="shareComment" class="form-control border-0 bg-light rounded-3 small" placeholder="Write a message..." rows="2"></textarea>
                </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-3">
                <button class="btn btn-pink w-100 rounded-pill fw-bold" id="confirmShareBtn">Send</button>
            </div>
        </div>
    </div>
</div>

<!-- Reel Options Modal -->
<div id="reelOptionsModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="list-group list-group-flush text-center">
                <button class="list-group-item list-group-item-action text-danger fw-bold py-3" onclick="reportPost()">Report</button>
                <button class="list-group-item list-group-item-action fw-bold py-3" onclick="savePost()">Save</button>
                <button class="list-group-item list-group-item-action text-danger fw-bold py-3 border-top" onclick="blockUser()">Block</button>
                <button class="list-group-item list-group-item-action py-3" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let currentPostId = null;
    let shareModal = null;

    $(document).ready(function() {
        if(document.getElementById('shareModal')) {
            shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
        }
    });

    function openCommentModal(postId, dynId) {
        currentPostId = postId;
        const modalEl = document.getElementById('commentModal');
        const modal = new bootstrap.Modal(modalEl);
        
        $.post('/rythm/messagecontent.php', { post_id: postId }, function(response) {
            const data = JSON.parse(response);
            $('#modalUsername').text(data.username || "User");
            $('#modalUserImg').attr('src', data.profileImg || "/rythm/assets/images/lion.png");
            
            if (data.postType === 'image') {
                $('#modalMediaContainer').html(`<img src="${data.content}" class="img-fluid w-100 h-100" style="object-fit: contain;">`);
            } else {
                $('#modalMediaContainer').html(`<video controls class="w-100 h-100" style="object-fit: contain;"><source src="${data.content}" type="video/mp4"></video>`);
            }
            
            fetchComments(postId);
            modal.show();
        });
    }

    function fetchComments(postId) {
        $.post('/rythm/getcomments.php', { post_id: postId }, function(response) {
            $('#modalCommentsList').html(response);
        });
    }

    $('#postCommentBtn').click(function() {
        const comment = $('#commentInput').val();
        if(!comment) return;
        
        const alldata = currentPostId + "**" + "<?php echo $_SESSION['users_id']; ?>" + "**" + comment;
        $.post('/rythm/commandsinsert.php', { alldata: alldata }, function(res) {
            if(res == 1) {
                $('#commentInput').val('');
                fetchComments(currentPostId);
            }
        });
    });

    $('.toggle-like').click(function() {
        const id = $(this).data('id');
        const button = $(this);
        const icon = button.find('i');
        const isLiked = icon.hasClass('fa-solid');
        const status = isLiked ? 0 : 1;

        $.post('/rythm/updatelikests.php', { post_id: id, like_status: status }, function(response) {
            $(`#like-count-${id}`).text(response.replace('likes', ''));
            if(status === 1) {
                icon.removeClass('fa-regular').addClass('fa-solid').css('color', 'var(--rythm-deep-pink)');
            } else {
                icon.removeClass('fa-solid').addClass('fa-regular').css('color', 'white');
            }
        });
    });

    function sharePost(postId) {
        currentPostId = postId;
        $('.share-user-check').prop('checked', false);
        $('#shareComment').val('');
        shareModal.show();
    }

    $('#confirmShareBtn').click(function() {
        let selectedIds = [];
        $('.share-user-check:checked').each(function() {
            selectedIds.push($(this).val());
        });
        
        if(selectedIds.length === 0) {
            alert("Please select at least one recipient.");
            return;
        }
        
        const message = $('#shareComment').val();
        $.post('/rythm/messagesendandpost.php', {
            post_id: currentPostId,
            tosenderid: selectedIds.join(','),
            messagecontent: message
        }, function(res) {
            if(res == 1) {
                alert("Shared Successfully!");
                shareModal.hide();
            } else {
                alert("Failed to share.");
            }
        });
    });

    $('#userSearch').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $("#shareUserList .d-flex").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    let reelOptionsModal = null;
    $(document).ready(function() {
        if(document.getElementById('reelOptionsModal')) {
            reelOptionsModal = new bootstrap.Modal(document.getElementById('reelOptionsModal'));
        }
    });

    function showReelOptions(postId) {
        currentPostId = postId;
        reelOptionsModal.show();
    }

    function savePost() {
        $.post('/rythm/save_post_action.php', { post_id: currentPostId }, function(res) {
            if(res == "1") {
                alert("Post Saved!");
                reelOptionsModal.hide();
            } else if(res == "0") {
                alert("Post removed from saved.");
                reelOptionsModal.hide();
            } else {
                alert("Failed to save post.");
            }
        });
    }

    function reportPost() {
        alert("This post has been reported. Thank you for keeping Rythm safe.");
        reelOptionsModal.hide();
    }

    function blockUser() {
        alert("User blocked.");
        reelOptionsModal.hide();
    }

    // 🔥 Autoplay Logic with IntersectionObserver
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            root: null,
            threshold: 0.6
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const video = entry.target;
                if (entry.isIntersecting) {
                    video.play().catch(error => console.log("Autoplay blocked:", error));
                } else {
                    video.pause();
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reel-box video').forEach(video => {
            observer.observe(video);
        });
    });

    // 🔊 Sound Toggle function
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
</script>

<?php include("includes/footer.php"); ?>