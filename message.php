<?php
/**
 * Rythm Messages - Unified Professional Version
 */
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$pageTitle = "Rythm - Messages";
include("includes/header.php");
?>

<link rel="stylesheet" href="/rythm/assets/css/message.css">

<div class="messenger-wrapper container-fluid p-0" style="height: calc(100vh - 120px); border-radius: 12px; overflow: hidden; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
    <div class="row g-0 h-100">
        <!-- Sidebar: User List -->
        <div class="col-md-4 border-end h-100 d-flex flex-column">
            <div class="p-3 border-bottom">
                <h4 class="mb-3 fw-bold">Messages</h4>
                <div class="search-box">
                    <input type="text" id="userSearch" class="form-control rounded-pill bg-light border-0 px-3" placeholder="Search people...">
                </div>
            </div>
            <div class="flex-grow-1 overflow-auto" id="userList">
                <!-- User Item -->
                <div class="user-item p-3 d-flex align-items-center gap-3 border-bottom cursor-pointer hover-bg-light" onclick="loadChat(123, 'Lion', '/rythm/assets/images/lion.png')">
                    <img src="/rythm/assets/images/lion.png" alt="User" class="rounded-circle border" style="width: 50px; height: 50px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 fw-bold">Lion</h6>
                            <small class="text-muted">12:45 PM</small>
                        </div>
                        <p class="small text-muted mb-0 text-truncate">Hey! How are you?</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main: Chat Window -->
        <div class="col-md-8 h-100 d-flex flex-column bg-light bg-opacity-25">
            <header class="p-3 border-bottom bg-white d-flex align-items-center gap-3">
                <img src="/rythm/assets/images/lion.png" alt="User" id="chatHeaderImg" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                <h6 class="mb-0 fw-bold" id="chatHeaderName">Lion</h6>
            </header>

            <div class="flex-grow-1 p-4 overflow-auto d-flex flex-column gap-3" id="chatMessages">
                <div class="text-center text-muted small my-5 py-5">
                    <img src="/rythm/assets/images/send.png" alt="Send" class="opacity-25 mb-3" style="width: 80px;">
                    <p>Select a friend from the list to start a conversation.</p>
                </div>
            </div>

            <footer class="p-3 bg-white border-top">
                <form id="messageForm" class="d-flex gap-2 align-items-center">
                    <input type="text" id="messageInput" class="form-control rounded-pill border-0 bg-light px-4" placeholder="Type a message..." autocomplete="off" style="height: 45px;">
                    <button type="submit" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: #0084ff; border: none;">
                        <img src="/rythm/assets/images/send.png" alt="Send" style="width: 18px; filter: invert(1);">
                    </button>
                </form>
            </footer>
        </div>
    </div>
</div>

<script src="/rythm/assets/js/message.js"></script>
<?php include("includes/footer.php"); ?>