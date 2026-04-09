<?php
session_start();
require_once("includes/config.php");

if (!isset($_POST['id'])) exit;

$id = intval($_POST['id']);
$stmt = $con->prepare("SELECT * FROM daily_event WHERE id = ?");
$stmt->execute([$id]);
$ev = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ev) exit;
?>
<div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header border-bottom bg-light">
        <h5 class="modal-title fw-bold text-pink"><i class="fa fa-edit me-2"></i>Edit Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="editEventForm" onsubmit="updateEvent(event)">
            <input type="hidden" name="id" value="<?php echo $ev['id']; ?>">
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Event Title</label>
                <input type="text" class="form-control rounded-pill border-2" name="title" value="<?php echo htmlspecialchars($ev['title']); ?>" required>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold text-muted">Date</label>
                    <input type="date" class="form-control rounded-pill border-2" name="date" value="<?php echo $ev['date']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold text-muted">Time</label>
                    <input type="time" class="form-control rounded-pill border-2" name="time" value="<?php echo $ev['time']; ?>" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Location</label>
                <input type="text" class="form-control rounded-pill border-2" name="location" value="<?php echo htmlspecialchars($ev['location'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Organizer</label>
                <input type="text" class="form-control rounded-pill border-2" name="organizer" value="<?php echo htmlspecialchars($ev['organizer'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Description</label>
                <textarea class="form-control rounded-3 border-2" name="description" rows="3"><?php echo htmlspecialchars($ev['description'] ?? ''); ?></textarea>
            </div>

            <div class="text-end mt-4">
                <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-pink rounded-pill px-4 fw-bold shadow-sm">Update Changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
