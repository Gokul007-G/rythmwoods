<?php
//require('connect.php');
?>

<div id="adminnnlo" class="login-form-card" style="max-width: 100%; box-shadow: none; padding: 0;">
  <form action="insertuserinfo.php" method="post">
    <h3>Sign Up</h3>
    <div class="form-group">
      <label>Firstname</label>
      <input name="Inputfirstname" type="text" placeholder="Type Your Firstname" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label>Lastname</label>
      <input name="Inputlastname" maxlength="10" type="text" placeholder="Type Your lastname" autocomplete="off">
    </div>
    <div class="form-group">
      <label>Contact No</label>
      <input name="contactno" type="number" placeholder="Type Your Contact No" autocomplete="off" id="contactno">
      <span id="contactno-error" style="color: red; font-size: 12px;"></span>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input name="email" type="email" placeholder="Type Your Email" autocomplete="off" id="email">
      <span id="email-error" style="color: red; font-size: 12px;"></span>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input name="password" type="password" placeholder="Type Your password" autocomplete="off" id="password">
      <span id="password-error" style="color: red; font-size: 12px;"></span>
    </div>
    <div class="form-group">
      <label>Select category</label>
      <select class="login-form-card input" id="typeofcategory" name="typeofcategory" style="background: #fdfdfd; border: 1px solid #ddd; padding: 12px; border-radius: 8px; width: 100%; margin-bottom: 15px;">
        <option value="nd" disabled selected>-- Select Category --</option>
        <option value="1">Singer</option>
        <option value="3">Musician</option>
        <option value="4">Band</option>
        <option value="5">Event Manager</option>
        <option value="6">Lighting</option>
        <option value="7">Sound</option>
        <option value="8">User</option>
      </select>
    </div>
    <button type="submit">Signup</button>
  </form>
  
  <div class="flex-center" style="margin-top: 20px;">
    <p class="message" onclick="loginhere()" style="color: blue; cursor: pointer; text-decoration: underline;">Already have an account? Login Here</p>
  </div>
</div>

<script>
  function loginhere() {
    $.ajax({
      type: 'POST',
      url: 'login_two.php',
      success: function(data) {
        $(".card-content").html(data);
      }
    });
    // Update tabs if on login.php
    $('#signin-tab').addClass('active');
    $('#signup-tab').removeClass('active');
  }
</script>