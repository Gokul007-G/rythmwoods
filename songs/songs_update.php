<?php 
require '../../connect.php'; // Database connection

// Function to show JavaScript alerts
function showAlert($message){
    echo "<script>alert('$message');</script>";
}

// Check if the form is submitted
if(isset($_POST['Update'])) {
    $id = $_POST['get_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $movie_id = $_POST['movie_id'];
    $language_id = $_POST['language_id'];

    // Handle file uploads
    $song_file = $_FILES["song_file"]["name"] ? basename($_FILES["song_file"]["name"]) : null;
    $lyrics_file = $_FILES["lyrics_file"]["name"] ? basename($_FILES["lyrics_file"]["name"]) : null;
    
    // Directory paths
    $song_dir = "../../music/";
    $lyrics_dir = "../../lyrics/";

    // Assign language-based directories
    switch ($language_id) {
        case "1": // Tamil
            $song_dir .= "tamil/";
            $lyrics_dir .= "tamil/";
            break;
        case "2": // Hindi
            $song_dir .= "hindi/";
            $lyrics_dir .= "hindi/";
            break;
        case "3": // Malayalam
            $song_dir .= "malayalam/";
            $lyrics_dir .= "malayalam/";
            break;
        default:
            showAlert("Invalid Language Selection!");
            exit;
    }

    // File paths
    $song_path = $song_file ? $song_dir . $song_file : null;
    $lyrics_path = $lyrics_file ? $lyrics_dir . $lyrics_file : null;

    // Fetch existing file paths for cleanup
    $stmt = $con->prepare("SELECT file_location, lyrics_location FROM song_master WHERE id = ?");
    $stmt->execute([$id]);
    $old_files = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete old files if new ones are uploaded
    if ($song_path && file_exists($song_dir . $old_files['file_location'])) {
        unlink($song_dir . $old_files['file_location']);
    }
    if ($lyrics_path && file_exists($lyrics_dir . $old_files['lyrics_location'])) {
        unlink($lyrics_dir . $old_files['lyrics_location']);
    }

    // Move new uploaded files
    if ($song_file) move_uploaded_file($_FILES["song_file"]["tmp_name"], $song_path);
    if ($lyrics_file) move_uploaded_file($_FILES["lyrics_file"]["tmp_name"], $lyrics_path);

    // Update Query with prepared statements
    $sql_query = "UPDATE `song_master` 
                  SET `title` = ?, 
                      `movie_id` = ?, 
                      `language_id` = ?, 
                      `status` = ?, 
                      `file_location` = COALESCE(?, file_location), 
                      `lyrics_location` = COALESCE(?, lyrics_location)
                  WHERE `id` = ?";

    $stmt = $con->prepare($sql_query);
    $stmt->execute([$title, $movie_id, $language_id, $status, $song_file, $lyrics_file, $id]);

    // Redirect after update
    echo "<script>alert('Song updated successfully!'); window.location.href='../../index.php';</script>";
}
?>
