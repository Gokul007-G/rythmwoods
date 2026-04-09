<?php

$sql = $con->query("SELECT * FROM `posters` where  status=1 ORDER BY id DESC");

$dyn = 0;
while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {

    $dyn++;
    if ($data != '') {
        $usernameee_id = $data['username_id'];
        $postimg = $data['postimg'];

        $postvideos = $data['postvideos'];
        $posters_path = $data['postimg'];
        $now = time();
        $datediff = $now - strtotime($data['created_on']);
        $numofdays = round($datediff / (60 * 60 * 24));

        if ($numofdays == 0) {
            $postdate = 'Today';
        } else {
            $postdate = $numofdays . 'd';
        }
        $postimgggiddd = $data['id'];

        // Append the unique identifier to the id attribute
        $postimgid = 'postimgid_' . $data['id'];
        $postvideoid = 'postvideoid_' . $data['id'];
        $countoflikests = $con->query("SELECT *,SUM(likestatus) as countoflike FROM `posters` WHERE id='$postimgggiddd' and likestatus!=0 ");
        $getdata = $countoflikests->fetch(PDO::FETCH_ASSOC);
        $getprofile = $con->query("SELECT * FROM `user_master` WHERE users_id='$usernameee_id'");
        //echo "SELECT * FROM `user_master` WHERE users_id='$usernameee_id'";
        $profileimg = $getprofile->fetch(PDO::FETCH_ASSOC);
?>
        <input type="hidden" id="postimgvideoid<?php echo $dyn; ?>" name="postimgvideoid<?php echo $dyn; ?>" value="<?php echo $data['id']; ?>">
        <input type="hidden" id="posterspath<?php echo $dyn; ?>" name="posterspath<?php echo $dyn; ?>" value="<?php echo $data['postimg']; ?>">
        
        <div class="post-card">
            <!-- Post Header -->
            <div class="post-header">
                <div class="post-user-info">
                    <?php
                    $profile_pic_url = ($profileimg['profile_img'] != '') ? $profileimg['profile_img'] : '/rythm/assets/defultuserprofile.png';
                    ?>
                    <img src="<?php echo $profile_pic_url; ?>" alt="User Profile" class="profile-pic" onclick="showaccoun(<?php echo $data['username_id']; ?>);">
                    <div class="post-username-container">
                        <span class="post-username" onclick="showaccoun(<?php echo $data['username_id']; ?>);">
                            <?php echo ucfirst($data['username']); ?>
                        </span>
                        <span class="post-time"><?php echo $postdate; ?></span>
                    </div>
                </div>
                <div class="post-menu-btn" onclick="showPopup(<?php echo $data['id']; ?>,<?php echo $dyn; ?>)">...</div>
            </div>

            <!-- Post Media -->
            <div class="post-image-container">
                <?php if (!empty($postimg)): ?>
                    <img src="<?php echo $postimg; ?>" alt="Post Image">
                <?php elseif (!empty($postvideos)): ?>
                    <video controls>
                        <source src="<?php echo $postvideos; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <div class="icons" style="display:flex;justify-content:flex-start;gap:30px;margin:0 120px;">
                    <div class="icon" onclick="toggleLike(<?php echo $dyn; ?>)">
                        <?php
                        if ($data['ownlikessts'] == 0 && $data['username_id'] == $rolemaster_id) {
                        ?>
                            <img id="likeIcon_<?php echo $dyn; ?>" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns" style="height:25px;width:25px;">
                        <?php
                        } else if ($data['ownlikessts'] == 1 && $data['username_id'] == $rolemaster_id) {
                        ?>
                            <img id="likeIcon_<?php echo $dyn; ?>" src="/rythm/assets/likeredhreat.png" alt="Heart Icon" class="zoomiconns" style="height:25px;width:25px;">
                        <?php
                        } else {
                        ?>
                            <img id="likeIcon_<?php echo $dyn; ?>" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns" style="height:25px;width:25px;">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="icon" onclick="messagepopup(<?php echo $data['id']; ?>, <?php echo $dyn; ?>)">
                        <img src="/rythm/assets/speech-bubble.png" alt="Message Icon" style="height:25px;width:25px;" class="zoomiconns">
                    </div>

                    <!-----------------------------------------messagePopupContentstart------------------------------------->


                    <div id="popup-container_<?php echo $dyn; ?>" class="popup-container" style="display:none;">
                        <img src="/rythm/assets/whitcloseicon.png" class="close-button" onclick="messageclosePopup(<?php echo $dyn; ?>)">
                        <div class="popup-card">
                            <div style="display:flex;justify-content:space-between;">
                                <div class="messagepopup-img<?php echo $dyn; ?>">
                                </div>
                                <div class="messageofrightsidecontent">
                                    <div style="margin-left:370px;">
                                        <div class="user-profile" style="margin-left:0px;">
                                            <img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic">
                                            <span class="username"><span style="font-weight:600;"><?php echo $data['username']; ?></span> . <?php echo $postdate ?></span>
                                        </div>
                                        <!-- <label class="locationname" style="margin-left:60px;"><?php echo $data['location']; ?></label><br> -->
                                        <label class="mesgmoredott" onclick="showPopup2(<?php echo $dyn; ?>)">. . .</label>
                                    </div>
                                    <hr style="width:72vh;margin-left:50vh;color:lightgray;">
                                    <div class="messageddcontent" style="margin-top:-10px;">
                                        <div class="user-profile1" style="margin-left:49vh;">
                                            <img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic1">
                                            <div style="max-width:380px;">
                                                <label class="username">
                                                    <font style="font-weight:600;"><?php echo $data['username']; ?></font><span style="font-weight:normal;color:blue;">&nbsp;&nbsp;<?php echo $data['posters_caption']; ?> </span>
                                                </label>
                                            </div>
                                        </div><br><br>
                                        <label style="color:gray;margin-left:53vh;"><?php echo $postdate; ?></label>
                                        <br><br>
                                        <?php
                                        $posteriddddd = $data['id'];
                                        $commanderdetails = $con->query("SELECT * FROM `posters_commads` WHERE posterid='$posteriddddd' order by id desc");
                                        $popdyid = 0;
                                        while ($commanddata = $commanderdetails->fetch(PDO::FETCH_ASSOC)) {
                                            $popdyid++;
                                            $now = time();
                                            $cmddatediff = $now - strtotime($commanddata['created_on']);
                                            $cmdnumofdays = round($cmddatediff / (60 * 60 * 24));
                                            if ($cmdnumofdays == 0) {
                                                $cmdpostdate = 'Today';
                                            } else {
                                                $cmdpostdate = $cmdnumofdays . 'd';
                                            }
                                            $useridddd = $commanddata['commander_id']; //userid
                                            $allcommands = $commanddata['commands']; //all commandss
                                            $getuserdetails = $con->query("SELECT * FROM `posters` where username_id='$useridddd' and status=1");
                                            $alldetails = $getuserdetails->fetch(PDO::FETCH_ASSOC);
                                            // echo $alldetails['username'].'sdfghjkkjhgfd';
                                        ?>
                                            <div style="margin-left:52vh;">
                                                <div class="user">
                                                    <img src="/rythm/assets/penguin.png" class="profile-pic">
                                                    <span class="followername"><?php echo $alldetails['username']; ?>&nbsp;&nbsp;<span style="font-weight:400;"><?php echo ucfirst($allcommands); ?></span></span>
                                                </div>
                                                <div style="display:flex;justify-content:space-flex-start;">
                                                    <label style="color:gray;margin-left:48px;max-width:380px;"><?php echo $cmdpostdate; ?></label>
                                                    <?php
                                                    $cmderid = $alldetails['id']; //cmder id
                                                    $takecuntlikes = $con->query("SELECT *,sum(likests_cmd) as likcntt FROM `posters_commads` WHERE posterid='$posteriddddd' and id='$commanddata[id]' and likests_cmd!=0 ");
                                                    $takedata = $takecuntlikes->fetch(PDO::FETCH_ASSOC);
                                                    ?>
                                                    <label style="color:gray;margin-left:48px;" id="msgcmdlikelbelidd_<?php echo $popdyid . '' . $dyn; ?>"><?php echo $takedata['likcntt'] . 'likes'; ?></label>
                                                    <div class="icon" onclick="messagereplyfunc(<?php echo $dyn; ?>,<?php echo $popdyid; ?>,<?php echo $data['username_id']; ?>,<?php echo $posteriddddd; ?>)">
                                                        <label style="color:gray;margin-left:48px;">Reply</label>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($takedata['likeorno'] == 0) {
                                                ?>
                                                    <div class="icon" onclick="messtoggleicon(<?php echo $dyn; ?>,<?php echo $popdyid; ?>,<?php echo $commanddata['id']; ?>)">
                                                        <img id="messgelikeIcon_<?php echo $dyn . '' . $popdyid; ?>" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns" style="height:17px;width:17px;display:flex;margin:-25px 430px;">
                                                    </div>
                                                    <br><br><br>
                                            </div>
                                        <?php
                                                } else if ($takedata['likeorno'] == 1) {
                                        ?>
                                            <div class="icon" onclick="messtoggleicon(<?php echo $dyn; ?>,<?php echo $popdyid; ?>,<?php echo $commanddata['id']; ?>)">
                                                <img id="messgelikeIcon_<?php echo $dyn . '' . $popdyid; ?>" src="/rythm/assets/likeredhreat.png" alt="Heart Icon" class="zoomiconns" style="height:17px;width:17px;display:flex;margin:-25px 430px;">
                                            </div>
                                            <br><br><br>
                                    </div>
                                <?php
                                                }
                                ?>
                            <?php
                                        }
                            ?>
                                </div>
                                <hr style="width:70vh;margin-left:52vh;color:lightgray;">
                                <div class="comment-section" onkeyup="typeacommandsecond(<?php echo $dyn; ?>);" style="width:68vh;margin-left:366px;">
                                    <textarea type="text" name="bio<?php echo $dyn; ?>"
                                        class="form-control emoji_act"
                                        id="bio<?php echo $dyn; ?>"
                                        placeholder="Add a Comment"
                                        onkeyup="count_char(this, 140);"></textarea> <span id="bio_val"></span>
                                    <br>
                                    <label id="postatag<?php echo $dyn; ?>" style="color:blue;display:none;float:right;" onclick="commandinsert(<?php echo $dyn; ?>, <?php echo $data['id']; ?>,  <?php echo $rolemaster_id; ?>);">Post</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------------------------------messagePopupContentEnd-------------------------------------->

                <div class="icon" onclick="sharePost(<?php echo $dyn; ?>)">
                    <img src="/rythm/assets/send.png" alt="Send Icon" style="height:25px;width:25px;" class="zoomiconns">
                </div>

                <!-------------------------------------Share the posts startportion----------------------------------->

                <div id="popup-sharePostcontainer_<?php echo $dyn; ?>" class="popup-container" style="display:none;">
                    <div class="popup-card" style="width:40%;height:70%;">
                        <img src="/rythm/assets/blkcolorcross.png" class="close-button" onclick="shareclosePopup(<?php echo $dyn; ?>)" style="height:20px;width:20px;">
                        <h2 style="text-align:center;">Share</h2>
                        <hr>
                        <label style="font-size:20px;font-weight:600;font-style:italic;">To:&nbsp;<input type="text" id="tosendposts<?php echo $dyn; ?>" name="tosendposts<?php echo $dyn; ?>" class="tosendimpuuuut" placeholder="Search..." /></label>
                        <hr>
                        <br>
                        <?php
                        $shareedyid = 0;
                        $sql2 = $con->query("SELECT * FROM `user_master`");
                        while ($sharedata = $sql2->fetch(PDO::FETCH_ASSOC)) {
                            $shareedyid++;
                        ?>
                            <div class="folowersnameee">
                                <div style="display:flex;justify-content:space-between;">
                                    <div class="user">
                                        <img src="/rythm/assets/lion.png" class="profile-pic">
                                        <span class="followername"><?php echo ucfirst($sharedata['user_name']); ?>&nbsp;&nbsp;<span style="font-weight:400;"></span>
                                    </div>
                                    <img id="clickableImage_<?php echo $dyn . '' . $shareedyid; ?>" src="/rythm/assets/circle.png" onclick="changeImage(<?php echo $shareedyid; ?>, '<?php echo ucfirst($sharedata['user_name']); ?>',<?php echo $sharedata['id']; ?>,<?php echo $dyn; ?>)" style="height:30px;width:30px;">
                                </div>
                                <style>
                                    .folowersnameee {
                                        overflow-y: auto;
                                        /* Add vertical scroll bar */
                                        max-height: 200px;
                                        /* Set maximum height to enable scrolling */
                                        /* You can adjust the max-height value according to your needs */
                                    }

                                    .share-btn {
                                        background-color: pink;
                                        color: white;
                                        border: none;
                                        padding: 10px 20px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 16px;
                                        cursor: pointer;
                                        border-radius: 5px;
                                        width: 100%;

                                    }

                                    .tosendimpuuuut {
                                        box-shadow: none;
                                        outline: none;
                                        border: none;
                                        padding: 10px;
                                    }

                                    /* Default placeholder color (gray) */
                                    .form-control::placeholder {
                                        color: gray;
                                    }

                                    .emojionearea .emojionearea-editor:empty:before {
                                        content: attr(placeholder);
                                        display: block;
                                        color: #e6005c;
                                        font-weight: 900;
                                    }

                                    /* Dark pink color for placeholder text */
                                    .form-control:focus::placeholder {
                                        color: #d63384;
                                        /* Adjust this hex code for the desired pink shade */
                                    }
                                </style>
                            </div>
                        <?php
                        }
                        ?>
                        <br>
                        <hr>
                        <div id="writesenttopsmess<?php echo $dyn; ?>" style="display:none;">
                            <input type="text" id="writemgsforpost<?php echo $dyn; ?>" name="writemgsforpost<?php echo $dyn; ?>" placeholder="write a message..." class="tosendimpuuuut">
                        </div>
                        <br>
                        <input type="hidden" id="sendterids<?php echo $dyn; ?>" name="sendterids<?php echo $dyn; ?>" value="">
                        <button type="button" class="share-btn" id="sharebtnnn_<?php echo $dyn; ?>" onclick="sendsumbit(<?php echo $data['id']; ?>,<?php echo $dyn; ?>)">Send</button>
                    </div>
                </div>

                <!-------------------------------------Share the posts endportion----------------------------------->

            </div>
            <?php
            $saveddata = $con->query("SELECT * FROM `poster_download` WHERE poster_id='$posteriddddd' and downloader_id='$rolemaster_id' and donwload_sts!=0 order by id desc");

            if ($saveddata) {
                $getsave_data = $saveddata->fetch(PDO::FETCH_ASSOC);
                if ($getsave_data) {
                    // Poster is saved
                    if ($getsave_data['donwload_sts'] == 1) {
                        echo '<div class="icon" onclick="savedpost(' . $dyn . ');">';
                        echo '<img id="savebtnicon_' . $dyn . '" src="/rythm/assets/savedpost.png" alt="Save Icon" style="height:25px;width:25px;" class="zoomiconns">';
                        echo '<div class="save-label">Remove</div>';
                        echo '</div>';
                    } else {
                        // Poster is not saved
                        echo '<div class="icon" onclick="savedpost(' . $dyn . ');">';
                        echo '<img id="savebtnicon_' . $dyn . '" src="/rythm/assets/bookmark.png" alt="Save Icon" style="height:25px;width:25px;" class="zoomiconns">';
                        echo '<div class="save-label">Save</div>';
                        echo '</div>';
                    }
                } else {
                    // No save data found, poster is not saved
                    echo '<div class="icon" onclick="savedpost(' . $dyn . ');">';
                    echo '<img id="savebtnicon_' . $dyn . '" src="/rythm/assets/bookmark.png" alt="Save Icon" style="height:25px;width:25px;" class="zoomiconns">';
                    echo '<div class="save-label">Save</div>';
                    echo '</div>';
                }
            } else {
                // Query failed
                echo 'Query failed: ' . $con->error;
            }
            ?>

        </div>
        <br>
        <div style="margin-left:120px">
            <label style="font-weight:600;" id="likelbelidd_<?php echo $dyn; ?>"><?php echo $getdata['countoflike'] . 'likes'; ?></label><br><br>
            <div style="max-width: 400px;">
                <label style="font-weight:600;"><?php echo ucfirst($data['username']) ?></label>&nbsp <?php echo  ucfirst($data['posters_caption']); ?><br><br>
                <div class="comment-section" onkeyup="typeacommand(<?php echo $dyn; ?>);" style="width:110vh;margin-left:8px;">
                    <textarea type="text" name="bio<?php echo $dyn; ?>"
                        class="form-control emoji_act"
                        id="bio<?php echo $dyn; ?>"
                        placeholder="Add a Comment"
                        onkeyup="count_char(this, 140);"></textarea> <span id="bio_val"></span>
                    <br>
                    <label id="postatag_<?php echo $dyn; ?>" style="color:blue;display:none;" onclick="commandinsert(<?php echo $dyn; ?>, <?php echo $data['id']; ?>,  <?php echo $rolemaster_id; ?>);">Post</label>
                </div>
            </div>
            <hr>
        </div>
        </div>
    <?php
    } else {
        echo "<label style='color:red;font-size:25px;font-weight:600;margin:20px 180px;'>Data Found!</label>";
    }
    ?>
    <input type='hidden' id="dyiiidesettthhreedot" value="" />
    <input type='hidden' id="useridsetintothreedot" value="" />

    <div class="threedotpopup" id="threedotpopup<?php echo $dyn; ?>" style="display:none;">
        <div class="threedotpopup-content"><br><br>
            <label style="color:red;font-weight:600;">Report</label>
            <hr><br>
            <?php
            if ($profileimg['followsts'] == 1) {
            ?>
                <label id="opensuggesfollobtn<?php echo $dyn; ?>" style="color:red;font-weight:600;" onclick="unfollowpopcard(<?php echo $dyn; ?>,<?php echo $profileimg['id']; ?>);">Unfollow</label>
            <?php
            } else {
            ?>
                <label id="followlabelbtn_<?php echo $dyn; ?>" style="color:blue;font-weight:600;" onclick="followbrnnnn(<?php echo $dyn; ?>,<?php echo $profileimg['id']; ?>);">follow</label>
            <?php
            }
            ?>
            <hr><br>
            <label>Add to Favorites</label>
            <hr><br>
            <!-- <label onclick="messagepopup(<?php echo $data['id']; ?>,<?php echo $dyn; ?>);">Go To Post</label>
	   <hr><br> -->
            <label onclick="sharePost(<?php echo $dyn; ?>)">Share to </label>
            <hr><br>
            <label>Copy link</label>
            <hr><br>
            <!-- <label>Embed</label>
	   <hr><br> -->
            <label>About This Account</label>
            <hr><br>
            <label onclick="closePopup(<?php echo $dyn; ?>)">Cancel</label>
        </div>
    </div>
<?php

}
?>

<style>
    .post-image {
        width: 800px;
        height: 600px;
        border-radius: 10px;
    }

    /* Add this to your stylesheet */
    .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        /* 16:9 aspect ratio */
        height: 240px;
    }

    .video-container video {
        position: absolute;
        top: 0;
        border-radius: 10px;
        left: 0;
        width: 102%;
        height: 100%;
        background: black;
    }

    .threedotpopup-content {
        height: 400px;
        width: 450px;
        background: white;
        border-radius: 10px;
        text-align: center;
        max-height: 200vh;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function showPopup(useridgettttt, flowdyif) {
        //	debugger;
        //var flloworunfoolow=$("#flloworunfoolow_"+flowdyif).val();

        $.ajax({
            url: 'getfollowsts.php', // Replace with your server-side script URL
            type: 'POST',
            data: {
                userid: useridgettttt
            }, // Pass useriddd to the server
            success: function(followsts) {
                if (followsts != 1) {
                    //alert(followsts);

                    console.warn(followsts);
                    var flloworunfoolow = $("#flloworunfoolow_" + flowdyif).val('Follow');
                    // Bind the click event to show the pop-up card

                } else {
                    var flloworunfoolow = $("#flloworunfoolow_" + flowdyif).val('UnFollow');
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr, status, error);
            }
        });
        var popup = document.getElementById('threedotpopup' + flowdyif);
        popup.style.display = 'flex';
    }

    function closePopup() {
        var popup = document.getElementById('threedotpopup' + flowdyif);
        popup.style.display = 'none';
    }

    function followbrnnnn(dyidgett, useriddd) {
        debugger;
        var $btn = $("#followlabelbtn_" + dyidgett);

        // Check if the button is already in the "Following" state
        if ($btn.text().trim() === 'Following') {
            threedotunfollowpopcard(dyidgett, useriddd);
            return; // Exit the function to prevent further execution
        }

        // Change the button text to "Loading..."
        $btn.html('<img src="/rythm/assets/loadinggif.gif" alt="Loading..." style="height:50px;width:50px;">');

        // Disable the button to prevent multiple clicks
        $btn.prop('disabled', true);
        var timeoutId = setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: 'followingsts.php',
                data: {
                    followingsts: 1,
                    user_id: useriddd
                },
                success: function(gotresponse) {
                    if (gotresponse == 1) {
                        $btn.text('Following').css('color', 'gray');
                        // Bind the click event to show the pop-up card
                        $btn.one('click', function() {
                            threedotunfollowpopcard(dyidgett, useriddd);
                        });
                    } else {
                        $btn.text('Follow').css('color', 'blue');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                    $btn.text('Follow'); // Revert back to original text on error
                },
                complete: function() {
                    // Re-enable the button after the AJAX request completes
                    $btn.prop('disabled', false);
                }
            });
        }, 2000);
    }

    function threedotunfollowpopcard(dyidgett, useriddd) {
        debugger;

        var dyiiidesett = $("#dyiiidesettthhreedot").val(dyidgett);
        var useridsetinto = $("#useridsetintothreedot").val(useriddd);

        // Create a div element for the pop-up card
        var popupHtml = '<div id="afterfollowingpopcard" class="afterfollowpop" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: none; justify-content: center; align-items: center; overflow: auto;">' +
            '<div id="afterfollowingpopcard-content" class="afterfollowpop-content" style="position: fixed; top:30%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 0px solid #ccc; border-radius: 17px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);height:35vh;width:65vh;">' +
            '<img src="/rythm/assets/rsz_logo2.png" style="height:50px;width:50px;border-radius:50%;margin:0 auto;"><br><br>' +
            '<label id="usernamedisply" style="font-size:18px;"></label><br><br>' +
            '<hr><br>' +
            '<label onclick="unfollowfunc(' + dyidgett + ',' + useriddd + ')" style="color:red;font-size:18px;">Unfollow</label><br><br>' +
            '<hr><br>' +
            '<label onclick="closePopupfollowing()" style="color:black;font-size:18px;">cancle</label><br><br>' +
            '</div>' +
            '</div>';

        // Append the HTML content to the body
        $('body').append(popupHtml);

        // Show the popup card
        $('#afterfollowingpopcard').show();

        $.ajax({
            url: 'fetche_following_name.php', // Replace with your server-side script URL
            type: 'POST',
            data: {
                userid: useriddd
            }, // Pass useriddd to the server
            success: function(getusername) {
                //console.warn(getusername);
                var labelName = "Unfollow @ " + getusername;
                $("#usernamedisply").text(labelName);
                // Handle the response from the server
                // You can update the content of the pop-up card here
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr, status, error);
            }
        });
    }

    function closePopupfollowing() {
        // Remove the pop-up card from the DOM
        $('#afterfollowingpopcard').hide();
    }

    function unfollowpopcard(dyidgett, useriddd) {
        //debugger;

        var dyiiidesett = $("#dyiiidesett").val(dyidgett);
        var useridsetinto = $("#useridsetinto").val(useriddd);

        // Create a div element for the pop-up card
        var popupHtml = '<div id="afterfollowingpopcard" class="afterfollowpop" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: none; justify-content: center; align-items: center; overflow: auto;">' +
            '<div id="afterfollowingpopcard-content" class="afterfollowpop-content" style="position: fixed; top:30%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 0px solid #ccc; border-radius: 17px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);height:35vh;width:65vh;">' +
            '<img src="/rythm/assets/rsz_logo2.png" style="height:50px;width:50px;border-radius:50%;margin:0 auto;"><br><br>' +
            '<label id="usernamedisply" style="font-size:18px;"></label><br><br>' +
            '<hr><br>' +
            '<label onclick="unfollowfunc(' + dyidgett + ',' + useriddd + ')" style="color:red;font-size:18px;">Unfollow</label><br><br>' +
            '<hr><br>' +
            '<label onclick="closePopupfollowing()" style="color:black;font-size:18px;">cancle</label><br><br>' +
            '</div>' +
            '</div>';

        // Append the HTML content to the body
        $('body').append(popupHtml);

        // Show the popup card
        $('#afterfollowingpopcard').show();

        $.ajax({
            url: 'fetche_following_name.php', // Replace with your server-side script URL
            type: 'POST',
            data: {
                userid: useriddd
            }, // Pass useriddd to the server
            success: function(getusername) {
                //console.warn(getusername);
                var labelName = "Unfollow @ " + getusername;
                $("#usernamedisply").text(labelName);
                // Handle the response from the server
                // You can update the content of the pop-up card here
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr, status, error);
            }
        });
    }

    function gotopost() {
    }

    function typeacommand(dyid) {
        $("#postatag" + dyid).slideDown();
    }

    function typeacommand(dyid) {
        //debugger;
        $("#postatag_" + dyid).show();
    }

    function commandinsert(dyid, posterid, commanderid) {
        debugger;
        var textareaval = $('#bio_' + dyid).val();
        var alldataval = posterid + "**" + commanderid + "**" + textareaval;

        $.ajax({
            type: "POST",
            url: "/rythm/commandsinsert.php",
            data: {
                alldata: alldataval
            },
            success: function(data) {

                if (data == 1) {
                    window.location.href = "/rythm/homee.php";
                }
            }
        });
    }

    function typeacommandsecond(dyid) {
        //debugger;
        $("#postatag" + dyid).show();
    }

    function commandinsertsecond(dyid, posterid, commanderid) {
        debugger;
        var textareaval = $('#bio' + dyid).val();
        var alldataval = posterid + "**" + commanderid + "**" + textareaval;

        $.ajax({
            type: "POST",
            url: "/rythm/commandsinsert.php",
            data: {
                alldata: alldataval
            },
            success: function(data) {

                if (data == 1) {
                    window.location.href = "/rythm/homee.php";
                }
            }
        });
    }
