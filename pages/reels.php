<?php
/**
 * Rythm Reels Page - Final Professional Version
 */
require_once("../includes/config.php");

// Authentication Check
if (!isset($_SESSION['username'])) {
    header("Location: /rythm/pages/login.php");
    exit();
}

$pageTitle = "Rythm - Reels";
$profile_name = $_SESSION['user_name'];
$rolemaster_id = $_SESSION['role_master_id'];

include("../includes/header.php");
?>

<!-- Reels Page Styles -->
<link rel="stylesheet" href="/rythm/assets/css/reels.css">

<div class="reels-feed w-100 d-flex flex-column align-items-center gap-5">
    <?php
    try {
        $getall = $con->query("SELECT * FROM `posters` WHERE status = '1' AND post_type = 'video' ORDER BY id DESC");
        $inc = 0;
        
        while ($data = $getall->fetch(PDO::FETCH_ASSOC)) {
            $inc++;
            $post_id = $data['id'];
            
            // Fetch Likes count
            $getlikes = $con->query("SELECT SUM(likestatus) as countoflike FROM `posters` WHERE id='$post_id'");
            $likesData = $getlikes->fetch(PDO::FETCH_ASSOC);
            $likecount = $likesData['countoflike'] ?? 0;
            
            // Fetch Comments count
            $getmsgs = $con->query("SELECT COUNT(commands) as msgcount FROM `posters_commads` WHERE posterid='$post_id'");
            $msgsData = $getmsgs->fetch(PDO::FETCH_ASSOC);
    ?>
    <!-- Reel Item -->
    <div class="reel-item shadow-lg rounded-4 overflow-hidden position-relative bg-black" 
         style="width: 100%; max-width: 450px; aspect-ratio: 9/16; height: 85vh;">
        
        <!-- Video Player -->
        <video id="video1" class="w-100 h-100"
            style="object-fit: cover;"
            muted loop playsinline>
            <source src="<?php echo $data['postvideos']; ?>" type="video/mp4">
        </video>

        <!-- Reel Overlay Info -->
        <div class="reel-overlay-bottom position-absolute bottom-0 start-0 p-4 w-100 text-white" 
             style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="/rythm/assets/images/lion.png" alt="" class="rounded-circle border border-2 border-white" style="width: 40px; height: 40px;">
                <h6 class="mb-0 fw-bold"><?php echo $data['username']; ?></h6>
                <button class="btn btn-outline-light btn-sm rounded-pill px-3 py-0">Follow</button>
            </div>
            <p class="small mb-0 opacity-85"><?php echo $data['posters_caption']; ?></p>
        </div>

        <!-- Reel Action Sidebar -->
        <div class="reel-actions position-absolute bottom-0 end-0 p-4 d-flex flex-column gap-4 align-items-center mb-5 pb-5">
            <div class="action-btn-group text-center">
                <button class="btn btn-dark btn-reel rounded-circle shadow border-0 mb-1" onclick="toggleLike(<?php echo $inc; ?>, <?php echo $post_id; ?>)">
                    <i class="fa fa-heart fs-4 <?php echo ($data['ownlikessts'] == 1) ? 'text-danger' : ''; ?>"></i>
                </button>
                <small class="text-white d-block fw-bold"><?php echo $likecount; ?></small>
            </div>

            <div class="action-btn-group text-center">
                <button class="btn btn-dark btn-reel rounded-circle shadow border-0 mb-1" onclick="messagepopup(<?php echo $post_id; ?>, <?php echo $inc; ?>)">
                    <i class="fa fa-comment fs-4"></i>
                </button>
                <small class="text-white d-block fw-bold"><?php echo $msgsData['msgcount'] ?? 0; ?></small>
            </div>

            <div class="action-btn-group text-center">
                <button class="btn btn-dark btn-reel rounded-circle shadow border-0 mb-1" onclick="sharePost(<?php echo $post_id; ?>)">
                    <i class="fa fa-paper-plane fs-4"></i>
                </button>
            </div>

            <div class="action-btn-group text-center">
                <button class="btn btn-dark btn-reel rounded-circle shadow border-0 mb-1" onclick="savePost(<?php echo $post_id; ?>)">
                    <i class="fa fa-bookmark fs-4"></i>
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

<script src="/rythm/assets/js/reels.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let v = document.getElementById("video1");
    v.play().catch(() => {});
});
</script>
<?php include("../includes/footer.php"); ?>
