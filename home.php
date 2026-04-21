<?php
/**
 * Rythm Home - Unified 3-Column Version
 */
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$pageTitle = "Rythm - Home";
$user_name = $_SESSION['user_name'];
$rolemaster_id = $_SESSION['role_master_id'];

include("includes/header.php");
?>

<div class="feed-area">
    <?php
    try {
        // Fetch All Posts
        $sql = $con->query("SELECT * FROM `posters` WHERE status=1 ORDER BY id DESC");
        $dyn = 0;
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $dyn++;
            $post_id = $data['id'];
            $username_id = $data['username_id'];
            $postimg = $data['postimg'];
            $postvideos = $data['postvideos'];
            $caption = $data['posters_caption'];
            $hastag = $data['posters_hashtag'];
            
            // Date Calculation
            $datediff = time() - strtotime($data['created_on']);
            $numofdays = round($datediff / (60 * 60 * 24));
            $postdate = ($numofdays == 0) ? 'Today' : $numofdays . 'd';
            
            // User Profile Image
            $getprofile = $con->prepare("SELECT profile_img FROM `user_master` WHERE id=?");
            $getprofile->execute([$username_id]);
            $profile_img_data = $getprofile->fetch(PDO::FETCH_ASSOC);
            $profile_pic_url = (!empty($profile_img_data['profile_img'])) ? $profile_img_data['profile_img'] : '/rythm/assets/lion.png';
            
            // Like Count from poster_likes table
            $like_stmt = $con->prepare("SELECT COUNT(*) FROM `poster_likes` WHERE post_id=? AND like_status=1");
            $like_stmt->execute([$post_id]);
            $likecount = intval($like_stmt->fetchColumn() ?? 0);

            // Check if user liked it
            $user_liked_stmt = $con->prepare("SELECT id FROM `poster_likes` WHERE post_id=? AND user_id=? AND like_status=1");
            $user_liked_stmt->execute([$post_id, $_SESSION['users_id']]);
            $user_liked = $user_liked_stmt->fetch();
    ?>
    
    <!-- Post Card -->
    <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center gap-2">
                <img src="<?php echo $profile_pic_url; ?>" alt="User" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;">
                <div>
                    <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($data['username']); ?></h6>
                    <small class="text-muted"><?php echo $postdate; ?></small>
                </div>
            </div>
            <button class="btn btn-link text-dark p-0"><i class="fa fa-ellipsis-h"></i></button>
        </div>

        <!-- Post Media -->
       <div class="post-media bg-black text-center position-relative rounded-0"
                style="height: 500px; width: 100%; overflow: hidden; cursor: pointer;" 
                onclick="openCommentModal(<?php echo $post_id; ?>, <?php echo $dyn; ?>)">

                <?php if (!empty($postimg)): ?>

                    <?php 
                    $img_src = (strpos($postimg, '/') === 0 || strpos($postimg, 'http') === 0) 
                        ? $postimg 
                        : "/rythm/$postimg"; 
                    ?>

                    <img src="<?php echo $img_src; ?>" 
                        class="w-100 h-100" 
                        style="object-fit: contain;">

                <?php elseif (!empty($postvideos)): ?>

                    <?php 
                    $vid_src = (strpos($postvideos, '/') === 0 || strpos($postvideos, 'http') === 0) 
                        ? $postvideos 
                        : "/rythm/$postvideos"; 
                    ?>

                    <video id="video_<?php echo $dyn; ?>" 
                        autoplay muted loop playsinline 
                        class="w-100 h-100" 
                        style="object-fit: contain;">
                        <source src="<?php echo $vid_src; ?>" type="video/mp4">
                    </video>

                    <!-- 🔊 PREMIUM SOUND BUTTON -->
                    <button class="mute-btn" 
                        onclick="toggleSound(event, 'video_<?php echo $dyn; ?>', this)" 
                        title="Toggle Sound">
                        <i class="fa-solid fa-volume-xmark"></i>
                    </button>

                <?php endif; ?>

            </div>

        <!-- Post Actions -->
        <div class="card-body p-3">
            <div class="d-flex justify-content-between mb-2 fs-4">
                <div class="d-flex gap-3">
                    <i class="<?php echo $user_liked ? 'fa-solid' : 'fa-regular'; ?> fa-heart cursor-pointer toggle-like" data-id="<?php echo $post_id; ?>" style="color: var(--rythm-deep-pink);"></i>
                    <i class="fa-regular fa-comment cursor-pointer" onclick="openCommentModal(<?php echo $post_id; ?>, <?php echo $dyn; ?>)"></i>
                    <i class="fa-regular fa-paper-plane cursor-pointer" onclick="sharePost(<?php echo $post_id; ?>)"></i>
                </div>
                <?php
                // Check if already saved
                $check_saved = $con->prepare("SELECT id FROM `poster_download` WHERE poster_id = ? AND downloader_id = ? AND donwload_sts = '1'");
                $check_saved->execute([$post_id, $_SESSION['users_id']]);
                $is_saved = $check_saved->fetch();
                ?>
                <i class="<?php echo $is_saved ? 'fa-solid' : 'fa-regular'; ?> fa-bookmark cursor-pointer toggle-save" data-id="<?php echo $post_id; ?>"></i>
            </div>
            <p class="mb-1 fw-bold"><span id="like-count-<?php echo $post_id; ?>"><?php echo $likecount; ?></span> likes</p>
            <p class="mb-0">
                <span class="fw-bold me-2"><?php echo htmlspecialchars($data['username']); ?></span>
                <?php echo htmlspecialchars($caption); ?>
            </p>
            <p class="mb-0 text-primary">
                <?php 
                $hashtags = explode(' ', $hastag);
                foreach($hashtags as $tag) {
                    if(!empty($tag)) {
                        echo '<span class="me-2">#' . htmlspecialchars($tag) . '</span>';
                    }
                }
                ?>
            </p>
            <button class="btn btn-link text-muted p-0 small text-decoration-none mt-1" onclick="openCommentModal(<?php echo $post_id; ?>, <?php echo $dyn; ?>)">
                View all comments
            </button>
        </div>
    </div>

    <?php 
        }
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Database Error: " . $e->getMessage() . "</div>";
    }
    ?>
