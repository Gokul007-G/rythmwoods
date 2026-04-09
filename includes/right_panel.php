<?php
/**
 * Rythm Right Panel - Notifications & Suggestions
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . "/config.php");
$rolemaster_id = $_SESSION['rolemaster_id'] ?? 0;
?>

<aside class="right-panel d-none d-lg-block">
    <!-- Notifications Section (Real Data) -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                Social Activity
                <?php
                $notif_stmt = $con->prepare("SELECT COUNT(*) FROM shareposter WHERE postto_id = ?");
                $notif_stmt->execute([$rolemaster_id]);
                $notif_count = $notif_stmt->fetchColumn();
                ?>
                <span class="badge rounded-pill bg-danger" style="font-size: 10px;"><?php echo $notif_count; ?></span>
            </h6>
            <div class="notification-list overflow-auto" style="max-height: 200px;">
                <?php
                $shares_stmt = $con->prepare("SELECT s.*, u.user_name, u.profile_img FROM shareposter s JOIN user_master u ON s.postfrom_id = u.role_master_id WHERE s.postto_id = ? ORDER BY s.id DESC LIMIT 5");
                $shares_stmt->execute([$rolemaster_id]);
                while($share = $shares_stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class="notification-item d-flex align-items-center gap-3 mb-3 p-2 rounded-3 hover-bg-light cursor-pointer">
                    <img src="<?php echo !empty($share['profile_img']) ? $share['profile_img'] : '/rythm/assets/profile.png'; ?>" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                    <div>
                        <p class="mb-0 x-small"><span class="fw-bold"><?php echo htmlspecialchars($share['user_name']); ?></span> shared a post</p>
                        <small class="text-muted x-small"><?php echo $share['created_on']; ?></small>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php if($notif_count == 0): ?>
                    <small class="text-muted x-small d-block text-center py-2">No new notifications</small>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Suggestions for You (Live) -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold m-0">Suggestions for you</h6>
                <button class="btn btn-link text-dark p-0 text-decoration-none x-small fw-bold">See All</button>
            </div>
            
            <div class="suggestion-list">
                <?php
                // Fetch users NOT already followed by the current user
                $sug_stmt = $con->prepare("SELECT * FROM user_master WHERE role_master_id != ? AND role_master_id NOT IN (SELECT user_id FROM following_details WHERE role_master_id = ?) LIMIT 5");
                $sug_stmt->execute([$rolemaster_id, $rolemaster_id]);
                while($sug = $sug_stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class="suggestion-item d-flex justify-content-between align-items-center mb-3" id="suggest-user-<?php echo $sug['role_master_id']; ?>">
                    <div class="d-flex align-items-center gap-2">
                        <img src="<?php echo !empty($sug['profile_img']) ? $sug['profile_img'] : '/rythm/assets/profile.png'; ?>" 
                             alt="User" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: cover;">
                        <div>
                            <p class="mb-0 small fw-bold"><?php echo htmlspecialchars($sug['user_name']); ?></p>
                            <small class="text-muted x-small">Recommended</small>
                        </div>
                    </div>
                    <button class="btn btn-link text-primary p-0 text-decoration-none small fw-bold follow-suggest-btn" data-id="<?php echo $sug['role_master_id']; ?>">Follow</button>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

<script>
$(document).on('click', '.follow-suggest-btn', function() {
    const userId = $(this).data('id');
    const btn = $(this);
    $.post('/rythm/followingsts.php', { user_id: userId, followingsts: 1 }, function(res) {
        if(res == 1) {
            btn.text('Following').removeClass('text-primary').addClass('text-muted').prop('disabled', true);
            $(`#suggest-user-${userId}`).fadeOut(1000);
        }
    });
});
</script>

    <!-- Mini Footer -->
    <div class="mt-4 px-2">
        <small class="text-muted opacity-50" style="font-size: 11px;">
            About • Help • Press • API • Jobs • Privacy • Terms • Locations • Language
            <br><br>
            © 2026 RYTHM FROM SURYA
        </small>
    </div>
</aside>

<style>
.x-small { font-size: 12px; }
</style>
