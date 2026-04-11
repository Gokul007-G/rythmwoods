<?php
session_start();
require("connect.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['role_master_id'];
$id = $_REQUEST['id'];

$sql2 = $con->query("SELECT * FROM `user_master` WHERE id='$id'");
$profiledtils = $sql2->fetch(PDO::FETCH_ASSOC);

$rolemasterid = $profiledtils['role_master_id'];
$getuserdetials = $con->query("SELECT * FROM `profile_details` WHERE rolemaster_id='$rolemasterid'");
$uerdetails = $getuserdetials->fetch(PDO::FETCH_ASSOC);
?>

<div class="user-detail-view">
    <div class="flex-between" style="margin-bottom: 20px;">
        <h2>User Details</h2>
        <button type="button" class="follow-button" style="background: #ccc; color: black; margin: 0;" onclick="location.reload();">Back</button>
    </div>

    <div class="flex-between" style="gap: 20px; flex-wrap: wrap; margin-bottom: 20px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
        <label><img src="/rythm/assets/user-account.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo ucfirst($profiledtils['name'] . ' ' . $profiledtils['last_name']); ?></label>
        <label><img src="/rythm/assets/gmail.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $profiledtils['email']; ?></label>
        <label><img src="/rythm/assets/call.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $profiledtils['mobile_no']; ?></label>
        <label><img src="/rythm/assets/title.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo ucfirst($profiledtils['title']); ?></label>
        <label><img src="/rythm/assets/gps.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo ucfirst($profiledtils['location']); ?></label>
    </div>

    <div style="margin-bottom: 20px;">
        <h4 style="color: var(--primary-color);">About</h4>
        <p><?php echo ucfirst($uerdetails['about'] ?? 'No description provided.'); ?></p>
    </div>

    <div class="grid-2" style="gap: 20px; margin-bottom: 30px;">
        <div>
            <label><img src="/rythm/assets/facebook.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $uerdetails['facebook'] ?: 'N/A'; ?></label><br><br>
            <label><img src="/rythm/assets/instagram.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $uerdetails['instagram'] ?: 'N/A'; ?></label>
        </div>
        <div>
            <label><img src="/rythm/assets/twitter.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $uerdetails['twitter'] ?: 'N/A'; ?></label><br><br>
            <label><img src="/rythm/assets/youtube.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $uerdetails['youtube'] ?: 'N/A'; ?></label>
        </div>
    </div>

    <div class="flex-between" style="border-top: 1px solid #ddd; padding-top: 20px;">
        <button type="button" class="follow-button approved" style="background: #28a745; color: white;" onclick="approved(<?php echo $id; ?>);">Approve</button>
        <button type="button" class="follow-button rejects" style="background: #dc3545; color: white;" onclick="rejects();">Reject</button>
    </div>
</div>

<div id="popupCard" class="admin-card" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 90%; max-width: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
    <div class="flex-between">
        <h3>Reason for Rejection</h3>
        <img src="/rythm/assets/blkcolorcross.png" style="height:20px; cursor: pointer;" onclick="closepopcard();">
    </div>
    <textarea id="rejectReason" rows="4" style="width: 100%; margin: 15px 0; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
    <button onclick="saveRejectionReason(<?php echo $id; ?>)" class="follow-button" style="background: var(--primary-color); color: black;">Save</button>
</div>

<script>
    function approved(id) {
        $.ajax({
            url: 'approvedstsupdate.php?id=' + id,
            type: 'POST',
            success: function(data) {
                if (data == 1) {
                    alert('Profile Approved Successfully!');
                    location.reload();
                } else {
                    alert('Approval Failed.');
                }
            }
        });
    }

    function rejects() {
        $('#popupCard').fadeIn();
    }

    function closepopcard() {
        $('#popupCard').fadeOut();
    }

    function saveRejectionReason(id) {
        var reason = $("#rejectReason").val();
        $.ajax({
            url: 'rejectwithremarkstsupdate.php?id=' + id,
            type: 'POST',
            data: { reason: reason },
            success: function(data) {
                if (data == 1) {
                    alert('Profile Rejected.');
                    location.reload();
                } else {
                    alert('Rejection Failed.');
                }
            }
        });
    }
</script>