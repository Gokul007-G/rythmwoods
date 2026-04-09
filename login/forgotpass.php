<?php
// forgotpass.php
?>

<div class="login-form-card" style="max-width: 100%; box-shadow: none; padding: 0;">
  <h3>CREATE NEW PASSWORD</h3>
  <p style="text-align: center; margin-bottom: 20px; font-size: 14px; color: #666;">Enter your email to reset your password.</p>

  <form method="POST" action="sendOtp.php" onsubmit="return validateForm();">
    <div class="form-group">
      <label>Email</label>
      <input class="form-control" name="Inputemail" type="text" placeholder="Type Your Email" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label>New Password</label>
      <input class="form-control" name="InputPassword" type="password" placeholder="Type Your password" autocomplete="off" id="InputPassword" required>
      <span id="password-error1" style="color: red; font-size: 12px;"></span>
    </div>
    
    <span id="confirm-password-error" style="color: red; font-size: 12px;"></span> <br>
    <button type="submit" class="savebbtnn">Save Password</button>
  </form>
  
  <div class="flex-center" style="margin-top: 20px;">
    <a href="/rythm/login/login.php" style="color: blue; text-decoration: underline; font-size: 14px;">Back to Login</a>
  </div>
</div>

<script>
  function validateForm() {
    var password = document.getElementById('InputPassword').value;
    if (password.length < 8) {
      document.getElementById('password-error1').innerHTML = 'Password must be at least 8 characters';
      return false;
    } else {
      document.getElementById('password-error1').innerHTML = '';
    }
    return true;
  }
</script>