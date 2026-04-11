<?php
session_start();
require("connect.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['role_master_id'];
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM user_master WHERE id = ?");
$stmt->execute([$id]);
$profiledtils = $stmt->fetch(PDO::FETCH_ASSOC);

$rolemasterid = $profiledtils['role_master_id'];
$pic = $con->query("SELECT * FROM profile_photo_uploaded WHERE rolemaster_id = '$rolemasterid'");
$profilepic = $pic->fetch(PDO::FETCH_ASSOC);
?>

<div class="user-detail-view">
    <div class="flex-between" style="margin-bottom: 20px;">
        <h2>Profile Photo Approval</h2>
        <button type="button" class="follow-button" style="background: #ccc; color: black; margin: 0;" onclick="location.reload();">Back</button>
    </div>

    <div class="flex-between" style="gap: 20px; flex-wrap: wrap; margin-bottom: 20px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
        <label><img src="/rythm/assets/user-account.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo ucfirst($profiledtils['name'] . ' ' . $profiledtils['last_name']); ?></label>
        <label><img src="/rythm/assets/gmail.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $profiledtils['email']; ?></label>
        <label><img src="/rythm/assets/call.png" style="height:20px; vertical-align: middle;">&nbsp;<?php echo $profiledtils['mobile_no']; ?></label>
    </div>

    <div style="text-align: center; margin: 30px 0;">
        <h4 style="margin-bottom: 15px;">Profile Picture</h4>
        <div style="width: 200px; height: 200px; margin: 0 auto; border: 2px solid var(--primary-color); border-radius: 12px; overflow: hidden; background: #eee;">
            <img src="<?php echo $profilepic['photo_path'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>

    <?php if ($profilepic['admin_status'] == 0) { ?>
        <div class="flex-between" style="border-top: 1px solid #ddd; padding-top: 20px;">
            <button type="button" class="follow-button approved" style="background: #28a745; color: white;" onclick="approvedPic(<?php echo $id; ?>);">Approve</button>
            <button type="button" class="follow-button rejects" style="background: #dc3545; color: white;" onclick="rejects();">Reject</button>
        </div>
    <?php } else { ?>
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #ddd;">
            <span style="font-weight: 600; color: <?php echo ($profilepic['admin_status'] == 1) ? 'green' : 'red'; ?>;">
                Status: <?php echo ($profilepic['admin_status'] == 1) ? 'Approved' : 'Rejected'; ?>
            </span>
        </div>
    <?php } ?>
</div>

<div id="popupCard" class="admin-card" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 90%; max-width: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
    <div class="flex-between">
        <h3>Reason for Rejection</h3>
        <img src="/rythm/assets/blkcolorcross.png" style="height:20px; cursor: pointer;" onclick="closepopcard();">
    </div>
    <textarea id="rejectReason" rows="4" style="width: 100%; margin: 15px 0; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
    <button onclick="saveRejectionReasonPic(<?php echo $id; ?>)" class="follow-button" style="background: var(--primary-color); color: black;">Save</button>
</div>

<script>
    function approvedPic(id) {
        $.ajax({
            url: 'approve_profilpic_sts.php?id=' + id,
            type: 'POST',
            success: function(data) {
                if (data == 1) {
                    alert('Profile Picture Approved!');
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

    function saveRejectionReasonPic(id) {
        var reason = $("#rejectReason").val();
        $.ajax({
            url: 'rejected_profilepic_sts.php?id=' + id,
            type: 'POST',
            data: { reason: reason },
            success: function(data) {
                if (data == 1) {
                    alert('Profile Picture Rejected.');
                    location.reload();
                } else {
                    alert('Rejection Failed.');
                }
            }
        });
    }
</script>