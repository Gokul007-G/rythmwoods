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
                <p class="login-box-msg">SIGNUP TO START YOUR SESSION</p>
                <form action="insertuserinfo.php" method="post" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label for="exampleInputusername">Firstname</label>
                        <input class="form-control" name="Inputfirstname" type="text" aria-describedby="user_name" placeholder="Type Your Firstname" Autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputlastname">Lastname</label>
                        <input class="form-control" name="Inputlastname" type="text" aria-describedby="user_name" placeholder="Type Your lastname" Autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="examplecontactno">Contact No</label>
                        <input class="form-control" name="contactno" type="number" placeholder="Type Your Contact No" autocomplete="off" id="contactno">
                        <span id="contactno-error" style="color: red;"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleemail">Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Type Your Email" autocomplete="off" id="email">
                        <span id="email-error" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="examplepassword">Password</label>
                        <input class="form-control" name="password" type="password" placeholder="Type Your password" autocomplete="off" id="password">
                        <span id="password-error" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleCategory">Select category</label>
                        <select class="form-control" id="typeofcategory" name="typeofcategory">
                            <option value="nd">-- Options --</option>
                            <option value="1">Singer</option>
                            <!-- <option value="2">Amateur singer</option> -->
                            <option value="3">Musician</option>
                            <option value="4">Band</option>
                            <option value="5">Event Manager</option>
                            <option value="6">Lighting</option>
                            <option value="7">Sound</option>
                            <option value="8">User</option>
                        </select>
                    </div>
                    <input type="submit" class="registerbtn" value="Singup" /><br>
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
        $(document).ready(function() {
            // Function to handle contact number input
            function otpverifyforcontactno() {
                var mobileno = $('#contactno').val();
                if (mobileno) {
                    $("#otiformbileno").slideDown();
                } else {
                    $("#otiformbileno").slideUp();
                }
            }

            // Call the function when the page loads
            otpverifyforcontactno();

            // Call the function when the contact number input changes
            $('#contactno').keyup(function() {
                otpverifyforcontactno();
            });

            // Show OTP verification box when checkbox is checked
            $("#otpCheck").change(function() {
                if (this.checked) {
                    $("#otiformbileno").slideDown();
                } else {
                    $("#otiformbileno").slideUp();
                }
            });
        });
    </script>

    <script>
        function validateForm() {
            debugger;
            var email = document.getElementById('email').value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                document.getElementById('email-error').innerHTML = 'Invalid email format';
                return false;
            } else {
                document.getElementById('email-error').innerHTML = '';
            }

            var contactno = document.getElementById('contactno').value;
            var contactnoPattern = /^\d{10}$/;
            if (!contactnoPattern.test(contactno)) {
                document.getElementById('contactno-error').innerHTML = 'Contact number must be 10 digits';
                return false;
            } else {
                document.getElementById('contactno-error').innerHTML = '';
            }

            var password = document.getElementById('password').value;
            //console.log('Password:', password);
            //console.log('Password Length:', password.length);

            if (password.length !== 8) {
                console.log('Password does not have exactly 8 characters');
                document.getElementById('password-error').innerHTML = 'Password must be exactly 8 characters';
                return false;
            } else {
                console.log('Password is valid');
                document.getElementById('password-error').innerHTML = '';
            }

            return true;
        }
    </script>

    <style>
        .registerbtn {
            background: #ff66a3 !important;
            color: black !important;
            border: none !important;
            border-radius: 4px !important;
            width: 100% !important;
            height: 34px !important;
        }

        .registerbtn:hover {
            background: #ff3385 !important;

        }

        .card-body.login-card-body {
            width: 460px;
            margin-left: -47px;
        }
    </style>

</body>

</html>