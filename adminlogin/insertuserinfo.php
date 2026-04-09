<?php

include("connect.php");

    $Inputfirstname = $_REQUEST['Inputfirstname'];
	$Inputlastname = $_REQUEST['Inputlastname'];
    $contactno = $_REQUEST['contactno'];
    $email = $_REQUEST['email'];
	$inputpassword=$_REQUEST['password'];
	$password=md5($inputpassword);
    $selectedValue = $_POST["typeofcategory"];
	if($Inputfirstname!='' && $Inputlastname!='' && $contactno!='' && $email!='' && $inputpassword!='' && $selectedValue!='nd')
	{
		  if($selectedValue==1)
		  {
			  $title='singer';
		  }
		else if($selectedValue==2)
		{
			$title='amateur singer';
		}
		else if($selectedValue==3)
		{
			$title='musician';
		}
		else if($selectedValue==4)
		{
			$title='bands';
		}
		else if($selectedValue==5)
		{
			$title='event managers';
		}
		else if($selectedValue==6)
		{
			$title='lighting';
		}
		else if($selectedValue==7)
		{
			$title='sounds';
		}
    $updateQuery = $con->query("INSERT INTO `user_master`(`id`, `users_id`, `role_master_id`, `name`, `last_name`, `user_name`, `password`, `email`, `title`, `gender`, `date_of_birth`, `experience`, `tamil`, `malayalam`, `hindi`, `status`, `mobile_no`, `created_on`, `modified_on`)VALUES (NULL,'$selectedValue','$selectedValue','$Inputfirstname','$Inputlastname','$Inputfirstname','$password','$email','$title',NULL,'0000-00-00',NULL,NULL,NULL,NULL,'0','$contactno',now(),'')");
// print_r($updateQuery);
//echo "INSERT INTO `user_master`(`id`, `users_id`, `role_master_id`, `name`, `last_name`, `user_name`, `password`, `email`, `title`, `gender`, `date_of_birth`, `experience`, `tamil`, `malayalam`, `hindi`, `status`, `mobile_no`, `created_on`, `modified_on`)VALUES (NULL,'$selectedValue','$selectedValue','$Inputfirstname','$Inputlastname','$Inputfirstname','$password','$email','$title',NULL,'0000-00-00',NULL,NULL,NULL,NULL,'0','$contactno',now(),'')";

    if($updateQuery)
	{
		echo "<script>alert('Signup Successfully!')</script>";
		echo "<script>window.location.href='/rythm/login/login.php'</script>";
	}
	else
	{
				echo "<script>alert('Somewent Wrong!')</script>";
		echo "<script>window.location.href='/rythm/login/register.php'</script>";
     }
 }
 else
 {
	 echo "<script>alert('Required parameters not set!')</script>";
		echo "<script>window.location.href='/rythm/login/register.php'</script>";
 }
?>