</script>

<script>
    let isLiked = false;

    function toggleLike(dyyid) {
        //	debugger;
        isLiked = !isLiked;
        var likeIcon = document.getElementById('likeIcon_' + dyyid);
        var postimgvideoid = document.getElementById('postimgvideoid' + dyyid).value;

        if (isLiked) {
            likeIcon.src = "/rythm/assets/likeredhreat.png";
            likeIcon.style.filter = "brightness(1.2)";
            updateLikeStatus(postimgvideoid, 1, dyyid); // 1 indicates liked
        } else {
            likeIcon.src = "/rythm/assets/likeheart.png";
            likeIcon.style.filter = "brightness(1)";
            updateLikeStatus(postimgvideoid, 0, dyyid); // 0 indicates unliked
        }
    }

    function updateLikeStatus(postId, likeStatus, dyyid) {
        //	debugger;
        $.ajax({
            type: 'POST',
            url: 'updatelikests.php',
            data: {
                post_id: postId,
                like_status: likeStatus
            },
            success: function(dta) {
                console.warn(dta);
                document.getElementById('likelbelidd_' + dyyid).innerText = dta;
                //window.location.href='/rythm/homee.php';				   
            },
            error: function(error) {
                // console.error(error);
            }
        });
    }
</script>

<script>
    let isLiked2 = false;

    function messtoggleicon(dynmid, cmdlikeid, cmdersid) {
        //debugger;
        isLiked2 = !isLiked2;
        var likeIcon = document.getElementById('messgelikeIcon_' + dynmid + '' + cmdlikeid);
        var postimgvideoid = document.getElementById('postimgvideoid' + dynmid).value;

        if (isLiked2) {
            likeIcon.src = "/rythm/assets/likeredhreat.png";
            likeIcon.style.filter = "brightness(1.2)";
            updateLikeStatusforcmds(postimgvideoid, 1, cmdersid, cmdlikeid, dynmid); // 1 indicates liked
        } else {
            likeIcon.src = "/rythm/assets/likeheart.png";
            likeIcon.style.filter = "brightness(1)";
            updateLikeStatusforcmds(postimgvideoid, 0, cmdersid, cmdlikeid, dynmid); // 1 indicates liked
        }
    }

    function updateLikeStatusforcmds(postId, likeStatus, cmderrid, cmdlikeid, dynmid) {
        //debugger;
        $.ajax({
            type: 'POST',
            url: 'updatelikestsforcmnders.php',
            data: {
                post_id: postId,
                like_status: likeStatus,
                commder_id: cmderrid
            },
            success: function(response) {
                console.warn(response);
                document.getElementById('msgcmdlikelbelidd_' + cmdlikeid + '' + dynmid).innerText = response;
                //window.location.href='/rythm/homee.php';				   
            },
            error: function(error) {
                // console.error(error);
            }
        });
    }
