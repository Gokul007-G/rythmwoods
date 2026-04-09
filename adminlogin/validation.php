<?php

Session_start();

require('connect.php');

$username=$_REQUEST['Inputusername'];
//echo "<pre>";print_r($username);exit();
$upassword=$_REQUEST['InputPassword'];
$md5password=md5($upassword);
	$res = $con->query("SELECT * FROM `admin_login` where username='$username'");
	//echo "SELECT user_name,password FROM user_master where user_name='$username' and user_status=1";
$num_of_rows = $res->rowCount();

	if($num_of_rows>0)
	{
		
		while($row = $res->fetch(PDO::FETCH_ASSOC))
		{
			
			$password=$row['password'];
			 $user_name=$row['username'];
		if($password==$md5password)
		{
			//echo "if";
			
			$_SESSION['username']=$row['username'];
			
			$_SESSION['rolemaster_id']=$row['id'];
			//$_SESSION['title']=$row['title'];
			
			$_SESSION['start'] = time();   $_SESSION['expire'] = $_SESSION['start'] + (60*5);
				
			header('Location:adminhomepage.php');
		}
		else
		{
			?>
	<script>
		alert("password Does Not Matched..");
		window.location='login.php';
	</script>
			<?php
		}
	} 	 
}
else
{
	?>
	<script>
	alert("User Name Does Not Matched..");
	window.location='login.php';
	</script>
	<?php
} 
?>