</div>

<!-- Right Notification Panel -->
<?php include("includes/right_panel.php"); ?>

<!-- Comment Modal Overlay -->
<div id="commentModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content overflow-hidden border-0 rounded-4" style="height: 80vh;">
            <div class="row g-0 h-100">
                <div class="col-md-7 bg-black d-flex align-items-center justify-content-center h-100">
                    <div id="modalMediaContainer" class="w-100 h-100 d-flex align-items-center justify-content-center">
                        <!-- Media loaded via AJAX -->
                    </div>
                </div>
                <div class="col-md-5 h-100 d-flex flex-column bg-white">
                    <div class="modal-header border-bottom p-3">
                        <div class="d-flex align-items-center gap-2">
                            <img id="modalUserImg" src="" alt="User" class="rounded-circle border" style="width: 35px; height: 35px; object-fit: cover;">
                            <h6 class="modal-title fw-bold" id="modalUsername">Username</h6>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body flex-grow-1 overflow-auto p-3" id="modalCommentsList">
                        <!-- Comments loaded via AJAX -->
                    </div>
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
                <h6 class="modal-title fw-bold">Share Post</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="px-3 py-2 border-bottom">
                    <input type="text" id="userSearch" class="form-control border-0 shadow-none px-0" placeholder="Search followers...">
                </div>
                <div class="user-list overflow-auto px-3 py-2" style="max-height: 300px;" id="shareUserList">
                    <?php
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
            <div class="modal-footer border-0 p-3">
                <button class="btn btn-pink w-100 rounded-pill fw-bold" id="confirmShareBtn">Send</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSound(event, videoId, btn) {
    event.stopPropagation(); // 🔥 modal open ஆகாமல் stop

    var video = document.getElementById(videoId);
    var icon = btn.querySelector("i");

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
    // Remove existing overlays first
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
<script>
    let currentPostId = null;
    let shareModal = null;

    $(document).ready(function() {
        shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
    });

    function openCommentModal(postId, dynId) {
        currentPostId = postId;
        const modal = new bootstrap.Modal(document.getElementById('commentModal'));
        
        // Fetch Post Data for Modal
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

    function fetchComments(postId) {
        $.post('/rythm/getcomments.php', { post_id: postId }, function(response) {
            $('#modalCommentsList').html(response);
        });
    }

    $('#postCommentBtn').click(function() {
        const comment = $('#commentInput').val();
        if(!comment) return;
        
        const alldata = currentPostId + "**" + "<?php echo $rolemaster_id; ?>" + "**" + comment;
        $.post('/rythm/commandsinsert.php', { alldata: alldata }, function(res) {
            if(res == 1) {
                $('#commentInput').val('');
                fetchComments(currentPostId);
            }
        });
    });

    $('.toggle-like').click(function() {
        const id = $(this).data('id');
        const icon = $(this);
        const isLiked = icon.hasClass('fa-solid'); // fa-solid means liked
        const status = isLiked ? 0 : 1;

        $.post('/rythm/updatelikests.php', { post_id: id, like_status: status }, function(response) {
            // updatelikests.php returns string like "10likes"
            $(`#like-count-${id}`).text(response.replace('likes', ''));
            if(status === 1) {
                icon.removeClass('fa-regular').addClass('fa-solid');
            } else {
                icon.removeClass('fa-solid').addClass('fa-regular');
            }
        });
    });

    $('#userSearch').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $("#shareUserList .d-flex").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('click', '.toggle-comment-like', function() {
        const commentId = $(this).data('id');
        const postId = $(this).data('post-id');
        const currentStatus = $(this).data('status');
        const nextStatus = (currentStatus == 1) ? 0 : 1;
        const btn = $(this);

        $.post('/rythm/updatelikestsforcmnders.php', { 
            post_id: postId, 
            commder_id: commentId, 
            like_status: nextStatus 
        }, function(response) {
            const count = response.replace('likes', '');
            $(`#comment-like-count-${commentId}`).text(count > 0 ? count : '');
            
            btn.data('status', nextStatus);
            if(nextStatus == 1) {
                btn.removeClass('fa-regular').addClass('fa-solid text-danger');
            } else {
                btn.removeClass('fa-solid text-danger').addClass('fa-regular');
            }
        });
    });

    $(document).on('click', '.toggle-save', function() {
        const id = $(this).data('id');
        const icon = $(this);
        const isSaved = icon.hasClass('fa-solid');

        $.post('/rythm/save_post_action.php', { post_id: id }, function(response) {
            if(response == "1") {
                icon.removeClass('fa-regular').addClass('fa-solid');
            } else if(response == "0") {
                icon.removeClass('fa-solid').addClass('fa-regular');
            }
        });
    });
</script>

<?php include("includes/footer.php"); ?>
