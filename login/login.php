<?php
require('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RythmWoods - Login</title>
  <link rel="stylesheet" href="../mystyle.css?v=1.2">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;600&display=swap" />
</head>

<body>
  <div class="login-page-container">
    <div class="login-left-panel">
      <h1 class="text">Welcome</h1>
      <h2 class="text-2">RythmWoods Software</h2>
      <div class="img"></div>
    </div>

    <div class="login-right-panel">
      <div class="login-form-card">
        <nav class="login-nav">
          <a href="#" id="signin-tab" class="active" onclick="showlogin(1);">Sign In</a>
          <a href="#" id="signup-tab" onclick="showlogin(2);">Sign Up</a>
        </nav>

        <div id="loginddd">
          <div id="card-content" class="card-2">
            <div class="card">
              <form class="login-form" action="validation.php" method="POST">
                <h3>LOGIN</h3>
                <input type="text" required placeholder="Enter Email" id="Inputusername" name="Inputusername">
                <input type="password" required placeholder="Password" id="InputPassword" name="InputPassword">
                <span id="vaild-pass"></span>
                <button type="submit">LOGIN</button>
                <div class="flex-center" style="margin-top: 20px;">
                  <p class="message" onclick="forgetpass('loginddd')" style="color: blue; cursor: pointer; text-decoration: underline;">Forgot your password?</p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  function forgetpass(val) {
    $.ajax({
      type: 'POST',
      url: 'forgetpass.php?divid=' + val,
      success: function(data) {
        $(".card").html(data);
      },

    });
  }

  function showlogin(val) {
    // Toggle active class on tabs
    if (val == 1) {
      $('#signin-tab').addClass('active');
      $('#signup-tab').removeClass('active');
      $.ajax({
        type: 'POST',
        url: 'login_two.php',
        success: function(data) {
          $(".card-2").html(data);
        },

      });
    } else {
      $('#signup-tab').addClass('active');
      $('#signin-tab').removeClass('active');
      $.ajax({
        type: 'POST',
        url: 'sign_up.php',
        success: function(data) {
          $(".card-2").html(data);
        },

      });
    }
  }
</script>

</html>