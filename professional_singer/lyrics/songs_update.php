<?php
require '../../connect.php';
include("../../user.php");
include("getid3/getid3.php");

$error1 = "Select Language!";
$error2 = "Sorry, there was an error uploading your file";

$upload = 1;

function doesFileExist($target_file, $fileName){
  if (file_exists($target_file)) {
    return true;
  }

  return false;
}

function showAlert($message){
  echo "<script> alert(' $message '); </script>";
}

$FileEntryCount = 0;

function moveFileToDirectory($file, $file_name, $category){
  global $error2;
  global $upload;
  global $FileEntryCount;

  if(!move_uploaded_file($file, $file_name)){
    showAlert($error2);
    $upload = 0;
  }else {
    echo $category . " File Uploaded <br/><br/>";
    $FileEntryCount += 1;
  }
}

function deleteFile($file){ 
    unlink($file);
}

function deleteOldFile($id, $key, $dir){
  global $con;

  $sql_query = "SELECT $key
                FROM `song_master`
                WHERE id = $id";

  $result = $con->query($sql_query); 

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    deleteFile($dir . $row[$key]);
  }
}

function updateLocation($id, $key, $value){
  global $con;

  $sql_query = "UPDATE `song_master`
                SET `$key` = '".$value."'
                WHERE id = $id";

  $con->query($sql_query);
}

function setDuration($file_location, $id){
  global $con;

  $getID3 = new getID3;
  $ThisFileInfo = $getID3->analyze($file_location);
  $duration = $ThisFileInfo['playtime_string'];

  $sql_query = "UPDATE `song_master`
                SET `duration` = '".$duration."'
                WHERE `id` = $id";

  $con->query($sql_query);
}

if(isset($_POST['Update'])) {
  $id = $_POST['get_id'];
  $title = $_POST['title'];
  //$description = $_POST['description'];
  $movie_id = $_POST['movie_id'];
  $language_id = $_POST['language_id'];
  //$year = $_POST['year'];
  $duration = $_POST['duration'];
  $file_location = basename($_FILES["song_file"]["name"]);
  $lyrics_location = basename($_FILES["lyrics_file"]["name"]);
  $english_lyrics_location = basename($_FILES["english_lyrics_file"]["name"]);

 // $sql_query = "UPDATE `song_master` SET `title` = '$title',`description` = '$description',`movie_id` = '$movie_id', `language_id` = '$language_id',`year` = '$year',`duration` = '$duration' WHERE `id` = '$id'";
				
  $sql_query = "UPDATE `song_master`
                SET `title` = '$title',
                `movie_id` = '$movie_id', 
                `language_id` = '$language_id',
                `duration` = '$duration'
                WHERE `id` = '$id'";

  $con->query($sql_query);

  $song_dir = "../../songs/";
  $lyrics_dir = "../../lyrics/";
  $english_lyrics_dir = "../../lyrics/english/";

  switch ($language_id) {
      case "1":
        $song_dir = $song_dir . "tamil/";
        $lyrics_dir = $lyrics_dir . "tamil/";
        $english_lyrics_dir = $english_lyrics_dir . "tamil/";
        break;

      case "2":
        $song_dir = $song_dir . "hindi/";
        $lyrics_dir = $lyrics_dir . "hindi/";
        $english_lyrics_dir = $english_lyrics_dir . "hindi/";
        break;

      case "3":
        $song_dir = $song_dir . "malayalam/";
        $lyrics_dir = $lyrics_dir . "malayalam/";
        $english_lyrics_dir = $english_lyrics_dir . "malayalam/";
        break;

      default:
        showAlert($error1);
    }

  $song_file = "";
  $lyrics_file = "";
  $english_lyrics_file = "";


  // Song Upload
  $song_file = $song_dir . $file_location;
  if(strlen($file_location)){
    if(!doesFileExist($song_file, $file_location)){
      deleteOldFile($id, "file_location", $song_dir);
      updateLocation($id, "file_location", $file_location);
      moveFileToDirectory($_FILES["song_file"]["tmp_name"], $song_file, "Song");
      setDuration($song_file, $id);
    }else {
      deleteFile($song_file);
      moveFileToDirectory($_FILES["song_file"]["tmp_name"], $song_file, "Song");
      setDuration($song_file, $id);
    }
  }

  // Lyrics Upload
  $lyrics_file = $lyrics_dir . $lyrics_location;
  if(strlen($lyrics_location)){
    if(!doesFileExist($lyrics_file, $lyrics_location)){
      deleteOldFile($id, "lyrics_location", $lyrics_dir);
      updateLocation($id, "lyrics_location", $lyrics_location);
      moveFileToDirectory($_FILES["lyrics_file"]["tmp_name"], $lyrics_file, "Lyrics");
    }else {
      deleteFile($lyrics_file);
      moveFileToDirectory($_FILES["lyrics_file"]["tmp_name"], $lyrics_file, "Lyrics");
    }
  }

  // English Lyrics Upload
  $english_lyrics_file = $english_lyrics_dir . $english_lyrics_location;
  if(strlen($english_lyrics_location)){
    if(!doesFileExist($english_lyrics_file, $english_lyrics_location)){
      deleteOldFile($id, "english_lyrics_location", $english_lyrics_dir);
      updateLocation($id, "english_lyrics_location", $english_lyrics_location);
      moveFileToDirectory($_FILES["english_lyrics_file"]["tmp_name"], $english_lyrics_file, "English Lyrics");
    }else {
      deleteFile($english_lyrics_file);
      moveFileToDirectory($_FILES["english_lyrics_file"]["tmp_name"], $english_lyrics_file, "English Lyrics");
    }
  }

  if($upload == 1 || $FileEntryCount == 3) echo "Song Entry Completed!"; 
  elseif($FileEntryCount < 3) echo "Song Entry Not Completed!";

  header("Refresh: 2; url=../../index.php");
 // header("url=../../index.php");
  
}

?>