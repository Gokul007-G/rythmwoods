<?php
require '../../connect.php';
session_start();
$type = $_SESSION['title'] ?? '';
$singer_id = $_SESSION['rolemaster_id'] ?? 1;
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-pink">Add New Karaoke & Lyrics</h5>
        <button onclick="showmusic()" class="btn btn-outline-secondary border-0 btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </button>
    </div>
    
    <div class="card-body p-4">
        <form id="addSongForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label small fw-bold">Song Name</label>
                <input type="text" class="form-control rounded-pill px-3" name="title1" placeholder="Enter Song Name" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Music Director</label>
                    <select class="form-select rounded-pill px-3" name="music_director_id1" required>
                        <option value="">---Select---</option>
                        <?php
                        $sql = $con->query("SELECT * FROM music_directors ORDER BY music_director_name ASC");
                        while ($cmp = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $cmp['id'] . '">' . htmlspecialchars($cmp['music_director_name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Language</label>
                    <select class="form-select rounded-pill px-3" name="language_id1" required>
                        <option value="">---Select---</option>
                        <?php
                        $sql = $con->query("SELECT * FROM languages ORDER BY language_name ASC");
                        while ($cmp = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $cmp['id'] . '">' . htmlspecialchars($cmp['language_name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Select Song (MP3)</label>
                    <input type="file" class="form-control rounded-pill" name="song_file1" accept=".mp3" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Upload Lyrics (PDF/DOC)</label>
                    <input type="file" class="form-control rounded-pill" name="lyrics_file1" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Status</label>
                <select name="status" class="form-select rounded-pill px-3" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-pink w-100 rounded-pill py-2 fw-bold mt-3 shadow-sm">
                Create Karaoke
            </button>
        </form>
    </div>
</div>

<script>
$('#addSongForm').on('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
        url: "/rythm/professional_singer/music/songs_submit.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert('Song Added Successfully');
            showmusic();
        },
        error: function() {
            alert('Error adding song. Try again.');
        }
    });
});
</script>