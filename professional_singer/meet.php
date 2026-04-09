<?php
require(".././connect.php");



// Database query
$sql = $con->query("SELECT * FROM `daily_event`");
//echo "SELECT * FROM `meetinginsert`";


$events = [];


    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Convert the date to the format FullCalendar expects (Y-m-d H:i:s)
        $start = date('Y-m-d H:i:s', strtotime($row['date'] . ' ' . $row['time']));

        // Add the event to the array with 'start' property
        $events[] = [
            'title' => $row['title'],
            'start' => $start,
			'id' => $row['id'],
            // Add other event properties as needed
        ];
    }


// Return the events in JSON format
echo json_encode($events);
?>
