<?php
include("connect.php");

$email = $_GET['email'];

if(isset($_POST['verify'])){
    $otp = $_POST['otp'];

    $stmt = $con->prepare("SELECT * FROM user_master WHERE email=? AND otp=?");
    $stmt->execute([$email, $otp]);

    if($stmt->rowCount() > 0){

        $update = $con->prepare("UPDATE user_master SET is_verified=1 WHERE email=?");
        $update->execute([$email]);

        echo "<script>alert('Email Verified ✅')</script>";
        echo "<script>window.location.href='/rythm/login/login.php'</script>";

    }else{
        echo "<script>alert('Invalid OTP ❌')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f7c76a, deeppink);
            font-family: Arial, sans-serif;
        }

        .otp-box {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            width: 320px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .otp-box h3 {
            margin-bottom: 20px;
        }

        .otp-box input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 18px;
            text-align: center;
            letter-spacing: 6px;
            margin-bottom: 20px;
            outline: none;
            transition: 0.3s;
        }

        /* Placeholder style */
        .otp-box input::placeholder {
            letter-spacing: 6px;
            color: #aaa;
        }

        /* Focus effect */
        .otp-box input:focus {
            border-color: deeppink;
            box-shadow: 0 0 8px rgba(255, 20, 147, 0.4);
        }

        .otp-box button {
            width: 100%;
            padding: 12px;
            background: green;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Hover effect */
        .otp-box button:hover {
            background: darkgreen;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

<div class="otp-box">
    <form method="POST">
        <h3>Enter OTP</h3>
        <input type="text" name="otp" placeholder="XXXXXX" maxlength="6" required>
        <button name="verify">Verify</button>
    </form>
</div>

</body>
</html>