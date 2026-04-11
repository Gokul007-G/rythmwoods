<?php
/**
 * Rythm Home Page - Final Professional Version
 */
require_once("../includes/config.php");

// Authentication Check
if (!isset($_SESSION['username'])) {
    header("Location: /rythm/pages/login.php");
    exit();
}

$pageTitle = "Rythm - Home";
$profile_name = $_SESSION['user_name'];
$rolemaster_id = $_SESSION['role_master_id'];

include("../includes/header.php");
?>

<div class="feed-container">
    <?php
    // Fetch and Display Posts
    try {
        $sql = $con->query("SELECT * FROM `posters` WHERE status=1 ORDER BY id DESC");
        $dyn = 0;
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $dyn++;
            $usernameee_id = $data['username_id'];
            $postimg = $data['postimg'];
            $postvideos = $data['postvideos'];
            
            // Date Calculation
            $datediff = time() - strtotime($data['created_on']);
            $numofdays = round($datediff / (60 * 60 * 24));
            $postdate = ($numofdays == 0) ? 'Today' : $numofdays . 'd';
            
            // User Profile Fetch
            $getprofile = $con->query("SELECT * FROM `user_master` WHERE users_id='$usernameee_id'");
            $profileimg = $getprofile->fetch(PDO::FETCH_ASSOC);
            $profile_pic_url = (!empty($profileimg['profile_img'])) ? $profileimg['profile_img'] : '/rythm/assets/images/lion.png';
            
            // Likestatus Check
            $countoflikests = $con->query("SELECT SUM(likestatus) as countoflike FROM `posters` WHERE id='".$data['id']."' AND likestatus!=0 ");
            $likestats = $countoflikests->fetch(PDO::FETCH_ASSOC);
            $likecount = $likestats['countoflike'] ?? 0;
    ?>
    <!-- Post Card -->
    <div class="card card-rythm shadow-sm mb-4">
        <!-- Post Header -->
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3 px-4">
            <div class="d-flex align-items-center gap-3">
                <img src="<?php echo $profile_pic_url; ?>" alt="Profile" class="rounded-circle border" style="width: 42px; height: 42px; object-fit: cover; cursor: pointer;">
                <div>
                    <h6 class="mb-0 fw-bold"><?php echo ucfirst($data['username']); ?></h6>
                    <small class="text-muted"><?php echo $postdate; ?></small>
                </div>
            </div>
            <button class="btn btn-link text-dark p-0" onclick="showPopup(<?php echo $data['id']; ?>, <?php echo $dyn; ?>)">
                <i class="fa fa-ellipsis-h"></i>
            </button>
        </div>

        <!-- Post Media -->
        <div class="post-media bg-black d-flex align-items-center justify-content-center" style="min-height: 300px; max-height: 600px; overflow: hidden;">
            <?php 
            if (!empty($postimg)) {
                $img_src = (strpos($postimg, '/') === 0 || strpos($postimg, 'http') === 0) ? $postimg : "/rythm/$postimg";
                echo '<img src="'.$img_src.'" alt="Post" class="img-fluid w-100" style="object-fit: contain;">';
            } elseif (!empty($postvideos)) {
                $vid_src = (strpos($postvideos, '/') === 0 || strpos($postvideos, 'http') === 0) ? $postvideos : "/rythm/$postvideos";
                echo '<video controls class="w-100 h-100"><source src="'.$vid_src.'" type="video/mp4"></video>';
            }
            ?>
        </div>

        <!-- Post Actions -->
        <div class="card-body px-4 py-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex gap-4">
                    <span class="fs-4 cursor-pointer" onclick="toggleLike(<?php echo $dyn; ?>, <?php echo $data['id']; ?>)">
                        <i id="likeIcon_<?php echo $dyn; ?>" class="fa-regular fa-heart <?php echo ($data['ownlikessts'] == 1) ? 'fa-solid text-danger' : ''; ?>"></i>
                    </span>
                    <span class="fs-4 cursor-pointer" onclick="openComments(<?php echo $data['id']; ?>)">
                        <i class="fa-regular fa-comment"></i>
                    </span>
                    <span class="fs-4 cursor-pointer" onclick="sharePost(<?php echo $data['id']; ?>)">
                        <i class="fa-regular fa-paper-plane"></i>
                    </span>
                </div>
                <div class="fs-4 cursor-pointer" onclick="savePost(<?php echo $data['id']; ?>)">
                    <i class="fa-regular fa-bookmark"></i>
                </div>
            </div>
            
            <p class="mb-1"><span class="fw-bold"><?php echo $likecount; ?> likes</span></p>
            <p class="mb-0">
                <span class="fw-bold me-2"><?php echo $data['username']; ?></span>
                <?php echo $data['posters_caption']; ?>
            </p>
        </div>
        
        <!-- Quick Comment -->
        <div class="card-footer bg-white border-top-0 px-4 pb-3 pt-0">
            <hr class="mt-0 opacity-10">
            <div class="input-group">
                <input type="text" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="Add a comment...">
                <button class="btn btn-link text-primary fw-bold text-decoration-none p-0">Post</button>
            </div>
        </div>
    </div>
    <?php
        }
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Error loading posts.</div>";
    }
    ?>
</div>

<script src="/rythm/assets/js/home.js"></script>

<?php include("../includes/footer.php"); ?>
