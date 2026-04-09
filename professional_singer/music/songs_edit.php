<?php
require '../../connect.php';
session_start();
$id = $_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM song_master WHERE id=:id"); 
$stmt->execute(['id' => $id]); 
$row = $stmt->fetch();
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-pink">Edit Karaoke & Lyrics</h5>
        <button onclick="showmusic()" class="btn btn-outline-secondary border-0 btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </button>
    </div>
    
    <div class="card-body p-4">
        <form id="editSongForm" enctype="multipart/form-data">
            <input type="hidden" name="get_id" value="<?php echo $row['id']; ?>">
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Song Name</label>
                <input type="text" class="form-control rounded-pill px-3" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Language</label>
                    <select class="form-select rounded-pill px-3" name="language_id" required>
                        <option value="">---Select---</option>
                        <?php
                        $sql = $con->query("SELECT * FROM languages ORDER BY language_name ASC");
                        while ($cmp = $sql->fetch(PDO::FETCH_ASSOC)) {
                            $sel = ($cmp['id'] == $row['language_id']) ? 'selected' : '';
                            echo '<option value="' . $cmp['id'] . '" ' . $sel . '>' . htmlspecialchars($cmp['language_name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Status</label>
                    <select name="status" class="form-select rounded-pill px-3" required>
                        <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Current Song: <span class="text-muted fw-normal"><?php echo $row['file_location']; ?></span></label>
                <input type="file" class="form-control rounded-pill" name="song_file" accept=".mp3">
                <div class="form-text small">Leave blank to keep existing file.</div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Current Lyrics: <span class="text-muted fw-normal"><?php echo $row['lyrics_location']; ?></span></label>
                <input type="file" class="form-control rounded-pill" name="lyrics_file">
                <div class="form-text small">Leave blank to keep existing file.</div>
            </div>

            <button type="submit" class="btn btn-pink w-100 rounded-pill py-2 fw-bold mt-3 shadow-sm">
                Update Karaoke
            </button>
        </form>
    </div>
</div>

<script>
$('#editSongForm').on('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
        url: "/rythm/professional_singer/music/songs_update.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert('Song Updated Successfully');
            showmusic();
        },
        error: function() {
            alert('Error updating song. Try again.');
        }
    });
});
</script>
