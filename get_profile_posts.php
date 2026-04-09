<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['users_id'])) {
    exit("Unauthorized");
}

$users_id = $_SESSION['users_id'];
$tab = $_POST['tab'] ?? 'posts';

try {
    if ($tab == 'posts') {
        $stmt = $con->prepare("
            SELECT p.*, COUNT(c.id) AS comment_count
            FROM posters p
            LEFT JOIN posters_commads c ON p.id = c.posterid
            WHERE p.post_type='image' 
            AND p.status='1' 
            AND p.username_id=?
            GROUP BY p.id
            ORDER BY p.created_on DESC
        ");
        $stmt->execute([$users_id]);
    } else if ($tab == 'reels') {
        $stmt = $con->prepare("SELECT * FROM `posters` WHERE post_type='video' AND status='1' AND username_id=? ORDER BY created_on DESC");
        $stmt->execute([$users_id]);
    } else if ($tab == 'saved') {
        $stmt = $con->prepare("SELECT p.* FROM `posters` p JOIN `poster_download` s ON p.id = s.poster_id WHERE s.downloader_id = ? AND s.donwload_sts = '1' ORDER BY s.id DESC");
        $stmt->execute([$users_id]);
    }

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) == 0) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted'>No " . htmlspecialchars($tab) . " found.</p></div>";
    } else {
        foreach ($results as $item) {
            $is_video = ($item['post_type'] == 'video' || !empty($item['postvideos']));
            $mediaPath = $is_video ? $item['postvideos'] : $item['postimg'];
            ?>
            <div class="col-4">
                <div class="ratio ratio-1x1 bg-dark cursor-pointer overflow-hidden rounded-2 position-relative group">
                    <?php if ($is_video): ?>
                        <video src="<?php echo $mediaPath; ?>" class="w-100 h-100" style="object-fit: cover;" controls muted></video>
                        <div class="position-absolute top-0 end-0 p-2 text-white shadow-sm">
                            <i class="fa fa-video"></i>
                        </div>
                    <?php else: ?>
                        <img src="<?php echo $mediaPath; ?>" alt="Post" class="img-fluid w-100 h-100" style="object-fit: cover;">
                    <?php endif; ?>
                    
                    <!-- Overlay on Hover -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                        <div class="text-white d-flex gap-3">
                            <span><i class="fa fa-heart me-1"></i> <?php echo $item['likestatus'] ?? 0; ?></span>
                            <span><i class="fa fa-comment me-1"></i> <?php echo $item['comment_count'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} catch (PDOException $e) {
    echo "Error loading content.";
}
?>