</script>

<script>
    // Add this JavaScript for handling the popup
    function messagepopup(id, dyn) {
        debugger;
        // Show the popup container
        document.getElementById('popup-container_' + dyn).style.display = 'block';
        $.ajax({
            type: 'POST',
            url: 'messagecontent.php',
            data: {
                post_id: id
            },
            dataType: 'json', // Specify JSON dataType
            success: function(response) {
                var messagePopupContent = document.querySelector('.messagepopup-img' + dyn);
                if (!messagePopupContent) {
                    console.error('Error: .messagepopup-img element not found.');
                    return;
                }
                messagePopupContent.innerHTML = '';
                if (response.postType === 'image') {
                    var imgElement = document.createElement('img');
                    imgElement.src = response.content;
                    imgElement.style.width = '340px';
                    imgElement.style.height = '100.3%';
                    imgElement.style.position = 'absolute'; // or 'absolute'
                    imgElement.style.top = '-1px';
                    imgElement.style.left = '0px';
                    messagePopupContent.appendChild(imgElement);
                } else if (response.postType === 'video') {
                    console.log('Video URL:', response.content);
                    var videoElement = document.createElement('video');
                    videoElement.width = '380';
                    videoElement.height = '120%'; // Set the same height percentage as the image
                    videoElement.controls = true;
                    var sourceElement = document.createElement('source');
                    sourceElement.src = response.content;
                    sourceElement.type = 'video/mp4';
                    videoElement.appendChild(sourceElement);
                    // Apply the same styles as the image element
                    videoElement.style.width = '340px';
                    videoElement.style.height = '100.3%';
                    videoElement.style.position = 'absolute'; // or 'absolute'
                    videoElement.style.top = '-1px';
                    videoElement.style.left = '0px';
                    videoElement.style.background = 'black';

                    // Check if the video tag is appended to the parent element
                    if (messagePopupContent.appendChild(videoElement)) {
                        console.log('Video tag appended successfully.');
                    } else {
                        console.error('Error appending video tag to .messagepopup-img.');
                    }
                } else {
                    console.error('Invalid post type:', response.postType);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
        centerPopup(dyn);
    }

    function messageclosePopup(dyn) {
        // Close the popup container
        document.getElementById('popup-container_' + dyn).style.display = 'none';
    }

    function centerPopup(dyn) {
        // Center the popup on the screen
        var popupContainer = document.getElementById('popup-container_' + dyn);
        var screenWidth = window.innerWidth;
        var screenHeight = window.innerHeight;
        var popupWidth = popupContainer.offsetWidth;
        var popupHeight = popupContainer.offsetHeight;
        var leftPosition = (screenWidth - popupWidth) / 2;
        var topPosition = (screenHeight - popupHeight) / 2;
        popupContainer.style.left = leftPosition + 'px';
        popupContainer.style.top = topPosition + 'px';
    }

    // Call centerPopup() on window resize to recenter the popup
    window.addEventListener('resize', centerPopup);
</script>

<script>
    function sharePost(dyn) {
        document.getElementById('popup-sharePostcontainer_' + dyn).style.display = 'block';
    }

    function shareclosePopup(dyn) {
        document.getElementById('popup-sharePostcontainer_' + dyn).style.display = 'none';
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var selectedSharers = []; // Initialize an array to store selected sharers

    var selectssharesidd = [];

    function changeImage(sharedynn, sharername, id, dyn) {
        //debugger;
        var clickableImage = document.getElementById('clickableImage_' + dyn + '' + sharedynn);
        var shareBtn = document.getElementById('sharebtnnn_' + dyn);
        var tosendposts = document.getElementById('tosendposts' + dyn);
        var writesenttopsmess = document.getElementById('writesenttopsmess' + dyn);

        var sendterids = document.getElementById('sendterids' + dyn);

        // Check the current source of the image
        if (clickableImage.src.includes('circle.png')) {
            // Change to the tickmark image
            clickableImage.src = '/rythm/assets/check.png';
            clickableImage.style.height = '30px';
            clickableImage.style.width = '30px';


            selectedSharers.push(sharername); //namepush
            selectssharesidd.push(id); //idpush
        } else {
            // Change back to the circle image
            clickableImage.src = '/rythm/assets/circle.png';

            // Remove the sharername from the selectedSharers array
            var index = selectedSharers.indexOf(sharername);
            if (index !== -1) {
                selectedSharers.splice(index, 1);

            }
            var index = selectssharesidd.indexOf(id);
            if (index !== -1) {
                selectssharesidd.splice(index, 1);
            }
        }

        // Update the input box value with all selected sharers
        tosendposts.value = selectedSharers.join(', ');
        sendterids.value = selectssharesidd.join(', ');
        tosendposts.style.fontSize = '20px'; // Use camelCase for fontSize
        tosendposts.style.color = 'deeppink';

        // Update the button background color based on selectedSharers length
        shareBtn.style.background = selectedSharers.length > 0 ? 'deeppink' : 'pink';
        writesenttopsmess.style.display = selectedSharers.length > 0 ? 'block' : 'none';
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function sendsumbit(posterid, dynamicid) {
        //debugger;
        var writesenttopsmess = $('#writemgsforpost' + dynamicid).val();
        var sendterids = document.getElementById('sendterids' + dynamicid).value;

        // console.log('posterid:', posterid);
        //console.log('dynamicid:', dynamicid);
        //console.log('writesenttopsmess:', writesenttopsmess);
        //console.log('sendterids:', sendterids);

        $.ajax({
            type: 'POST',
            url: '/rythm/messagesendandpost.php',
            data: {
                post_id: posterid,
                tosenderid: sendterids,
                messagecontent: writesenttopsmess
            },
            success: function(response) {
                if (response == 1) {
                    alert('send!');
                    window.location.href = '/rythm/homee.php';
                } else {
                    alert('not send!');
                    window.location.href = '/rythm/homee.php';
                }
                console.warn(response);
                // Handle success
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
    }
</script>

<script>
    function showPopup2(dyiddddd) {
        //	debugger;
        var messag = document.getElementById('popup-container_' + dyiddddd);
        messag.style.display = 'none';
        var popup = document.getElementById('threedotpopup' + dyiddddd);
        popup.style.display = 'flex';
    }

    function closePopup2() {
        var popup = document.getElementById('threedotpopup' + dyiddddd);
        popup.style.display = 'none';
    }
</script>
<script>
    function messagereplyfunc(dynmicid, popdynmicid, commderid, posterid) {
        //debugger;
        $.ajax({
            type: 'POST',
            url: 'getcommdername.php',
            data: {
                post_id: posterid,
                //like_status: commderid,
                commder_id: commderid
            },
            success: function(response) {

                console.warn(response);
                //document.getElementById('msgcmdlikelbelidd_'+cmdlikeid + '' +dynmid).innerText = response;	
                //window.location.href='/rythm/homee.php';				   
            },
            error: function(error) {
                // console.error(error);
            }
        });
    }
</script>

<script>
    let saveornot = false;
    function savedpost(dynmicccccc) {
        var likeIcon = document.getElementById('savebtnicon_' + dynmicccccc);
        var postimgvideoid = document.getElementById('postimgvideoid' + dynmicccccc).value;
        var posterspath = document.getElementById('posterspath' + dynmicccccc).value;

        // Determine the save status based on the current image displayed
        var saveStatus = (likeIcon.src.includes('savedpost.png')) ? 0 : 1;

        // Update the UI and the save status based on the current save status
        if (saveStatus === 1) {
            likeIcon.src = "/rythm/assets/savedpost.png";
            likeIcon.style.filter = "brightness(1.2)";
        } else {
            likeIcon.src = "/rythm/assets/bookmark.png";
            likeIcon.style.filter = "brightness(1)";
        }

        // Call the function to update the server-side save status
        updateposterssave(postimgvideoid, saveStatus, dynmicccccc, posterspath);
    }

    function updateposterssave(postId, savests, dynmicccccc, posterspath) {
        debugger;
        $.ajax({
            type: 'POST',
            url: 'updateposters_saved.php',
            data: {
                post_id: postId,
                save_status: savests,
                posters_path: posterspath
            },
            success: function(getdtaa) {
                if (getdtaa == 1) {
                    alert('Post saved!..');
                } else {
                    alert('Post not saved!..');
                }
                // Redirect to homee.php regardless of success or failure
                window.location.href = 'homee.php';
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>