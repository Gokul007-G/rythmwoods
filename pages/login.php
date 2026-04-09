<?php
/**
 * Rythm Login Page - Final Professional Version
 */
require_once("../includes/config.php");

// If already logged in, redirect to home
if (isset($_SESSION['username'])) {
    header("Location: /rythm/pages/home.php");
    exit();
}

$pageTitle = "Rythm - Login";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0f2f5; height: 100vh; overflow: hidden; }
        .login-card { border: none; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; max-width: 900px; width: 100%; height: 550px; }
        .brand-section { background: linear-gradient(135deg, #0095f6 0%, #ff80b3 100%); color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 3rem; }
        .form-section { background: white; padding: 4rem; display: flex; flex-direction: column; justify-content: center; }
        .btn-primary { background-color: #0095f6; border: none; border-radius: 0.5rem; padding: 0.75rem; font-weight: 600; }
        .btn-primary:hover { background-color: #007cc7; }
        .form-control { border-radius: 0.5rem; padding: 0.75rem; border: 1px solid #ddd; }
        .form-control:focus { border-color: #0095f6; box-shadow: 0 0 0 0.2rem rgba(0,149,246,0.1); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">

<div class="login-card d-flex">
    <!-- Left Section: Brand -->
    <div class="brand-section d-none d-md-flex col-md-5">
        <img src="/rythm/assets/images/rythmlogo.png" alt="Rythm Logo" class="mb-4" style="width: 100px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));">
        <h1 class="fw-bold mb-3 ls-1">RYTHM</h1>
        <p class="opacity-85 fst-italic fs-5">Experience Music Like Never Before.</p>
    </div>

    <!-- Right Section: Form -->
    <div class="form-section col-12 col-md-7">
        <div class="mb-4 text-center text-md-start">
            <h3 class="fw-bold text-dark">Welcome Back</h3>
            <p class="text-muted">Log in to your account to continue.</p>
        </div>

        <form action="/rythm/login/login_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fa fa-user text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 shadow-none" id="username" name="username" placeholder="Enter your username" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fa fa-lock text-muted"></i></span>
                    <input type="password" class="form-control border-start-0 shadow-none" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3 ripple">Log In</button>
            
            <div class="text-center">
                <p class="small text-muted mb-0">Don't have an account? <a href="/rythm/login/register.php" class="text-primary fw-bold text-decoration-none">Sign Up</a></p>
                <a href="#" class="extra-small text-muted mt-2 d-block">Forgot password?</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
