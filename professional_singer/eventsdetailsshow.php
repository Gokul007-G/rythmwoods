<?php
require(".././connect.php");
$id = $_REQUEST['id'];
$query11 = $con->query("select * from `daily_event` where id='$id'");
$eventdata = $query11->fetch();
if (!$eventdata) {
    echo "<div class='alert alert-warning m-4'>Event not found.</div>";
    exit;
}
$conceptname = $eventdata['title'];
$date = $eventdata['date'];
$time = $eventdata['time'];
$organizer = $eventdata['organizer'] ?? 'Unknown';
$description = $eventdata['description'] ?? 'No description';
?>

<div class="card border-0 shadow-sm rounded-4 mt-4 mx-3 overflow-hidden">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-pink"><i class="fa fa-info-circle me-2"></i>Event Details</h5>
        <button onclick="return_back_event()" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="fa fa-arrow-left me-1"></i> Back
        </button>
    </div>
    
    <div class="card-body p-4">
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-light small fw-bold text-uppercase">
                    <tr>
                        <th colspan="2" class="text-pink px-3">Primary Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="bg-light ps-3" style="width: 25%;">Event Name</th>
                        <td class="fw-bold ps-3"><?php echo ucfirst(htmlspecialchars($conceptname)); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">Date & Time</th>
                        <td class="ps-3">
                            <i class="fa fa-calendar-alt text-pink me-1"></i> <?php echo date('d M Y', strtotime($date)); ?> 
                            <i class="fa fa-clock text-pink ms-3 me-1"></i> <?php echo date('h:i A', strtotime($time)); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">Organizer</th>
                        <td class="ps-3"><?php echo ucfirst(htmlspecialchars($organizer)); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">Location</th>
                        <td class="ps-3"><?php echo htmlspecialchars($eventdata['location'] ?? 'Not specified'); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">Description</th>
                        <td class="ps-3 text-wrap"><?php echo ucfirst(htmlspecialchars($description)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h6 class="fw-bold text-pink mt-4 mb-3"><i class="fa fa-music me-2"></i>Program Songs</h6>
        <div class="table-responsive">
            <table class="table table-sm table-hover border">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 80px;">S.No</th>
                        <th>Song Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = $con->query("SELECT songslistid FROM `addsongsinevent` WHERE eventid='$id' ");
                    $hasSongs = false;
                    if ($sql1->rowCount() > 0) {
                        $cnt = 1;
                        while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                            if (!empty($row1['songslistid'])) {
                                $songiddd = $row1['songslistid'];
                                $sql2 = $con->query("SELECT title FROM `song_master` WHERE id IN ($songiddd)");
                                while ($row2 = $sql2->fetch(PDO::FETCH_ASSOC)) {
                                    $hasSongs = true;
                                    echo "<tr><td class='ps-3'>{$cnt}</td><td class='fw-bold'>".ucfirst(htmlspecialchars($row2['title']))."</td></tr>";
                                    $cnt++;
                                }
                            }
                        }
                    }
                    if (!$hasSongs) {
                        echo "<tr><td colspan='2' class='text-center text-muted p-3'>No songs added to this event.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function return_back_event() {
    $.get("/rythm/professional_singer/addevent.php", function(data) {
        $('.main-content').html(data);
    });
}
</script>
