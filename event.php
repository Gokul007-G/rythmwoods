<?php
/**
 * Rythm Events - Unified Professional Version
 */
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$pageTitle = "Rythm - Events";
include("includes/header.php");
?>

<div class="feed-area py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0" style="color: var(--rythm-deep-pink);">Events</h2>
        <button class="btn btn-pink rounded-pill px-4" onclick="location.href='/rythm/professional_singer/addevent.php'"><i class="fa fa-plus me-2"></i> Create Event</button>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-uppercase">
                        <tr>
                            <th class="ps-4" style="width: 150px;">Date</th>
                            <th style="width: 120px;">Time</th>
                            <th style="min-width: 250px;">Event Title</th>
                            <th style="width: 200px;">Organizer</th>
                            <th class="text-end pe-4" style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php
                        try {
                            $getevents = $con->query("SELECT * FROM `daily_event` ORDER BY id DESC LIMIT 20");
                            if ($getevents->rowCount() == 0) {
                                echo "<tr><td colspan='5' class='text-center py-5 text-muted'>No upcoming events found.</td></tr>";
                            }
                            while ($edata = $getevents->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td class="ps-4 fw-bold"><?php echo htmlspecialchars($edata['date']); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($edata['time']); ?></td>
                            <td class="fw-bold text-wrap text-pink"><?php echo htmlspecialchars($edata['title']); ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($edata['organizer'] ?? 'Unknown'); ?></td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-3">
                                    <button class="btn btn-sm text-pink border-0 p-0" onclick="addsongs(<?php echo $edata['id']; ?>)" title="Add Song">
                                        <i class="fa fa-music fa-lg"></i>
                                    </button>
                                    <button class="btn btn-sm text-pink border-0 p-0" onclick="editEvent(<?php echo $edata['id']; ?>)" title="Edit Event">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </button>
                                    <button class="btn btn-sm text-danger border-0 p-0" onclick="deleteEvent(<?php echo $edata['id']; ?>)" title="Delete Event">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </button>
                                    <button class="btn btn-sm text-pink border-0 p-0" onclick="viewEventDetails(<?php echo $edata['id']; ?>)" title="View Details">
                                        <i class="fa fa-eye fa-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } catch(PDOException $e) {
                            echo "<tr><td colspan='5' class='text-center py-4 text-danger'>Error: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
// Include Right Panel
include("includes/right_panel.php"); 
?>

<style>
.transition-hover {
    transition: transform 0.2s, box-shadow 0.2s;
}
.transition-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(255, 128, 179, 0.2) !important;
}
.btn-outline-pink {
    color: var(--rythm-pink);
    border-color: var(--rythm-pink);
}
.btn-outline-pink:hover {
    background-color: var(--rythm-pink);
    color: white;
}
.bg-pink {
    background-color: var(--rythm-pink);
}
</style>

<?php include("includes/footer.php"); ?>
