
<?php
require ('../../connect.php');
session_start();
$type=$_SESSION['title'] ?? '';
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3">
  <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <h4 class="card-title mb-0 fw-bold text-pink">Music Director List</h4>
    <button onclick="add()" class="btn btn-pink rounded-pill px-4">Add New</button>
  </div>
  
  <div class="card-body p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light text-uppercase small fw-bold">
            <tr>
              <th class="ps-3" style="width: 80px;">S.No</th>
              <th style="min-width: 200px;">Director Name</th>
              <th style="width: 120px;">Status</th>
              <th class="text-end pe-3" style="width: 150px;">Action</th>
            </tr>
          </thead>
          <tbody class="small">
            <?php
            $sql = $con->prepare("SELECT * FROM `music_directors` WHERE singer_type=:type ORDER BY music_director_name ASC");
            $sql->execute(['type' => $type]);
            $cnt = 1;
            while ($empdetails = $sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <td class="ps-3 text-muted"><?php echo $cnt; ?></td>
                <td class="fw-bold text-wrap"><?php echo ucfirst(htmlspecialchars($empdetails['music_director_name'])); ?></td>
                <td>
                    <span class="badge rounded-pill <?php echo ($empdetails['status'] == 'active') ? 'bg-success' : 'bg-secondary'; ?>" style="font-size: 0.75rem;">
                        <?php echo ucfirst($empdetails['status']); ?>
                    </span>
                </td>
                <td class="text-end pe-3">
                  <div class="btn-group">
                    <button class="btn btn-sm btn-outline-pink border-0" onclick="music_director_edit(<?php echo $empdetails['id']; ?>)" title="Edit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger border-0" onclick="music_director_delete(<?php echo $empdetails['id']; ?>)" title="Delete">
                        <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <?php
              $cnt++;
            }
            ?>
          </tbody>
        </table>
    </div>
  </div>
</div>

<script>
  function add() {
    $.post("/rythm/professional_singer/music_directors/music_director_add.php", function(data) {
        $('.main-content').html(data);
    });
  }

  function music_director_edit(id) {
    $.post("/rythm/professional_singer/music_directors/music_director_edit.php?id=" + id, function(data) {
        $('.main-content').html(data);
    });
  }

  function music_director_delete(id) {
    if(confirm('Are you sure you want to delete this director?')) {
        $.post("/rythm/professional_singer/music_directors/music_director_delete.php?id=" + id, function(data) {
            showdirectors();
        });
    }
  }
</script>
