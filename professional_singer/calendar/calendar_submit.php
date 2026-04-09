<?php

require '../config.php';
?>
<?php


    $title = $_REQUEST['title'];
  //  $description = $_REQUEST['description'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $time = $_REQUEST['time'];
    //$status = $_REQUEST['status'];
	$today = date("Y-m-d H:i:s"); 
	
	
	$staff_name=$_REQUEST['staff_name'];
//print_r($singers_name);
//$stud_hobby = $_POST['txt_hobby']; 
    		
	$staff_name_arr="";
	
	foreach($staff_name as $staff_name_arr){  
    $staff_name_value .= $staff_name_arr.",";  
	}  
	
	
	
   $sql = $con->query("insert into events(title,description,start_date,end_date,time,created)values('$title','$staff_name_value','$start_date','$end_date','$time',now())");
//    echo  "insert into events(title,description,start_date,end_date,time,created)values('$title','$staff_name_value','$start_date','$end_date','$time',now())";

    if ($sql) {
       echo 1;
   }

?>