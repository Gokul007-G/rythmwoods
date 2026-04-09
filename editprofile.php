<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['users_id'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$users_id = $_SESSION['users_id'];

// Fetch user data
$stmt = $con->prepare("SELECT * FROM `user_master` WHERE id = ?");
$stmt->execute([$users_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    exit("User not found.");
}

$pageTitle = "Edit Profile - Rythm";
include("includes/header.php");
?>

<div class="edit-profile-container p-4 mx-auto" style="max-width: 600px;">
    <h2 class="mb-4 fw-light">Edit Profile</h2>
    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-4">
                <div class="d-flex align-items-center gap-4 py-3 border-bottom">
                    <div class="profile-pic-sm">
                        <img src="<?php echo !empty($user['profile_img']) ? $user['profile_img'] : '/rythm/assets/profile.png'; ?>" 
                             alt="Profile" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid var(--rythm-pink);">
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold"><?php echo htmlspecialchars($user['user_name']); ?></h6>
                        <label class="text-pink fw-bold cursor-pointer small" for="profile_img_input">Change Profile Photo</label>
                        <input type="file" name="profile_img" id="profile_img_input" class="d-none" accept="image/*">
                    </div>
                </div>

                <div>
                    <label class="form-label fw-bold small text-muted">Full Name</label>
                    <input type="text" name="name" class="form-control rounded-pill border-light bg-light px-3" 
                           value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>

                <div>
                    <label class="form-label fw-bold small text-muted">Username</label>
                    <input type="text" name="user_name" class="form-control rounded-pill border-light bg-light px-3" 
                           value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
                </div>

                <div>
                    <label class="form-label fw-bold small text-muted">Title / Category</label>
                    <input type="text" name="title" class="form-control rounded-pill border-light bg-light px-3" 
                           value="<?php echo htmlspecialchars($user['title']); ?>">
                </div>

                <div>
                    <label class="form-label fw-bold small text-muted">Mobile No</label>
                    <input type="text" name="mobile_no" class="form-control rounded-pill border-light bg-light px-3" 
                           value="<?php echo htmlspecialchars($user['mobile_no']); ?>">
                </div>

                <div class="pt-3">
                    <button type="submit" class="btn btn-pink w-100 rounded-pill py-2 fw-bold shadow-sm">Save Changes</button>
                    <button type="button" class="btn btn-link text-muted w-100 mt-2 text-decoration-none small" onclick="location.href='profile.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.btn-pink {
    background-color: var(--rythm-pink);
    color: white;
}
.btn-pink:hover {
    background-color: #ff66a3;
    color: white;
}
.text-pink { color: var(--rythm-pink); }
.cursor-pointer { cursor: pointer; }
</style>

<?php include("includes/footer.php"); ?>