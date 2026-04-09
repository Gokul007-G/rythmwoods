<?php
/**
 * Rythm Messages Page - Final Professional Version
 */
require_once("../includes/config.php");

// Authentication Check
if (!isset($_SESSION['username'])) {
    header("Location: /rythm/pages/login.php");
    exit();
}

$pageTitle = "Rythm - Messages";
$profile_name = $_SESSION['user_name'];

include("../includes/header.php");
?>

<!-- Message specific styles could also go to assets/css/style.css -->
<link rel="stylesheet" href="/rythm/assets/css/message.css">

<div class="messenger-container w-100 h-100 d-flex justify-content-center align-items-center">
    <div class="messenger-wrapper shadow-lg rounded-4 overflow-hidden bg-white d-flex" 
         style="width: 100%; max-width: 1100px; height: 80vh;">
        
        <!-- Sidebar: User List -->
        <div class="chat-sidebar border-end d-flex flex-column" style="width: 350px; background: #fafafa;">
            <div class="p-4 border-bottom bg-white sticky-top">
                <h4 class="fw-bold mb-3">Messages</h4>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fa fa-search text-muted"></i></span>
                    <input type="text" id="userSearch" class="form-control bg-light border-0 shadow-none" placeholder="Search people...">
                </div>
            </div>
            
            <div class="user-list flex-grow-1 overflow-auto py-2" id="userList">
                <!-- Loaded via AJAX -->
                <div class="text-center p-5">
                    <div class="spinner-border text-primary spinner-border-sm" role="status"></div>
                </div>
            </div>
        </div>

        <!-- Main: Chat Window -->
        <div class="chat-window d-flex flex-grow-1 flex-column bg-white">
            <header class="chat-header p-3 border-bottom d-flex align-items-center justify-content-between bg-white sticky-top">
                <div class="d-flex align-items-center gap-3">
                    <img src="/rythm/assets/images/lion.png" alt="User" id="chatHeaderImg" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                    <div>
                        <h6 class="mb-0 fw-bold" id="chatHeaderName">Select a chat</h6>
                        <small class="text-success extra-small"><i class="fa fa-circle me-1"></i> Online</small>
                    </div>
                </div>
                <div class="d-flex gap-3 text-muted">
                    <i class="fa fa-phone cursor-pointer"></i>
                    <i class="fa fa-video cursor-pointer"></i>
                    <i class="fa fa-info-circle cursor-pointer"></i>
                </div>
            </header>
            
            <div class="chat-messages flex-grow-1 p-4 overflow-auto d-flex flex-column gap-3" id="chatMessages" style="background: #fdfdfd;">
                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                    <i class="fa fa-paper-plane fs-1 mb-3 opacity-25"></i>
                    <p>Select a friend from the list to start a conversation.</p>
                </div>
            </div>

            <div class="chat-footer p-3 border-top bg-white">
                <form id="messageForm" class="d-flex gap-2">
                    <button type="button" class="btn btn-link text-dark"><i class="fa fa-smile fs-5"></i></button>
                    <input type="text" id="messageInput" class="form-control rounded-pill border-0 bg-light px-4 shadow-none" 
                           placeholder="Type a message..." autocomplete="off">
                    <button type="submit" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0" 
                            style="width: 45px; height: 45px;">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/rythm/assets/js/message.js"></script>

<?php include("../includes/footer.php"); ?>
