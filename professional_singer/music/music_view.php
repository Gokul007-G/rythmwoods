<?php
require ('../../connect.php');
session_start();
$type=$_SESSION['title'] ?? '';
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3">
  <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <h4 class="card-title mb-0 fw-bold text-pink">Songs List</h4>
    <button onclick="addSong()" class="btn btn-pink rounded-pill px-4">Add New Song</button>
  </div>
  
  <div class="card-body p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="songsTable">
          <thead class="table-light text-uppercase small fw-bold">
            <tr>
              <th class="ps-3" style="width: 80px;">S.No</th>
              <th style="min-width: 250px;">Song Name</th>
              <th class="text-center" style="width: 100px;">Play</th>
              <th class="text-end pe-3" style="width: 180px;">Action</th>
            </tr>
          </thead>
          <tbody class="small">
            <?php
            $sql = $con->prepare("SELECT id, title, file_location FROM song_master WHERE singer_type=:type ORDER BY title");
            $sql->execute(['type' => $type]);
            $cnt = 1;
            while ($empdetails = $sql->fetch(PDO::FETCH_ASSOC)) {
                $file_path = "/rythm/professional_singer/music/" . $empdetails['file_location'];
              ?>
              <tr>
                <td class="ps-3 text-muted"><?php echo $cnt; ?></td>
                <td class="fw-bold text-wrap"><?php echo htmlspecialchars($empdetails['title']); ?></td>
                <td class="text-center">
                    <?php if (!empty($empdetails['file_location'])) { ?>
                        <button class="btn btn-sm btn-pink rounded-circle shadow-sm play-btn" style="width: 32px; height: 32px; padding: 0;" onclick="playSong('<?php echo $file_path; ?>', this)">
                            <i class="fa fa-play" style="font-size: 0.8rem;"></i>
                        </button>
                    <?php } else { ?>
                        <span class="text-muted small">None</span>
                    <?php } ?>
                </td>
                <td class="text-end pe-3">
                  <div class="btn-group">
                    <button class="btn btn-sm btn-outline-info border-0" onclick="songs_view(<?php echo $empdetails['id']; ?>)" title="View">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-pink border-0" onclick="songs_edit(<?php echo $empdetails['id']; ?>)" title="Edit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger border-0" onclick="songs_delete(<?php echo $empdetails['id']; ?>)" title="Delete">
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

<!-- Global Audio Player (Hidden) -->
<audio id="globalAudioPlayer"></audio>

<script>
  let currentPlayBtn = null;
  const audioPlayer = document.getElementById('globalAudioPlayer');

  function playSong(file, btn) {
    if (audioPlayer.src.includes(file) && !audioPlayer.paused) {
        audioPlayer.pause();
        $(btn).html('<i class="fa fa-play"></i>');
    } else {
        if (currentPlayBtn) $(currentPlayBtn).html('<i class="fa fa-play"></i>');
        audioPlayer.src = file;
        audioPlayer.play();
        $(btn).html('<i class="fa fa-pause"></i>');
        currentPlayBtn = btn;
    }
  }

  audioPlayer.onended = function() {
    if (currentPlayBtn) $(currentPlayBtn).html('<i class="fa fa-play"></i>');
    currentPlayBtn = null;
  };

  function addSong() {
    $.post("/rythm/professional_singer/music/songs_add.php", function(data) {
        $('.main-content').html(data);
    });
  }

  function songs_edit(id) {
    $.post("/rythm/professional_singer/music/songs_edit.php?id=" + id, function(data) {
        $('.main-content').html(data);
    });
  }

  function songs_view(id) {
    $.post("/rythm/professional_singer/music/songs_view_show.php?id=" + id, function(data) {
        $('.main-content').html(data);
    });
  }

  function songs_delete(id) {
    if(confirm('Are you sure you want to delete this song?')) {
        $.post("/rythm/professional_singer/music/songs_delete.php?id=" + id, function(data) {
            showmusic();
        });
    }
  }
</script>

