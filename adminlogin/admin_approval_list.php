<?php
session_start();
require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Approval List - RythmWoods</title>
    <link rel="stylesheet" href="../mystyle.css?v=1.2">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <main class="main-content">
        <div class="header-user" style="position: absolute; top: 20px; right: 20px;">
            <a href="/rythm/adminlogin/login.php">
                <img src="/rythm/assets/switch.png" style="height: 40px; width: 40px; border-radius: 50%;">
            </a>
        </div>

        <div class="admin-card" style="margin-top: 40px; text-align: left;">
            <h2 style="margin-bottom: 20px; text-align: center;">Admin Profile Approval List</h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="padding: 12px; border: 1px solid #ddd;">No</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Name</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Category</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Status</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $username = $_SESSION['username'];
                        $rolemaster_id = $_SESSION['role_master_id'];
                        $inc = 0;
                        $sql1 = $con->query("SELECT * FROM `user_master` WHERE profile_update_status=1 AND admin_status=1");
                        while ($getuserdetails = $sql1->fetch(PDO::FETCH_ASSOC)) {
                            $inc++;
                            $userole = $getuserdetails['role_master_id'];
                            $sql2 = $con->query("SELECT DISTINCT * FROM `profile_photo_uploaded` WHERE rolemaster_id='$userole' ORDER BY id DESC");
                            $profiledtils = $sql2->fetch(PDO::FETCH_ASSOC);

                            if ($profiledtils) {
                                $rolemasterid = $profiledtils['rolemaster_id'];
                                $getuserdetials = $con->query("SELECT * FROM `user_master` WHERE role_master_id='$rolemasterid'");
                                $uerdetails = $getuserdetials->fetch(PDO::FETCH_ASSOC);

                                if ($uerdetails) {
                                    ?>
                                    <tr>
                                        <td style="padding: 12px; border: 1px solid #ddd; text-align: center;"><?php echo $inc; ?></td>
                                        <td style="padding: 12px; border: 1px solid #ddd;"><?php echo ucfirst($uerdetails['user_name']); ?></td>
                                        <td style="padding: 12px; border: 1px solid #ddd;"><?php echo ucfirst($uerdetails['title']); ?></td>
                                        <td style="padding: 12px; border: 1px solid #ddd; text-align: center; font-weight: 600; color: <?php echo ($profiledtils['admin_status'] == 1) ? 'green' : 'red'; ?>;">
                                            <?php
                                            if ($profiledtils['admin_status'] == 0) echo "Waiting Approval";
                                            elseif ($profiledtils['admin_status'] == 1) echo "Approved";
                                            elseif ($profiledtils['admin_status'] == 2) echo "Rejected";
                                            ?>
                                        </td>
                                        <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                                            <button class="follow-button" style="background: var(--primary-color); color: black;" onclick="viewdetails(<?php echo $getuserdetails['id']; ?>);">View</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function viewdetails(id) {
            $.ajax({
                url: 'viewprofileforapproval.php?id=' + id,
                type: 'POST',
                success: function(data) {
                    $('.admin-card').html(data);
                }
            });
        }
    </script>
</body>
</html>