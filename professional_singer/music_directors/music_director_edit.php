<?php
require '../../connect.php';
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM `music_directors` WHERE id=:id"); 
$stmt->execute(['id' => $id]); 
$row = $stmt->fetch();
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-pink">Edit Music Director</h5>
        <button onclick="showdirectors()" class="btn btn-outline-secondary border-0 btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </button>
    </div>
    
    <div class="card-body p-4">
        <form id="editDirectorForm">
            <input type="hidden" name="get_id" value="<?php echo $row['id']; ?>">
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Music Director Name</label>
                <input type="text" class="form-control rounded-pill px-3" name="music_director_name" value="<?php echo htmlspecialchars($row['music_director_name']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Status</label>
                <select name="status" class="form-select rounded-pill px-3" required>
                    <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>

            <button type="button" onclick="update_music_director()" class="btn btn-pink w-100 rounded-pill py-2 fw-bold mt-3 shadow-sm">
                Update Director
            </button>
        </form>
    </div>
</div>

<script>
function update_music_director() {
    const data = $('#editDirectorForm').serialize();
    $.ajax({
        type: 'GET',
        data: "id=0&" + data,
        url: '/rythm/professional_singer/music_directors/music_director_update.php',
        success: function (data) {
            alert("Music Director Updated Successfully");
            showdirectors();
        }
    });
}
</script>
