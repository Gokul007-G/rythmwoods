<?php
require 'connect.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Function to get all music directors from the database
function getAllMusicDirectors($con) { 
 
    $musicDirectors = array();
	
    $sql = "SELECT * FROM music_directors";
	
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $musicDirectors[] = $row;
        }
    }

    return $musicDirectors;
}

function getAllLanguages($con) { 
 
    $language = array();
	
    $sql = "SELECT * FROM languages";
	
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $language[] = $row;
        }
    }

    return $language;
}

function getEventList($con) { 
 
    $events = array();
	
    $sql = "SELECT * FROM daily_event";
	
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    return $events;
}

function getAllsongs($con) {   
    $songs = array();

    $sql = "SELECT song_master.id AS song_id,
    song_master.title,
    song_master.language_id,
    
    (SELECT lng.language_name
        FROM languages AS lng
        WHERE lng.id = song_master.language_id)
        AS language_name

    FROM song_master
    ORDER BY song_master.title";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $songs[] = $row;
        }
    }

    return $songs;
}

function addMusicDirector($con, $directorName) {
    $sql = "INSERT INTO music_directors (music_director_name) VALUES ('$directorName')";
    $result = $con->query($sql);
    return $result;
}

// Check if the action parameter is set to getAllMusicDirectors
if (isset($_GET['action']) && $_GET['action'] === 'getAllMusicDirectors') {	
	$a = new Connect();
	$con = $a->db_connect();
    $musicDirectorsData = getAllMusicDirectors($con);

    // Return the data as JSON
    echo json_encode(array("data" => $musicDirectorsData));
} 

if (isset($_GET['action']) && $_GET['action'] === 'getAllLanguages') {	
	$a = new Connect();
	$con = $a->db_connect();
    $languageData = getAllLanguages($con);

    // Return the data as JSON
    echo json_encode(array("data" => $languageData));
} 

if (isset($_GET['action']) && $_GET['action'] === 'getEventList') {	
	$a = new Connect();
	$con = $a->db_connect();
    $eventList = getEventList($con);

    // Return the data as JSON
    echo json_encode(array("data" => $eventList));
} 

if (isset($_GET['action']) && $_GET['action'] === 'getAllsongs') {
	$a = new Connect();
	$con = $a->db_connect();
    $songsData = getAllsongs($con);

    // Return the data as JSON
    echo json_encode(array("data" => $songsData));
}

if ($_GET['action'] === 'addMusicDirector' && isset($_POST['directorName'])) {
	$a = new Connect();
	$con = $a->db_connect();
    // Call the function to add a music director
    $directorName = $_data['directorName'];
    // echo $directorName;
    $result = addMusicDirector($con, $directorName);

    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("error" => "Failed to add music director"));
    }
}

if ($_GET['action'] === 'addEvent') {
	$a = new Connect();
	$con = $a->db_connect();	
	$title = $_POST['title'];	
    $description = $_POST['description'];	
    $eventDate = date('Y-m-d', strtotime($_POST['eventDate']));
    $eventTime = date('H:i:s', strtotime($_POST['eventTime']));	
    $organizer = $_POST['organizer'];
    $amount = $_POST['amount'];
	
    // Set the 'songs' column to null
    $songs = null;
	$usersid=1;
	$username='nehagirish';

    // SQL query to insert data into the 'daily_event' table
    $sql = $con->query("INSERT INTO `daily_event`(`id`,`users_id`,`date`, `time`, `title`, `description`, `organizer`, `amount`, `songs`, `created_on`,`createdby`) VALUES (NULL,'$usersid','$eventDate','$eventTime','$title','$description','$organizer','$amount','$songs',now(),'$username')");

    if ($sql) {
        // Data inserted successfully
        $response = array('status' => 'success', 'message' => 'Event saved successfully');
    } else {
        // Error in inserting data
        $response = array('status' => 'error', 'message' => 'Error: ' . $con->error);
    }

   
    echo json_encode($response);
}


if ($_GET['action'] === 'updateEvent') {
	$a = new Connect();
    $con = $a->db_connect();

    $eventId = $_POST['eventId']; 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $eventDate = date('Y-m-d', strtotime($_POST['eventDate']));
    $eventTime = date('H:i:s', strtotime($_POST['eventTime']));
    $organizer = $_POST['organizer'];
    $amount = $_POST['amount'];
    $songs = $_POST['songs']; 
    
    $lastModified = now();
    $username = 'nehagirish';
	$usersid=1;
    // SQL query to update data in the 'daily_event' table
    $sql = "UPDATE `daily_event` 
            SET 
			users_id='$usersid',            
            `date`='$eventDate',
            `time`='$eventTime',
			`title`='$title',
            `description`='$description',
            `organizer`='$organizer',
            `amount`='$amount',
            `songs`='$songs',
            `last_modified`='$lastModified',
            `last_modified_by`='$username' 
            WHERE `id`='$eventId'";

    if ($sql) {
        // Data updated successfully
        $response = array('status' => 'success', 'message' => 'Event updated successfully');
    } else {
        // Error in updating data
        $response = array('status' => 'error', 'message' => 'Error: ' . $con->error);
    }

    echo json_encode($response);
}

// Function to fetch a specific record from the music_directors table based on ID
function getMusicDirectorById($con, $id) {
	$a = new Connect();
	$con = $a->db_connect();
    $sql = "SELECT * FROM music_directors WHERE id = $id";  
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return "Record not found";
    }
}

    if ($_GET["action"] == "addSong") {
		$a = new Connect();
	$con = $a->db_connect();
        // Get the form data
        $songName = $_POST["songName"];
        $directorId = $_POST["directorId"];
		$langId=$_POST["languageId"];
		
$file_name = $_FILES["audioFile"]["name"];
    $tempname1 = $_FILES["audioFile"]["tmp_name"];
    $folder1 = "../assets/songs/" . $file_name;

    $file_name1 = $_FILES["pdfFile"]["name"];
    $tempname11 = $_FILES["pdfFile"]["tmp_name"];
    $folder11 = "../assets/pdf/" . $file_name1;

    $sql_query1 = "INSERT INTO `song_master`(`title`,`language_id`,`music_director`,`file_location`,`lyrics_location`)VALUES ('$songName','$directorId','$langId','$file_name','$file_name1')";

    if ($con->query($sql_query1)) {
        $msg1 = array('status' => 'success', 'message' => 'Song Added Successfully');
    } else {
        $msg1 = "Failed to upload audio file: " . $con->error;
    }

    if (move_uploaded_file($tempname1, $folder1)) {
        $msg2 = "Audio file moved successfully";
    } else {
        $msg2 = "Failed to move audio file";
    }

    if (move_uploaded_file($tempname11, $folder11)) {
        $msg3 = "Lyrics file moved successfully";
    } else {
        $msg3 = "Failed to move lyrics file";
    }
	echo json_encode($msg1);
}
	
 

?>
