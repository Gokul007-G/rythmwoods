
<?php
session_start();

require("connect.php");	

$username = $_SESSION['username'];
 $rolemaster_id = $_SESSION['role_master_id'];
 
 $sql2 = $con->query("SELECT * FROM `user_master` where role_master_id='$rolemaster_id' and admin_status=0");

      $profiledtils = $sql2->fetch(PDO::FETCH_ASSOC);
		  
	
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rythm</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <style>
    .login-box {
      width: 900px; /* Adjust the width as per your requirement */
      margin: auto;
      margin-top: 100px; /* Adjust the margin top as per your requirement */
    }
    .login-card-body label {
      width: 150px; /* Fixed width for labels */
      display: inline-block;
      text-align: right;
      margin-right: 20px; /* Adjust spacing between label and input */
      vertical-align: top; /* Align label text to the top */
    }
    .login-card-body .form-group {
      display: flex;
      align-items: center; /* Align items vertically */
      margin-bottom: 10px;
	  margin-left:-72px;
    }
    .login-card-body input, .login-card-body textarea {
      flex: 1;
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      height: 40px;
    }
    .login-card-body textarea {
      height: 90px; /* Adjust height of textarea */
      resize: vertical; /* Allow vertical resizing */
    }
    .login-card-body .social-media {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
	  margin-left:-100px;
    }
    .login-card-body .social-media label {
      margin-right: 10px;
    }
    .login-card-body .social-media input {
      flex: 1;
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      height: 40px;
    }
    .login-card-body .achievements {
      margin-top: 20px;
	  margin-left:31px;
    }
    .login-card-body .achievements label {
      display: block;
      margin-bottom: 5px;
    }
    .login-card-body .achievements input, .login-card-body .achievements textarea {
      width: 100%;
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      height: 40px;
    }
    .login-card-body .achievements .upload-btn {
      display: inline-block;
      padding: 8px 15px;
      background-color: #ff66a3;
      color: black;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
    }
	
	.login-card-body .moreachievementscls {
      margin-top: 20px;
	  margin-left:40px;
    }
    .login-card-body .moreachievementscls label {
      display: block;
      margin-bottom: 5px;
    }
    .login-card-body .moreachievementscls input, .login-card-body .moreachievementscls textarea {
      width: 100%;
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      height: 40px;
    }
    .login-card-body .moreachievementscls .upload-btn {
      display: inline-block;
      padding: 8px 15px;
      background-color: #ff66a3;
      color: black;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
    }
	
	
	.login-card-body .portfolio {
      margin-top: 20px;
	  margin-left:31px;
    }
    .login-card-body .portfolio label {
      display: block;
      margin-bottom: 5px;
    }
    .login-card-body .portfolio input, .login-card-body .portfolio textarea {
      width: 100%;
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      height: 40px;
    }
    .login-card-body .portfolio .upload-btn {
      display: inline-block;
      padding: 8px 15px;
      background-color: #ff66a3;
      color: black;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
    }
	
	
	
    
    .loginbtnnn {
      background: #ff66a3 !important;
      color: black !important;
      border: none !important;
      border-radius: 4px !important;
      width: 150px !important; /* Adjust width as per your requirement */
      height: 34px !important;
      display: block; /* Change display to block to center the button */
      margin: 0 auto; /* Center the button horizontally */
    }
    .loginbtnnn:hover {
      background: #ff3385;
    }
    .add-more-btn {
      background-color: #17a2b8;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 8px 15px;
      cursor: pointer;
      margin-top: 10px;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Profile Details</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form method="POST" action="afterprofile.php" onsubmit="return validateForm();">
        <div class="form-group">
          <label for="firstname">First Name:</label>
          <input type="text" id="firstname" name="firstname" value="<?php echo $profiledtils['user_name'];?>" />
          <label for="lastname">Last Name:</label>
          <input type="text" id="lastname" name="lastname" value="<?php echo $profiledtils['last_name'];?>" />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" value="<?php echo $profiledtils['email'];?>" />
          <label for="contact">Contact:</label>
          <input type="text" id="contact" name="contact" value="<?php echo $profiledtils['mobile_no'];?>" />
        </div><br>
        <div class="form-group">
          <label for="about">About:</label>
          <textarea id="about" name="about" rows="4" maxlength="2000"></textarea>
        </div><br>
        <div class="login-card-body">
          <div class="social-media">
            <label for="facebook"><img src="/rythm/assets/facebook.png" style="height:25px;width:25px;"></label>
            <input type="text" id="facebook" name="facebook" placeholder="Facebook URL" />
          </div>
          <div class="social-media">
            <label for="twitter"><img src="/rythm/assets/twitter.png" style="height:25px;width:25px;"></label>
            <input type="text" id="twitter" name="twitter" placeholder="Twitter URL" />
          </div>
          <div class="social-media">
            <label for="instagram"><img src="/rythm/assets/instagram.png" style="height:25px;width:25px;"></label>
            <input type="text" id="instagram" name="instagram" placeholder="Instagram URL" />
          </div>
          <div class="social-media">
            <label for="youtube"><img src="/rythm/assets/youtube.png" style="height:25px;width:25px;"></i></label>
            <input type="text" id="youtube" name="youtube" placeholder="YouTube URL" />
          </div>
          <!-- Add more social media inputs here as needed -->
        </div>
		
		<div class="portfolio">
			<h3>Portfolio</h3><br>
			<div class="form-group">
				<label for="image">Image or Video Uploader:</label>
				<input type="file" id="imagevedio_1" name="imagevedio_1" accept="image/*, video/*" />
			</div>
			<!-- Add more portfolio inputs here as needed -->
		</div><br>

		
        <div class="achievements">
          <h3>Achievement1</h3>
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title_1" name="title_1" placeholder="Title" />
          </div>
          <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year_1" name="year_1" placeholder="Year" />
          </div>
          <div class="form-group">
            <label for="awardedby">Awarded By:</label>
            <input type="text" id="awardedby_1" name="awardedby_1" placeholder="Awarded By" />
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description_1" name="description_1" rows="4" placeholder="Description"></textarea>
          </div>
          <div class="form-group">
            <label for="image">Image Uploader:</label>
            <input type="file" id="image_1" name="image_1" accept="image/*" />
          </div>
          <div class="form-group">
            <label for="youtubeLink">YouTube Link:</label>
            <input type="text" id="youtubeLink_1" name="youtubeLink_1" placeholder="YouTube Link" />
          </div>
          <!-- Add more portfolio inputs here as needed -->
        </div>
		<button type="button" class="add-more-btn" onclick="addMoreAchievements(1)" id="addmoree_1">Add More</button><br><br>
		<div id="moreachievements" class="moreachievementscls" style="margin-left:43px;">
		</div>
		
		 <div class="projects" style="margin-left:25px;">
          <h3>Projects1</h3>
          <div class="form-group">
            <label for="title">Project_Name:</label>
            <input type="text" id="pjtitle_1" name="pjtitle_1" placeholder="Title" />
          </div>
          <div class="form-group">
            <label for="year">Link1:</label>
            <input type="text" id="link_1" name="link_1" placeholder="link_1" />
          </div>
          <div class="form-group">
            <label for="awardedby">Link2:</label>
            <input type="text" id="link_2" name="link_2" placeholder="link_2" />
          </div>
          <div class="form-group">
            <label for="description">Link3:</label>
            <input id="link_3" name="link_3" placeholder="link_3">
          </div>
          
          <div class="form-group">
            <label for="youtubeLink">Link4:</label>
            <input type="text" id="link_4" name="link_4" placeholder="link_4" />
          </div>
		  
		  <div class="form-group">
            <label for="youtubeLink">Link5:</label>
            <input type="text" id="link_5" name="link_5" placeholder="link_5" />
          </div>
          <!-- Add more portfolio inputs here as needed -->
        </div>
				<button type="button" class="add-more-btn" onclick="addMoreprojects(1)" id="addprojects_1">Add More</button><br><br>

		<div id="moreprojects" class="moreprojectscls" style="margin-left:43px;">
		</div>
		
        <input type="submit" class="loginbtnnn" value="Save"/><br>
      </form><br>
    </div>
  </div>
</div>
<input type="hidden" id="dyidset" name="dyidset" value="">
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
  function validateForm() {
    var password = document.getElementById('InputPassword').value;

    if (password.length != 8) {
      document.getElementById('password-error1').innerHTML = 'Password must be exactly 8 characters';
      return false;
    } else {
      document.getElementById('password-error1').innerHTML = '';
    }

    return true;
  }

 function addMoreAchievements(id) {
	// debugger;
    // Hide the "Add More" button of the current achievement
    $('#addmoree_'+ id).hide();
    
    // Increment id for the next achievement
    id++;
   var inputbx=$("#dyidset").val(id);
   
   if(id<=10)
   {

    var popupHtml = 
	'<div id="achievement_' + id + '">' +
	'<a href="#" class="achivemtnscls" onclick="removeAchievement(' + id + ');"><img src="/rythm/assets/blkcolorcross.png" style="height:25px;width:25px;float:right;"></a>'+
	    '<h3>Achievement' + id + '</h3>' +
	    '<div class="form-group">' +
        '<label for="title">Title:</label>' +
        '<input type="text" id="title_' + id + '" name="title_' + id + '" placeholder="Title" />' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="year">Year:</label>' +
        '<input type="text" id="year_' + id + '" name="year_' + id + '" placeholder="Year" />' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="awardedby">Awarded By:</label>' +
        '<input type="text" id="awardedby_' + id + '" name="awardedby_' + id + '" placeholder="Awarded By" />' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="description">Description:</label>' +
        '<textarea id="description_' + id + '" name="description_' + id + '" rows="4" placeholder="Description"></textarea>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="image">Image Uploader:</label>' +
        '<input type="file" id="image_' + id + '" name="image_' + id + '" accept="image/*" />' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="youtubeLink">YouTube Link:</label>' +
        '<input type="text" id="youtubeLink_' + id + '" name="youtubeLink_' + id + '" placeholder="YouTube Link" />' +
        '</div>' +
		
        '<button type="button" class="add-more-btn" onclick="addMoreAchievements(' + id + ')" id="addmoree_' + id + '">Add More</button><br><br>'+
        '</div>';
    // Append the HTML content to the moreachievements div
    $('#moreachievements').append(popupHtml);
   }
   else
   {
	   alert('only possible for 10 Achievements');
   }
}

function removeAchievement(id) {
	//debugger;
	var iddd=1;
	$('#addmoree_'+iddd).show();
    $('#achievement_' + id).remove();
	 
}

</script>






<script>
 
 function addMoreprojects(id) {
	 //debugger;
    // Hide the "Add More" button of the current achievement
    $('#addprojects_'+ id).hide();
    
    // Increment id for the next achievement
    id++;


var inputbx =$("#dyidset").val(id);

   if(id<=10)
   {
    var popupHtml = '<div class="projects" id="projectsidd'+id+'" style="margin-left:25px;">'+
	'<a href="#" class="projectscls" onclick="removeprojects(' + id + ');"><img src="/rythm/assets/blkcolorcross.png" style="height:25px;width:25px;float:right;"></a>'+
          '<h3>Projects'+id+'</h3>'+
          '<div class="form-group">'+
            '<label for="title">Project_Name:</label>'+
            '<input type="text" id="pjtitle_'+id+'" name="pjtitle_'+id+'" placeholder="Title" />'+
         '</div>'+
          '<div class="form-group">'+
            '<label for="year">Link1:</label>'+
            '<input type="text" id="link_'+id+'" name="link_'+id+'" placeholder="link_1" />'+
          '</div>'+
          '<div class="form-group">'+
            '<label for="awardedby">Link2:</label>'+
            '<input type="text" id="link_'+id+'" name="link_'+id+'" placeholder="link_2" />'+
          '</div>'+
          '<div class="form-group">'+
            '<label for="description">Link3:</label>'+
            '<input id="link_'+id+'" name="link_'+id+'"  placeholder="link_3">'+
          '</div>'+
          
          '<div class="form-group">'+
            '<label for="youtubeLink">Link4:</label>'+
            '<input type="text" id="link_'+id+'" name="link_'+id+'" placeholder="link_4" />'+
          '</div>'+
		  
		  '<div class="form-group">'+
            '<label for="youtubeLink">Link5:</label>'+
           '<input type="text" id="link_'+id+'" name="link_'+id+'" placeholder="link_5" />'+
         '</div>'+
          '<button type="button" class="add-more-btn" onclick="addMoreprojects('+id+')" id="addprojects_'+id+'">Add More</button><br><br>'+
		 '</div>';

    
   $('#moreprojects').append(popupHtml);
   
   }
   else
   {
	   alert('only possible for 10 Achievements');
   }
}
function removeprojects(id) {
	//debugger;
	var iddd=1;
	$('#addprojects_'+iddd).show();
    $('#projectsidd' + id).remove();
	 
}

</script>



</body>
</html>
