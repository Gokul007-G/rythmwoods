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
<body class="hold-transition login-page" style="background-color:black;">
<div class="login-box">
  <div class="login-logo">
  <img src="/rythm/assets/rythmlogo.png" alt="Logo" class="logo-img" style="height:100px;width:100px;">

  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      

      <form method="POST" action="validation.php" onsubmit="return validateForm();">
      <p class="login-box-msg">ADMIN</p>
          <div class="form-group">
            <label for="exampleInputusername">Username</label>
			<input class="form-control" name="Inputusername" type="name" aria-describedby="user_name" placeholder="Type Your Username" Autocomplete="off">
          </div>
          <div class="form-group">
                        <label for="examplepassword">Password</label>
                        <input class="form-control" name="InputPassword" type="password" placeholder="Type Your confirmpassword" autocomplete="off" id="InputPassword">
                        <span id="password-error" style="color: red;"></span>
                    </div>      
          <input type="submit" class="loginbtnnn" value="Login"/><br>
		  
        </form><br>
		
      
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

      if (password.length != 8) {
        document.getElementById('password-error1').innerHTML = 'Password must be exactly 8 characters';
        return false;
      } else {
        document.getElementById('password-error1').innerHTML = '';
      }
	  //passowrd validtion end 
	  
     
      

      return true;
    }
    </script>



<style>
  .loginbtnnn {
    background: #ff66a3 !important;
    color: black !important;
    border: none !important;
	border-radius:4px !important;
	width:100% !important;
	height:34px !important;
  }
   .loginbtnnn:hover {
    background: #ff3385 !important;
    
  }
</style>

</body>
</html>

