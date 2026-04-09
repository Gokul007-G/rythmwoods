<?php
/**
 * Rythm Get Comments AJAX
 */
require_once("includes/config.php");

if (!isset($_POST['post_id'])) {
    exit("Invalid Post ID");
}

$postId = $_POST['post_id'];

try {
    $stmt = $con->prepare("
        SELECT c.*, u.user_name, u.profile_img 
        FROM posters_commads c 
        JOIN user_master u ON c.commander_id = u.role_master_id 
        WHERE c.posterid = ? 
        GROUP BY c.id
        ORDER BY c.created_on DESC
    ");
    $stmt->execute([$postId]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $now = time();
        $datediff = $now - strtotime($row['created_on']);
        $numofdays = round($datediff / (60 * 60 * 24));
        $date = ($numofdays == 0) ? 'Today' : $numofdays . 'd';
        
        $profile_pic = (!empty($row['profile_img'])) ? $row['profile_img'] : '/rythm/assets/images/lion.png';
?>
        <div class="comment-item d-flex gap-3 mb-4">
            <img src="<?php echo $profile_pic; ?>" alt="User" class="rounded-circle border" style="width: 35px; height: 35px; object-fit: cover;">
            <div class="comment-content">
                <p class="mb-1 small">
                    <span class="fw-bold me-2"><?php echo htmlspecialchars($row['user_name']); ?></span>
                    <?php echo htmlspecialchars($row['commands']); ?>
                </p>
                <div class="d-flex gap-3 align-items-center x-small text-muted">
                    <span><?php echo $date; ?></span>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fa-<?php echo ($row['likeorno'] == 1) ? 'solid text-danger' : 'regular'; ?> fa-heart cursor-pointer toggle-comment-like" 
                           data-id="<?php echo $row['id']; ?>" 
                           data-post-id="<?php echo $postId; ?>"
                           data-status="<?php echo $row['likeorno']; ?>"
                           style="font-size: 14px;"></i>
                        <span id="comment-like-count-<?php echo $row['id']; ?>" class="fw-bold"><?php echo ($row['likests_cmd'] > 0) ? $row['likests_cmd'] : ''; ?></span>
                    </div>
                    <span class="fw-bold cursor-pointer">Reply</span>
                </div>

            </div>
        </div>
<?php
    }
    
    if ($stmt->rowCount() == 0) {
        echo "<div class='text-center text-muted py-5'><small>No comments yet. Be the first to comment!</small></div>";
    }
} catch (PDOException $e) {
    echo "Error loading comments.";
}
?>
