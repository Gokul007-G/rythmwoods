<?php

require("./connect.php");

$amount = $_REQUEST['amount'];
$dateee = $_REQUEST['dateee']; 
$paymentmthod = $_REQUEST['paymethod'];
$eventid = $_REQUEST['id'];
$tableamt=$_REQUEST['pendingamt'];
$type=$_SESSION['title'];


	if ($amount != '' && $dateee != '' && $paymentmthod != '') {
		if($tableamt>$amount){
		$sql = $con->query("INSERT INTO `eventpayment`(`id`, `eventid`, `amount`, `date`, `paymentmethod`, `created_by`,`singer_type`) VALUES (NULL,'$eventid','$amount','$dateee','$paymentmthod',now(),'$type')");
        
		if ($sql) {
			echo 1; // Successful insertion
		} 
		
	  }
	 else 
		{
			echo 2; // Display the error message
		}
	}
	 else {
		echo 0; // Incomplete data
	}


?>
