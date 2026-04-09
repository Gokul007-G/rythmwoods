<?php
/**
 * Rythm Unified Header - Professional Pink System
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . "/config.php");

$username = $_SESSION['username'] ?? '';
$user_name = $_SESSION['user_name'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Rythm'; ?></title>

    <!-- UI Core -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    
    <!-- Unified Assets -->
    <link rel="stylesheet" href="/rythm/assets/css/style.css">
    <?php if (isset($extraCSS)): ?>
        <link rel="stylesheet" href="<?php echo $extraCSS; ?>">
    <?php endif; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="navbar-custom d-flex align-items-center px-4 sticky-top">
        <div class="welcome-txt">Welcome!</div>
        <div class="search-box mx-auto d-none d-md-block">
            <input type="text" placeholder="Search users or music...">
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold d-none d-sm-inline"><?php echo htmlspecialchars($user_name); ?></span>
            <button class="btn btn-logout" onclick="location.href='/rythm/logout.php'">
                <i class="fa fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </header>

    <div class="app-wrapper">
        <?php include_once(__DIR__ . "/sidebar.php"); ?>
        <main class="main-content">
