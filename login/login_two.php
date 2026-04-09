<?php
//require('connect.php');
?>

<div id="loginddd" class="login-form-card" style="max-width: 100%; box-shadow: none; padding: 0;">
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

<script>
  function forgetpass(val) {
    $.ajax({
      type: 'POST',
      url: 'forgetpass.php?divid=' + val,
      success: function(data) {
        $(".card").html(data);
      }
    });
  }
</script>