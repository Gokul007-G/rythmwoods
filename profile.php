<?php
/**
 * Rythm Profile - Unified Professional Version
 */
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}



$users_id = $_SESSION['users_id']; 
$username = $_SESSION['username'];

// Fetch User Data
$user_stmt = $con->prepare("SELECT * FROM user_master WHERE users_id = ?");
$user_stmt->execute([$users_id]);
$user_data = $user_stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_data) {
    die("User not found - check users_id session or DB");
}

// Fetch Post Counts
$post_count_stmt = $con->prepare("SELECT COUNT(*) FROM posters WHERE username_id = ?");
$post_count_stmt->execute([$users_id]);
$total_posts = $post_count_stmt->fetchColumn();

// Fetch Following Count
$following_stmt = $con->prepare("
    SELECT COUNT(*) 
    FROM following_details 
    WHERE follower_id = ? AND following_sts = 1
");
$following_stmt->execute([$users_id]);
$following_count = intval($following_stmt->fetchColumn());

// fetch followers count
$followers_stmt = $con->prepare("
    SELECT COUNT(*) 
    FROM following_details 
    WHERE following_id = ? AND following_sts = 1
");
$followers_stmt->execute([$users_id]);
$followers_count = intval($followers_stmt->fetchColumn());

// Handle Profile Image Upload
if(isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === 0){

    $tmp_name = $_FILES['profile_img']['tmp_name'];

    $ext = strtolower(pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION));
    $new_name = time().".".$ext;

    $upload_dir = __DIR__."/uploads/profile/";
    $upload_path = $upload_dir.$new_name;

    if(!is_dir($upload_dir)){
        mkdir($upload_dir,0777,true);
    }

    if(move_uploaded_file($tmp_name,$upload_path)){

        $stmt = $con->prepare("UPDATE user_master SET profile_img=? WHERE users_id=?");
        $stmt->execute(["uploads/profile/".$new_name,$users_id]);

        header("Location: profile.php");
        exit();
    }
}

$pageTitle = "Rythm - @$username";
include("includes/header.php");
?>

<div class="profile-container p-4">
    <header class="d-flex align-items-center mb-5 gap-5">
        <div class="profile-pic-lg position-relative">
            <form method="POST" enctype="multipart/form-data" style="display:inline;">
                <input type="file" name="profile_img" id="profileInput" hidden onchange="this.form.submit()">
                
                <label for="profileInput" class="position-relative d-inline-block" style="cursor:pointer;">
                    <img src="<?php echo !empty($user_data['profile_img']) ? $user_data['profile_img'] : '/rythm/assets/profile.png'; ?>" 
                        class="rounded-circle border border-2"
                        style="width:150px;height:150px;object-fit:cover;">
                    <!-- Camera Icon Overlay -->
                    <div class="position-absolute bottom-0 end-0 bg-white rounded-circle shadow-sm border p-2 d-flex align-items-center justify-content-center" 
                         style="width: 40px; height: 40px; transform: translate(-5px, -5px);">
                        <i class="fa fa-camera text-muted"></i>
                    </div>
                </label>
            </form>
        </div>
        <div class="profile-meta">
            <div class="d-flex align-items-center gap-4 mb-3">
                <h2 class="mb-0 fw-light"><?php echo htmlspecialchars($user_data['user_name'] ?? ''); ?></h2>
                <button class="btn btn-outline-dark btn-sm rounded-pill px-4" onclick="location.href='/rythm/editprofile.php'">Edit Profile</button>
            </div>
            <div class="d-flex gap-4 mb-3">
                <span><strong><?php echo $total_posts; ?></strong> posts</span>
                <span><strong><?php echo $followers_count; ?></strong> followers</span>
                <span><strong><?php echo $following_count; ?></strong> following</span>
            </div>
            <div class="fw-bold"><?php echo htmlspecialchars($user_data['user_name'] ?? ''); ?></div>
            <div class="text-muted small">Professional Artist / Musician</div>
        </div>
    </header>

    <!-- Post Grid Tabs -->
    <div class="border-top mb-4">
        <div class="d-flex justify-content-center gap-5">
            <button class="btn btn-link text-decoration-none py-3 border-top border-dark border-3 rounded-0 small fw-bold profile-tab-btn active" data-tab="posts">
                <i class="fa fa-th me-1"></i> POSTS
            </button>
            <button class="btn btn-link text-muted text-decoration-none py-3 small fw-bold profile-tab-btn" data-tab="reels">
                <i class="fa fa-video me-1"></i> REELS
            </button>
            <button class="btn btn-link text-muted text-decoration-none py-3 small fw-bold profile-tab-btn" data-tab="saved">
                <i class="fa fa-bookmark me-1"></i> SAVED
            </button>
        </div>
    </div>

    <!-- Posts Grid Container -->
    <div class="row g-3" id="profilePostsGrid">
        <!-- Content loaded via AJAX -->
        <div class="col-12 text-center py-5">
            <div class="spinner-border text-pink" role="status"></div>
        </div>
    </div>
</div>

<style>
.profile-tab-btn.active {
    color: var(--rythm-pink) !important;
    border-top-color: var(--rythm-pink) !important;
}
.hover-opacity-100:hover {
    opacity: 1 !important;
}
.transition-opacity {
    transition: opacity 0.2s ease-in-out;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadProfileTab(tab) {
        $('#profilePostsGrid').html('<div class="col-12 text-center py-5"><div class="spinner-border text-pink" role="status"></div></div>');
        
        $.post('get_profile_posts.php', { tab: tab }, function(response) {
            $('#profilePostsGrid').html(response);
        });
    }

    $('.profile-tab-btn').click(function() {
        const tab = $(this).data('tab');
        $('.profile-tab-btn').removeClass('active text-dark border-dark border-3').addClass('text-muted');
        $(this).addClass('active').removeClass('text-muted');
        loadProfileTab(tab);
    });

    // Initial Load
    $(document).ready(function() {
        loadProfileTab('posts');
    });
</script>

<?php include("includes/footer.php"); ?>
