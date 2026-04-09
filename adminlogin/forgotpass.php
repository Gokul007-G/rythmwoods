<?php


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
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>SINGER</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">CREATE NEW PASSWORD</p>

      <form method="POST" action="sendOtp.php" onsubmit="return validateForm();">
          <div class="form-group">
            <label for="exampleInputemail">Email</label>
			
            <input class="form-control" name="Inputemail" type="text" aria-describedby="user_name" placeholder="Type Your Email" Autocomplete="off">
          </div>
          <div class="form-group">
                        <label for="examplepassword">Password</label>
                        <input class="form-control" name="InputPassword" type="password" placeholder="Type Your password" autocomplete="off" id="InputPassword">
                        <span id="password-error1" style="color: red;"></span>
                    </div>	
           <div class="form-group">
                        <label for="examplepassword">ConfirmPassword</label>
                        <input class="form-control" name="InputconfirmPassword" type="password" placeholder="Type Your confirmpassword" autocomplete="off" id="InputconfirmPassword">
                        <span id="password-error2" style="color: red;"></span>
                    </div>	
					
                 <span id="confirm-password-error" style="color: red;"></span>	<br>			
          <input type="submit" class="savebbtnn" value="Save"/><br>
		  
        </form><br>
         <a href="/rythm/login/login.php">Login Here!</a>


      
    </div>
   
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

 <script>
        function validateForm() {
			//debugger;
      var password = document.getElementById('InputPassword').value;
      var confirmPassword = document.getElementById('InputconfirmPassword').value;

      if (password.length != 8) {
        document.getElementById('password-error1').innerHTML = 'Password must be exactly 8 characters';
        return false;
      } else {
        document.getElementById('password-error1').innerHTML = '';
      }
	  //passowrd validtion end 
	  
     if (confirmPassword.length != 8) {
        document.getElementById('password-error2').innerHTML = 'Password must be exactly 8 characters';
        return false;
      } else {
        document.getElementById('password-error2').innerHTML = '';
      }
	  //confirmpassword validtion end 
	  
      if (password != confirmPassword) {
        document.getElementById('confirm-password-error').innerHTML = 'Passwords and confirmPassword do not match';
        return false;
      } else {
        document.getElementById('confirm-password-error').innerHTML = '';
      }

      return true;
    }
    </script>


<style>
  .savebbtnn {
    background: #ff66a3 !important;
    color: black !important;
    border: none !important;
	border-radius:4px !important;
	width:100% !important;
	height:34px !important;
  }
   .savebbtnn:hover {
    background: #ff3385 !important ;
    
  }
</style>

</body>
</html>

