<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . "/config.php");

$login_user_id = $_SESSION['users_id'] ?? 0;
?>

<aside class="right-panel d-none d-lg-block">

    <!-- Suggestions for You -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold m-0">Suggestions for you</h6>
            </div>

          <div class="suggestion-list">
        <?php
        $sug_stmt = $con->prepare("
            SELECT * FROM user_master u
            WHERE u.users_id != ?
            AND NOT EXISTS (
                SELECT 1 
                FROM following_details f
                WHERE f.follower_id = ?
                AND f.following_sts = 1
                AND f.following_id = u.users_id
            )
        ");
        $sug_stmt->execute([$login_user_id, $login_user_id]);

        while($sug = $sug_stmt->fetch(PDO::FETCH_ASSOC)):
        ?>

                <div class="suggestion-item d-flex justify-content-between align-items-center mb-3"
                     id="suggest-user-<?php echo $sug['users_id']; ?>">

                    <div class="d-flex align-items-center gap-2">
                        <img src="<?php echo !empty($sug['profile_img']) ? $sug['profile_img'] : '/rythm/assets/profile.png'; ?>" 
                             class="rounded-circle border profile-img">

                        <div>
                            <p class="mb-0 small fw-bold">
                                <?php echo htmlspecialchars($sug['user_name']); ?>
                            </p>
                            <small class="text-muted x-small">Recommended</small>
                        </div>
                    </div>

                    <button class="btn btn-link text-primary p-0 text-decoration-none small fw-bold follow-suggest-btn"
                            data-id="<?php echo $sug['users_id']; ?>">
                        Follow
                    </button>

                </div>

                <?php endwhile; ?> 
            </div>

        </div>
    </div>

</aside>
<script>
$(document).on('click', '.follow-suggest-btn', function() {
    const userId = $(this).data('id');
    const btn = $(this);

    $.post('/rythm/followingsts.php', {
        user_id: userId,
        followingsts: 1
    }, function(res) {

        if(res == 1) {
            btn.text('Following')
               .removeClass('text-primary')
               .addClass('text-muted')
               .prop('disabled', true);

            $('#suggest-user-' + userId).fadeOut(500);
        }
    });
});
</script>

<style>
    .x-small { font-size: 12px; }

.profile-img {
    width: 32px;
    height: 32px;
    object-fit: cover;
}

.suggestion-item {
    transition: 0.2s ease;
}

.suggestion-item:hover {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 5px;
}

.follow-suggest-btn {
    cursor: pointer;
}
</style>