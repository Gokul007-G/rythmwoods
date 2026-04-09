<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Home - RythmWoods</title>
  <link rel="stylesheet" href="../mystyle.css?v=1.2">
</head>

<body>
  <?php include 'sidebar.php' ?>

  <main class="main-content flex-center">
    <div class="header-user" style="position: absolute; top: 20px; right: 20px;">
      <span class="username" style="font-size: 20px;">Admin</span>
      <a href="/rythm/adminlogin/login.php">
        <img src="/rythm/assets/switch.png" style="height: 40px; width: 40px; border-radius: 50%;">
      </a>
    </div>

    <div class="admin-card">
      <h1 class="admin-welcome-text">Welcome To Rythmwoods Admin</h1>
    </div>
  </main>

  <!-- <div class="footer">
  <label class="footer-label">© All rights reserved @2024</label><br>
  <label class="footer-label">Developed and Maintained by Bluebase Software Services Private Limited</label>
  </div> -->

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    // Existing JavaScript code remains unchanged
  </script>
</body>

</html>

<script>
  function Profile_pic() {
    debugger;
    $.ajax({
      url: 'admin_approval_list.php', // Replace with your server-side script URL
      type: 'POST',
      // Pass useriddd to the server
      success: function(data) {
        console.warn(data);
        $('.content-divv').html(data);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error(xhr, status, error);
      }
    });
  }

  function Profile_details() {
    debugger;
    $.ajax({
      url: 'adminappravalpage.php', // Replace with your server-side script URL
      type: 'POST',
      // Pass useriddd to the server
      success: function(data) {
        console.warn(data);
        $('.content-divv').html(data);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error(xhr, status, error);
      }
    });
  }
</script>