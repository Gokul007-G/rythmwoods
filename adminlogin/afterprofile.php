<?php

include("connect.php");

    $firstname=$_REQUEST['firstname'];
	$lastname=$_REQUEST['lastname'];
	$email=$_REQUEST['email'];
	$contact=$_REQUEST['contact'];
	$about=$_REQUEST['about'];
	$facebook=$_REQUEST['facebook'];
	$twitter=$_REQUEST['twitter'];
	$instagram=$_REQUEST['instagram'];
	$youtube=$_REQUEST['youtube'];
	
	$dyidget=$_REQUEST['dyidset'];
	
// Check if the file is uploaded successfully
if(isset($_FILES['imagevedio_1']) && $_FILES['imagevedio_1']['error'] === UPLOAD_ERR_OK) {
    // File details
    $file_name = $_FILES['imagevedio_1']['name'];
    $file_size = $_FILES['imagevedio_1']['size'];
    $file_tmp = $_FILES['imagevedio_1']['tmp_name'];
    $file_type = $_FILES['imagevedio_1']['type'];

    // You can process the uploaded file here, for example, move it to a specific directory
    move_uploaded_file($file_tmp, "/rythm/uploads/" . $file_name);

    // Now you can use $file_name, $file_size, $file_tmp, $file_type as needed in your insertion logic
} else {
    // Handle file upload error if any
    echo "File upload failed!";
}

for ($i = 1; $i < $dyidget; $i++) {
    $title_1 = $_REQUEST['title_' . $i];
	$year_1=$_REQUEST['year_'. $i];
	$awardedby_1=$_REQUEST['awardedby_'. $i];
	$description_1=$_REQUEST['description_'. $i];
	$youtubeLink_1=$_REQUEST['youtubeLink_'. $i];
	$pjtitle_1=$_REQUEST['pjtitle_'. $i];
	$link_1=$_REQUEST['link_'. $i];
	$link_2=$_REQUEST['link_'. $i];
	$link_3=$_REQUEST['link_'. $i];
	$link_4=$_REQUEST['link_'. $i];
	$link_5=$_REQUEST['link_'. $i];
	
	
	
	if(isset($_FILES['image_'.$i])) {
    // File details
    $file_name = $_FILES['image_'.$i]['name'];      // The original name of the file
    $file_size = $_FILES['image_'.$i]['size'];      // The size of the file in bytes
    $file_tmp = $_FILES['image_'.$i]['tmp_name'];   // The temporary filename of the file in which the uploaded file was stored on the server
    $file_type = $_FILES['image_'.$i]['type'];      // The MIME type of the file

    // Example: Move the uploaded file to a specific directory
    $upload_dir = "/path/to/upload/directory/";
    move_uploaded_file($file_tmp, $upload_dir . $file_name);

    // Now you can use $file_name, $file_size, $file_tmp, $file_type as needed
}
	
}	
	

	
?>
