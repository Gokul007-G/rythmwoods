<?php
/**
 * Rythm Profile Page - Professional Modular Version
 */
require_once("../includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/pages/login.php");
    exit();
}

$pageTitle = "Rythm - Profile";
$rolemaster_id = $_SESSION['rolemaster_id'];
$username = $_SESSION['username'];

// Fetch User Profile Data
$user_stmt = $con->prepare("SELECT * FROM `user_master` WHERE role_master_id = ?");
$user_stmt->execute([$rolemaster_id]);
$user_data = $user_stmt->fetch(PDO::FETCH_ASSOC);

// Fetch Stats
$post_count = $con->prepare("SELECT COUNT(*) FROM posters WHERE username_id = ?");
$post_count->execute([$rolemaster_id]);
$total_posts = $post_count->fetchColumn();

include("../includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="profile-header d-flex align-items-center mb-5 pb-4 border-bottom">
            <div class="me-5">
                <img src="<?php echo !empty($user_data['profile_img']) ? $user_data['profile_img'] : '/rythm/assets/images/lion.png'; ?>" 
                     alt="Profile" class="rounded-circle border p-1" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-4 mb-3">
                    <h2 class="m-0 fw-light" style="font-size: 28px;"><?php echo htmlspecialchars($user_data['user_name']); ?></h2>
                    <a href="editprofile.php" class="btn btn-outline-dark btn-sm fw-bold px-3">Edit Profile</a>
                    <i class="fa fa-cog fs-4 cursor-pointer"></i>
                </div>
                <div class="d-flex gap-5 mb-3">
                    <span><strong class="fw-bold"><?php echo $total_posts; ?></strong> posts</span>
                    <span><strong class="fw-bold">0</strong> followers</span>
                    <span><strong class="fw-bold">0</strong> following</span>
                </div>
                <div>
                    <h6 class="fw-bold m-0"><?php echo htmlspecialchars($user_data['user_name']); ?></h6>
                    <p class="text-muted mb-0">Music is life. Rythm is everything.</p>
                </div>
            </div>
        </div>

        <!-- Grid Tabs -->
        <ul class="nav nav-tabs justify-content-center border-0 mb-4" id="profileTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active border-0 border-top-2 bg-transparent text-dark fw-bold px-4 py-3" 
                        style="border-top: 1px solid #000 !important; border-radius: 0;" data-bs-toggle="tab" data-bs-target="#posts">
                    <i class="fa fa-th me-2"></i>POSTS
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link border-0 bg-transparent text-muted fw-bold px-4 py-3" data-bs-toggle="tab" data-bs-target="#reels">
                    <i class="fa fa-video me-2"></i>REELS
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link border-0 bg-transparent text-muted fw-bold px-4 py-3" data-bs-toggle="tab" data-bs-target="#saved">
                    <i class="fa fa-bookmark me-2"></i>SAVED
                </button>
            </li>
        </ul>

        <!-- Grid Content -->
        <div class="tab-content" id="profileTabContent">
            <div class="tab-pane fade show active" id="posts">
                <div class="row g-4">
                    <?php 
                    $posts_stmt = $con->prepare("SELECT * FROM `posters` WHERE post_type='image' AND status='1' AND username_id=? ORDER BY id DESC");
                    $posts_stmt->execute([$rolemaster_id]);
                    while($post = $posts_stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <div class="col-4">
                            <div class="ratio ratio-1x1 overflow-hidden cursor-pointer shadow-sm rounded">
                                <img src="<?php echo $post['postimg']; ?>" alt="Post" class="img-fluid object-fit-cover">
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php if ($total_posts == 0): ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fa fa-camera fs-1 mb-3"></i>
                            <h4>No posts yet</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tab-pane fade show active" id="reels">
                <div class="tab-pane fade show active" id="reels">
                   <div class="row g-4">
                        <?php 
                    $posts_stmt = $con->prepare("SELECT * FROM `posters` WHERE post_type='video' AND status='1' AND username_id=? ORDER BY id DESC");
                    $posts_stmt->execute([$rolemaster_id]);
                    while($post = $posts_stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <div class="col-4">
                            <div class="ratio ratio-1x1 overflow-hidden cursor-pointer shadow-sm rounded">
                                <img src="<?php echo $post['postimg']; ?>" alt="reels" class="img-fluid object-fit-cover">
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php if ($total_posts == 0): ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fa fa-camera fs-1 mb-3"></i>
                            <h4>No reels yet</h4>
                        </div>
                    <?php endif; ?>
                   </div>
                </div>
            </div>
            <div class="tab-pane fade" id="reels">
                <p class="text-center py-5 text-muted">Reels feature coming soon.</p>
            </div>
            <div class="tab-pane fade" id="saved">
                <p class="text-center py-5 text-muted">Saved posts will appear here.</p>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
