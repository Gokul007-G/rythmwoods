<?php

include("connect.php");
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
      <p class="login-box-msg">OTP VERIFICATION</p>

     <form method="POST" action="">
	     <div style="margin:0 55px;">
              <input class="otp" type="text" id="digit1" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 >
              <input class="otp" type="text" id="digit2" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 >
              <input class="otp" type="text" id="digit3" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 >
              <input class="otp" type="text" id="digit4"  oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 >      
		   </div>
        </form><br>
       
     
          <input type="submit" class="loginbtnnn" value="Verify" onclick="hhhhh();"><br>

      
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
function hhhhh() {
    debugger;
    var digit1 = document.getElementById('digit1').value;
    var digit2 = document.getElementById('digit2').value;
    var digit3 = document.getElementById('digit3').value;
    var digit4 = document.getElementById('digit4').value;

    $.ajax({
        type: "POST", // Assuming you want to send data using POST method
        url: "otpcodeverifyyy.php",
        data: {
            digit1: digit1,
            digit2: digit2,
            digit3: digit3,
            digit4: digit4
        },
        success: function(data) {
            // Handle the response from the server
            //console.log(data);
			if(data==1)
			{
			    alert('Password update Successfully!');
		        window.location.href='/rythm/login/login.php';
			}
			else if(data==2)
			{
				alert('SomethingWent Wrong!');
		        window.location.href='/rythm/login/forgotpass.php';
			}
			else if(data==3) 
			{
				alert('Please Check Otp code In Your Email!');
		        window.location.href='/rythm/login/optverifypage.php';
			}
			else
			{
				alert('SomethingWent Wrong!');
		        window.location.href='/rythm/login/forgotpass.php';
			}
			
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}

</script>

<style>

form input{
  display:inline-block;
  width:50px;
  height:50px;
  text-align:center;
}
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

