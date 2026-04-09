<?php
session_start();

require("connect.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];

$sql2 = $con->query("SELECT * FROM `user_master` where role_master_id='$rolemaster_id' and admin_status=0");

$profiledtils = $sql2->fetch(PDO::FETCH_ASSOC);

if ($profiledtils['admin_status'] != 1) {

?>
  <!DOCTYPE html>
  <html>

  <body>
    <div class="landpg">
      <a href="/rythm/login/login.php"><img src="/rythm/assets/switch.png" style="height:40px;width:40px;float:right;margin-top:20px;"></a>
      <div class="containerrr" style="font-size:14px;text-align:center;">
      </div>
      <div class="box">
        <div class="digitalclock">
          <h1 id="approvlalemess">Your profile is Not Permit At The Moments!!!</h1>
          <br><br>
          <img src="/rythm/assets/sademoji.gif" alt="Animated GIF" style="height:50px;;width:50px;">
        </div>
      </div>
    </div>
  </body>
  <html>
  <style>
    /* Existing styles */

    /* Add this style */
    .containerrr {
      position: absolute;
      top: 20%;
      width: 100%;
      text-align: center;
      z-index: 2;
    }

    * {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
      box-sizing: border-box;
    }

    .landpg {
      width: 100%;
      min-height: 100vh;
      background: linear-gradient(65deg,
          #000000,
          #0f2019,
          #01eeff,
          #000000,
          #01eeff,
          #0f2019,
          #000000);
      color: rgb(255, 255, 255);
      position: relative;
      background-image: conic-gradient(from var(--border-angle),
          #213,
          #112 50%,
          #213),
        conic-gradient(from var(--border-angle), transparent 20%, #08f, #f03);
      background-size: calc(100% - (var(--border-size) * 2)) calc(100% - (var(--border-size) * 2)),
        cover;
      background-position: center center;
      background-repeat: no-repeat;
      animation: bg-spin 3s linear infinite;
    }

    .box {
      --border-size: 10px;
      --border-angle: 0turn;
      width: 800px;
      height: 180px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10%;
      background-image: conic-gradient(from var(--border-angle),
          #213,
          #112 50%,
          #213),
        conic-gradient(from var(--border-angle), transparent 20%, #08f, #f03);
      background-size: calc(100% - (var(--border-size) * 2)) calc(100% - (var(--border-size) * 2)),
        cover;
      background-position: center center;
      background-repeat: no-repeat;
      animation: bg-spin 3s linear infinite;
    }

    @keyframes bg-spin {
      to {
        --border-angle: 1turn;
      }
    }

    @property --border-angle {
      syntax: "<angle>";
      inherits: true;
      initial-value: 0turn;
    }

    .digitalclock {
      width: 100%;
      height: 100%;
      background: rgba(235, 0, 225, 0.11);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(40px);
    }

    .digitalclock span {
      font-size: 80px;
      width: 100px;
      display: inline-block;
      text-align: center;
      position: relative;
    }

    .digitalclock span::after {
      font-size: 16px;
      position: absolute;
      top: -7px;
      left: 50%;
      transform: translate(-50%);
    }

    #hrs::after {
      content: "Hours";
    }

    #min::after {
      content: "Minutes";
    }

    #sec::after {
      content: "Seconds";
    }

    .h1 {
      font-size: 30px;
      bottom: 5px;
      align-self: center;
    }

    .container {
      margin-top: 4px;
      width: 100%;
      height: 50%;
      background: rgba(235, 0, 225, 0.11);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(40px);
    }

    .container h1 {
      transform: scale(1);
      transition: transform 0.2s ease-in;
    }

    .container h1:hover {
      transform: scale(1.2);
    }
  </style>

<?php
} else {
  header('Location:../homee.php');
}
?>