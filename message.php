<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$login_user_id = $_SESSION['users_id'];
$pageTitle = "Rythm - Messages";

include("includes/header.php");
?>

<style>
    .messages-container {
        height: calc(100vh - 80px); /* Account for header */
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        display: flex;
        margin-right: 20px;
    }

    /* Sidebar Styles */
    .chat-sidebar {
        width: 350px;
        border-right: 1px solid #f0f0f0;
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    .sidebar-header {
        padding: 24px;
        border-bottom: 1px solid #f0f0f0;
    }

    .sidebar-header h4 {
        margin: 0;
        font-weight: 700;
        color: #333;
    }

    .user-list {
        flex-grow: 1;
        overflow-y: auto;
    }

    .user-item {
        padding: 15px 24px;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        border-bottom: 1px solid #fafafa;
    }

    .user-item:hover {
        background-color: #fff0f6;
    }

    .user-item.active {
        background-color: #fff0f6;
        border-left: 4px solid var(--rythm-pink);
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .user-info {
        flex-grow: 1;
        overflow: hidden;
    }

    .user-info .name {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 2px;
    }

    .user-info .last-msg {
        display: block;
        font-size: 13px;
        color: #888;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Chat Area Styles */
    .chat-main {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background: #fdfdfd;
        position: relative;
    }

    .chat-header {
        padding: 15px 25px;
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .chat-header .active-user-name {
        font-weight: 600;
        font-size: 16px;
        color: #333;
    }

    #chatBox {
        flex-grow: 1;
        padding: 25px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
        background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); /* Subtle pattern */
    }

    /* Input Area Styles */
    .chat-input-area {
        padding: 20px;
        background: #fff;
        border-top: 1px solid #f0f0f0;
    }

    .input-wrapper {
        background: #f8f9fa;
        border-radius: 30px;
        padding: 5px 10px 5px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #eee;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within {
        border-color: var(--rythm-pink);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(255, 128, 179, 0.1);
    }

    #msg {
        flex-grow: 1;
        border: none;
        background: transparent;
        padding: 10px 0;
        outline: none;
        font-size: 15px;
        color: #333;
    }

    #msg::placeholder {
        color: #bbb;
    }

    .send-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--rythm-deep-pink);
        border: none;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .send-btn:hover {
        transform: scale(1.05);
        background: #e60072;
    }

    .send-btn:active {
        transform: scale(0.95);
    }

    /* Empty State */
    .empty-chat {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #bbb;
    }

    .empty-chat i {
        font-size: 60px;
        margin-bottom: 20px;
        color: #f0f0f0;
    }

    /* Scrollbar */
    #chatBox::-webkit-scrollbar, .user-list::-webkit-scrollbar {
        width: 6px;
    }
    #chatBox::-webkit-scrollbar-thumb, .user-list::-webkit-scrollbar-thumb {
        background: #eee;
        border-radius: 10px;
    }
</style>

<div class="messages-container">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <div class="sidebar-header">
            <h4>Chats</h4>
        </div>
        <div class="user-list">
            <?php
            $stmt = $con->prepare("
                SELECT 
                    u.users_id,
                    u.user_name,
                    u.profile_img,
                    (
                        SELECT message FROM messages m1
                        WHERE (m1.sender_id=u.users_id AND m1.receiver_id=?)
                           OR (m1.sender_id=? AND m1.receiver_id=u.users_id)
                        ORDER BY id DESC LIMIT 1
                    ) AS message,
                    (
                        SELECT timestamp FROM messages m2
                        WHERE (m2.sender_id=u.users_id AND m2.receiver_id=?)
                           OR (m2.sender_id=? AND m2.receiver_id=u.users_id)
                        ORDER BY id DESC LIMIT 1
                    ) AS time
                FROM user_master u
                INNER JOIN following_details f 
                    ON u.users_id = f.following_id
                WHERE f.follower_id = ? 
                  AND f.following_sts = 1
                ORDER BY time DESC
            ");

            $stmt->execute([
                $login_user_id,
                $login_user_id,
                $login_user_id,
                $login_user_id,
                $login_user_id
            ]);

            while($user=$stmt->fetch(PDO::FETCH_ASSOC)):
                $img = !empty($user['profile_img']) ? $user['profile_img'] : '/rythm/assets/profile.png';
                $msg = !empty($user['message']) ? $user['message'] : 'Start a conversation...';
                $formattedTime = !empty($user['time']) ? date('H:i', strtotime($user['time'])) : '';
            ?>
                <div class="user-item" data-id="<?php echo $user['users_id']; ?>" 
                     onclick="loadChat('<?php echo $user['users_id']; ?>', '<?php echo htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8'); ?>', '<?php echo $img; ?>', this)">
                    <img src="<?php echo $img; ?>" class="user-avatar">
                    <div class="user-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="name"><?php echo htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <small style="font-size: 11px; color: #ccc;"><?php echo $formattedTime; ?></small>
                        </div>
                        <span class="last-msg"><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="chat-main">
        <!-- Initial Display -->
        <div id="noChatSelected" class="empty-chat">
            <i class="fa-regular fa-comment-dots"></i>
            <p>Select a friend to start chatting</p>
        </div>

        <!-- Chat Header (Hidden initially) -->
        <div id="chatHeader" class="chat-header" style="display:none;">
            <img id="chatImg" src="" class="user-avatar" style="width: 40px; height: 40px;">
            <div class="active-user-name" id="chatName"></div>
        </div>

        <!-- Chat Messages -->
        <div id="chatBox" style="display: none;"></div>

        <!-- Input Box -->
        <div id="chatInputArea" class="chat-input-area" style="display: none;">
            <form id="sendForm">
                <div class="input-wrapper">
                    <input type="text" id="msg" placeholder="Type a message..." autocomplete="off">
                    <button type="submit" class="send-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentUser = 0;

function loadChat(id, name, img, element) {
    currentUser = id;

    // UI Updates
    $('.user-item').removeClass('active');
    $(element).addClass('active');

    $('#noChatSelected').hide();
    $('#chatHeader').show();
    $('#chatBox').show();
    $('#chatInputArea').show();

    $('#chatName').text(name);
    $('#chatImg').attr('src', img);

    fetchMessages();
}

function fetchMessages() {
    if (currentUser == 0) return;

    $.post('getmessage.php', { user_id: currentUser }, function(res) {
        $('#chatBox').html(res);
        scrollToBottom();
    });
}

function scrollToBottom() {
    let box = $('#chatBox')[0];
    box.scrollTop = box.scrollHeight;
}

// Auto Refresh
setInterval(() => {
    if (currentUser != 0) {
        fetchMessages();
    }
}, 3000);

// Send Message
$('#sendForm').submit(function(e) {
    e.preventDefault();
    if (currentUser == 0) return;

    let msgText = $('#msg').val().trim();
    if (msgText == '') return;

    // Optimistic UI for immediate feel could be added here
    
    $.post('send_message.php', {
        receiver_id: currentUser,
        message: msgText
    }, function(res) {
        if(res == 1) {
            $('#msg').val('');
            fetchMessages();
        }
    });
});
</script>

<?php include("includes/footer.php"); ?>