<?php
require ("../connect.php");
?>

<div class="px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold text-pink"><i class="fa fa-calendar-check me-2"></i>Event Management</h4>
        <div class="btn-group rounded-pill border-pink overflow-hidden shadow-sm">
            <button class="btn btn-pink px-4 py-2" id="btn-calendar" onclick="toggleView('calendar', this)">Calendar</button>
            <button class="btn btn-outline-pink px-4 py-2" id="btn-list" onclick="toggleView('list', this)">List View</button>
        </div>
    </div>

    <!-- Calendar View (Hidden by default) -->
    <div id="calendarView" class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="display: none; min-height: 600px;">
        <div id="calendar"></div>
    </div>

    <!-- List View (Shown by default) -->
    <div id="listView" class="card border-0 shadow-sm rounded-4 mb-4" style="min-height: 600px;">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0 fw-bold text-pink">Event Inventory</h5>
            <button class="btn btn-pink rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                <i class="fa fa-plus me-1"></i> Create Event
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-uppercase">
                        <tr>
                            <th class="ps-4" style="width: 150px;">Date</th>
                            <th style="width: 120px;">Time</th>
                            <th style="min-width: 200px;">Event Title</th>
                            <th style="width: 180px;">Organizer</th>
                            <th class="text-end pe-4" style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $events = $con->query("SELECT * FROM daily_event ORDER BY date DESC LIMIT 30");
                        while($ev = $events->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td class="ps-4 fw-bold"><?php echo date('d M Y', strtotime($ev['date'])); ?></td>
                                <td class="text-muted small"><?php echo date('h:i A', strtotime($ev['time'])); ?></td>
                                <td class="fw-bold text-wrap"><?php echo htmlspecialchars($ev['title']); ?></td>
                                <td class="text-wrap"><?php echo htmlspecialchars($ev['organizer']); ?></td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-3">
                                        <button class="btn btn-sm text-pink border-0 p-0" onclick="addsongs(<?php echo $ev['id']; ?>)" title="Add Song">
                                            <i class="fa fa-music fa-lg"></i>
                                        </button>
                                        <button class="btn btn-sm text-pink border-0 p-0" onclick="editEvent(<?php echo $ev['id']; ?>)" title="Edit Event">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </button>
                                        <button class="btn btn-sm text-danger border-0 p-0" onclick="deleteEvent(<?php echo $ev['id']; ?>)" title="Delete Event">
                                            <i class="fa fa-trash fa-lg"></i>
                                        </button>
                                        <button class="btn btn-sm text-pink border-0 p-0" onclick="viewEventDetails(<?php echo $ev['id']; ?>)" title="View Details">
                                            <i class="fa fa-eye fa-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal -->
<div class="modal fade" id="myModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4">
      <div class="modal-header border-bottom">
        <h5 class="modal-title fw-bold text-pink">Create New Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="meetingForm" method="POST" action="/rythm/professional_singer/scheduleinsert.php">
            <div class="mb-3">
                <label class="form-label small fw-bold">Date</label>
                <input type="date" class="form-control rounded-pill" name="date" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Time</label>
                <input type="time" class="form-control rounded-pill" name="time" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Event Title</label>
                <input type="text" class="form-control rounded-pill" name="title" placeholder="Enter title" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Description</label>
                <textarea class="form-control rounded-3" name="description" rows="3" placeholder="Enter details" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Location</label>
                <input type="text" class="form-control rounded-pill" name="location" placeholder="Enter location" required>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label small fw-bold">Organizer</label>
                    <input type="text" class="form-control rounded-pill" name="organizer" placeholder="Name" required>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label small fw-bold">Registration Fee</label>
                    <input type="number" class="form-control rounded-pill" name="amount" value="0" required>
                </div>
            </div>
            <button type="submit" class="btn btn-pink w-100 rounded-pill py-2 fw-bold mt-2 shadow">Save Event</button>
        </form>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<style>
    .fc-header-toolbar { margin-bottom: 2rem !important; }
    .fc-button { 
        background: #fff !important; 
        border: 1px solid #eee !important; 
        color: #333 !important; 
        text-shadow: none !important;
        box-shadow: none !important;
        border-radius: 20px !important;
        padding: 5px 15px !important;
        text-transform: capitalize !important;
    }
    .fc-state-active { background: var(--rythm-pink) !important; color: #fff !important; }
    .fc-day-header { background: #f8f9fa; padding: 10px !important; font-weight: 600; font-size: 0.8rem; }
    .fc-event { background-color: var(--rythm-pink) !important; border: none !important; padding: 2px 5px !important; border-radius: 4px !important; }
    .text-pink { color: var(--rythm-pink) !important; }
    .btn-pink.active { background-color: var(--rythm-deep-pink) !important; box-shadow: inset 0 3px 5px rgba(0,0,0,0.125); font-weight: bold; }
    .btn-outline-pink { border-color: var(--rythm-pink); color: var(--rythm-pink); }
    .btn-outline-pink:hover { background-color: var(--rythm-pink); color: white; }
    .btn-outline-pink.active { background-color: var(--rythm-pink); color: white; }
    .border-pink { border-color: var(--rythm-pink) !important; }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
    $(document).ready(function () {
      $('#calendar').fullCalendar({
        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        events: '/rythm/professional_singer/meet.php',  
        dayClick: function (date) {
          const dateStr = date.format('YYYY-MM-DD');
          $('input[name="date"]').val(dateStr);
          const modal = new bootstrap.Modal(document.getElementById('myModal'));
          modal.show();
        },
        eventClick: function (event) {
          viewEventDetails(event.id);
        }
      });
    });

    function toggleView(view, btn) {
        $('.btn-group button').removeClass('btn-pink active').addClass('btn-outline-pink');
        $(btn).addClass('btn-pink active').removeClass('btn-outline-pink');
        
        if (view === 'calendar') {
            $('#calendarView').fadeIn(300);
            $('#listView').hide();
            $('#calendar').fullCalendar('render');
        } else {
            $('#calendarView').hide();
            $('#listView').fadeIn(300);
        }
    }
    
    // Set initial active state correctly (List View default)
    $(document).ready(function() {
        $('#btn-list').addClass('btn-pink active').removeClass('btn-outline-pink');
        $('#btn-calendar').addClass('btn-outline-pink').removeClass('btn-pink active');
    });

</script>
