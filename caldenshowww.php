<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Calendar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <style>
    #calendar {
      margin-bottom: 20px;
    }

    /* Center the modal vertically */
    .modal {
      text-align: center;
    }

    .modal-content {
      padding: 20px;
    }

    #btnnsave {
      border: none;
      background: #00cc00;
      color: white;
      border-radius: 20px;
      width: 40%;
      /* Take up full width */
      height: 50px;
      /* Adjust the height as needed */
      margin-top: 20px;
      /* Add some top margin */
    }

    #btnnsave:hover {
      background: #008000;
    }

    .form-group {
      text-align: left;
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input,
    textarea,
    select {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    .fc-event-container {
      background: blue;
      color: white;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        events: '/neha/meet.php',
        dayClick: function() {
          $('#myModal').modal('show');
        },
        eventClick: function(event) {
          var eventId = event.id;

          $.ajax({
            type: "GET",
            url: "/neha/eventsdetailsshow.php?id=" + eventId,
            success: function(data) {

              $("#main_content").html(data);
            }
          })


        }
      });
    });
  </script>
</head>

<body>
  <div class="container">
    <div id="calendar"></div>
    <!-- Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h2 style="color:orange;font-weight:600;">Create Meeting Schedule</h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <div class="meeting-card">
              <form id="meetingForm" method="POST" action="scheduleinsert.php">
                <div class="form-group">
                  <label for="date">Date:</label>
                  <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                  <label for="time">Time:</label>
                  <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                  <label for="title">Title:</label>
                  <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                  <label for="organizer">Organizer:</label>
                  <input type="text" id="organizer" name="organizer" required>
                </div>
                <div class="form-group">
                  <label for="amount">Amount:</label>
                  <input type="number" id="amount" name="amount" required>
                </div>

                <!-- <div class="form-group">
                <label for="songs">Songs:</label>
                <input type="text" id="songs" name="songs">
            </div>-->

                <button type="submit" id="btnnsave">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>