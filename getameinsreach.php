<?php
session_start();

include("connect.php");

if(isset($_SESSION['username']) && isset($_SESSION['rolemaster_id'])) {
    $namekey = $_POST['namekey'];

    $folowesuggeslist = $con->query("SELECT * FROM `user_master` WHERE user_name LIKE '$namekey%'");
	//echo "SELECT * FROM `user_master` WHERE user_name LIKE '%$namekey'";
    //$folowesuggeslist->execute(array(':namekey' => $namekey . '%'));

    while($row = $folowesuggeslist->fetch(PDO::FETCH_ASSOC)) {
        //echo $row['user_name'] . "***".$row['id'];
		?>
		<div class="user-profile" style="margin-left:10px;">
					 
						<img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic">
						<span class="username" style="color:white;font-weight:600;margin-top:1px;"><?php echo ucfirst($row['user_name']) ?><br><br><span style="font-weight:400;color:white;font-size:15px;"><?php echo ucfirst($row['name']) ?></span></span>
						
						
				</div>
		
		
		<?php
		
    }
}
?>
