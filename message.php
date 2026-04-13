<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

$login_user_id = $_SESSION['users_id'];

include("includes/header.php");
?>

<div class="container-fluid" style="height:90vh;">
<div class="row h-100">

<!-- USER LIST -->
<div class="col-md-4 border-end overflow-auto">

<h5 class="p-3">Messages</h5>

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
$msg = !empty($user['message']) ? $user['message'] : 'Start chatting...';

?>

<div class="p-3 border-bottom cursor-pointer" style="cursor:pointer;"
onclick="loadChat('<?php echo $user['users_id']; ?>',
'<?php echo htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8'); ?>',
'<?php echo $img; ?>') ">

<img src="<?php echo $img; ?>" width="40" class="rounded-circle border profile-img">
<strong><?php echo htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8'); ?></strong><br>
<small><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></small>

</div>

<?php endwhile; ?>

</div>

<!-- CHAT -->
<div class="col-md-8 d-flex flex-column">

<div id="chatHeader" class="p-3 border-bottom d-flex align-items-center gap-2" style="display:none;">
<img id="chatImg" src="/rythm/assets/profile.png" width="40" style="display: none;">
<h6 id="chatName" style="display: none;">Select User</h6>
<h5 id="chatTitle">Select a user to start chatting</h5>
</div>

<div id="chatBox" class="flex-grow-1 p-3 overflow-auto"></div>

<form id="sendForm" class="p-3 d-flex gap-2" style="display: none">
<input type="text" id="msg" class="form-control" style="display: none;">
<button id="sendBtn" class="btn btn-primary" style="display: none;">Send</button>
</form>

</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
let currentUser = 0;

// LOAD CHAT
function loadChat(id,name,img){
    currentUser = id;

    
    $('#chatName').text(name).show();
    $('#chatImg').attr('src',img).show();
    $('#chatHeader').show();
    $('#sendForm').show();
    $('#msg').show();
    $('#sendBtn').show();
    $('#chatTitle').hide();
    fetchMessages();
}



// FETCH MESSAGES
function fetchMessages(){
    if(currentUser == 0) return;

    $.post('getmessage.php',{user_id:currentUser},function(res){

        $('#chatBox').html(res);

        let box = $('#chatBox')[0];
        box.scrollTop = box.scrollHeight;
    });
}

// AUTO REFRESH
setInterval(() => {
    if(currentUser != 0){
        fetchMessages();
    }
}, 2000);

// SEND MESSAGE
$('#sendForm').submit(function(e){
    e.preventDefault();

    if(currentUser == 0){
        alert("Select user first");
        return;
    }

    let msg = $('#msg').val();
    if(msg.trim()=='') return;

    $.post('send_message.php',{
        receiver_id: currentUser,
        message: msg
    },function(res){
        $('#msg').val('');
        fetchMessages();
    });
});

// ENTER KEY
$('#msg').keypress(function(e){
    if(e.which==13){
        e.preventDefault();
        $('#sendForm').submit();
    }
});
</script>

<?php include("includes/footer.php"); ?>