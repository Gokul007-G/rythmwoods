<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Instagram Explore</title>
<style>
.container_vedio {
    max-width: 900px;
    margin-left: 400px;
    padding: 30px;
}

.item {
    width: calc(33.33% - 10px); /* 33.33% width for each item with 10px spacing between them */
    margin-bottom: 20px;
    display: inline-block; /* Display items inline */
    vertical-align: top; /* Align items to the top */
    position: relative; /* Position relative for absolute positioning of overlay */
}

.item:hover {
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background on hover */
    color: white; /* Change text color to white on hover */
}

.item img, .item video {
    width: 100%;
    border-radius: 5px;
}

.imgsize, .videosize {
    height: 300px;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(128, 128, 128, 0.5); /* Semi-transparent gray background */
    display: none; /* Initially hidden */
    justify-content: center;
    align-items: center;
    color: black; /* Text color for overlay */
}

.item:hover .overlay {
    display: flex; /* Show overlay on hover */
}

.overlay-content {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    text-align: center;
}

.overlay-icon {
    font-size: 24px; /* Adjust icon size */
    margin-bottom: 5px; /* Add some space between icon and text */
}
</style>
</head>
<body>
<div class="container_vedio">
<?php 

session_start();

require("connect.php");	

$username = $_SESSION['username'];
 $rolemaster_id = $_SESSION['role_master_id'];  

$getall = $con->query("SELECT * FROM `posters` WHERE status = '1' order by id desc");
$dyn = 0;
$count=0;
while($data = $getall->fetch(PDO::FETCH_ASSOC))

{
	$dyn++;
	
    $postId = $data['id'];

    // Fetch like count
    $likesQuery = $con->query("SELECT COUNT(likestatus) as like_count FROM posters WHERE poster_id ='$postId'");
   
    $likesData = $likesQuery->fetch(PDO::FETCH_ASSOC);
    $likesCount = $likesData['like_count'];

    // Fetch message count
    $messagesQuery = $con->query("SELECT COUNT(commands) as message_count FROM posters_commads WHERE posterid ='$postId'");
    $messagesData = $messagesQuery->fetch(PDO::FETCH_ASSOC);
    $messagesCount = $messagesData['message_count'];
    
    $postType = $data['post_type'];
    $postImg = $data['postimg'];
    $postVideo = $data['postvideos'];
	
	
	 $now = time();
        $datediff = $now - strtotime($data['created_on']);
        $numofdays = round($datediff / (60 * 60 * 24));

        if ($numofdays == 0) {
            $postdate = 'Today';
        } else {
            $postdate = $numofdays . 'd';
        }
?>
    <div class="item" onclick="messagepopup(<?php echo $data['id'];?>, <?php echo $dyn; ?>)">
        <?php if ($postType == 'image'): ?>
            <img src="<?php echo $postImg; ?>" alt="Image" class="imgsize">
        <?php elseif ($postType == 'video'): ?>
            <video controls class="videosize">
                <source src="<?php echo $postVideo; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <div class="overlay">
            <div class="overlay-content" >
                <img src="/rythm/assets/heartwhite.png" style="height:25px;width:25px;">
                <span style="color:white;font-size:20px;font-weight:600;"> <?php echo $likesCount; ?></span><br>
                <img src="/rythm/assets/messagewhite.png" style="height:25px;width:25px;">
                <span style="color:white;font-size:20px;font-weight:600;"><?php echo $messagesCount; ?></span>
            </div>
        </div>
    </div>
	
	
	
	<input type="hidden" id="postimgvideoid<?php echo $dyn;?>" name="postimgvideoid<?php echo $dyn;?>" value="<?php echo $data['id'];?>">
 
  <input type="hidden" id="posterspath<?php echo $dyn;?>" name="posterspath<?php echo $dyn;?>" value="<?php echo $data['postimg'];?>">
	
	
<?php 
    $count++;
    if ($count % 3 == 0) { // If three items are displayed, start a new line
        echo '<br>';
    }
	?>
	
	
<!-----------------------------------------messagePopupContentstart------------------------------------->
	
	
	<div id="popup-container_<?php echo $dyn; ?>" class="popup-container" style="display:none;">
	
	        <img src="/rythm/assets/whitcloseicon.png" class="close-button" onclick="messageclosePopup(<?php echo $dyn; ?>)">

    <div class="popup-card">
	
	
	       <div style="display:flex;justify-content:space-between;">
		   
		   
	         <div class="messagepopup-img<?php echo $dyn; ?>" >
				
				</div>
	    
       		    
				
			<div class="messageofrightsidecontent">
	
                <div style="margin-left:370px;">
							<div class="user-profile" style="margin-left:0px;">
							<img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic">
							<span class="username"><span style="font-weight:600;"><?php echo $data['username'];?></span> . <?php echo $postdate?></span>
							</div>
						<label class="locationname" style="margin-left:60px;"><?php echo $data['location'];?></label><br>
						<label class="mesgmoredott" onclick="showPopup2(<?php echo $dyn; ?>)" >. . .</label>
				</div>
                    <hr style="width:72vh;margin-left:50vh;color:lightgray;">
					
					
					<div class="messageddcontent" style="margin-top:-10px;">
								<div class="user-profile1" style="margin-left:49vh;">
								<img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic1">
								
								 <div style="max-width:380px;">
								<label class="username"><font style="font-weight:600;"><?php echo $data['username'];?></font><span style="font-weight:normal;color:blue;">&nbsp;&nbsp;<?php echo $data['posters_caption'];?>  </span></label>
                                 </div>							
								</div><br><br>
							      <label style="color:gray;margin-left:53vh;"><?php echo $postdate;?></label>
								  <br><br>
								  
								  <?php
								  $posteriddddd=$data['id'];
								  
								  $commanderdetails=$con->query("SELECT * FROM `posters_commads` WHERE posterid='$posteriddddd' order by id desc");
								  $popdyid=0;
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
									  
									  $useridddd=$commanddata['commander_id'];//userid
									  $allcommands=$commanddata['commands'];//all commandss
									  
									  $getuserdetails=$con->query("SELECT * FROM `posters` where username_id='$useridddd' and status=1");
									  
									  
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
								      $cmderid=$alldetails['id'];//cmder id
								  
								  
								   
								   $takecuntlikes=$con->query("SELECT *,sum(likests_cmd) as likcntt FROM `posters_commads` WHERE posterid='$posteriddddd' and id='$commanddata[id]' and likests_cmd!=0 ");
								 
								   $takedata = $takecuntlikes->fetch(PDO::FETCH_ASSOC);
								   
								   ?>
								   <label style="color:gray;margin-left:48px;" id="msgcmdlikelbelidd_<?php echo $popdyid.''.$dyn;?>"><?php echo $takedata['likcntt'].'likes';?></label>
								 
								   <div class="icon" onclick="messagereplyfunc(<?php echo $dyn;?>,<?php echo $popdyid;?>,<?php echo $data['username_id'];?>,<?php echo $posteriddddd;?>)">
								   <label style="color:gray;margin-left:48px;">Reply</label>
						            </div>
								   </div>
								   
								 <?php
								 if($takedata['likeorno']==0)
								 {
								 ?>
								   <div class="icon" onclick="messtoggleicon(<?php echo $dyn;?>,<?php echo $popdyid;?>,<?php echo $commanddata['id'];?>)">
								   
								    <img  id="messgelikeIcon_<?php echo $dyn.''.$popdyid;?>" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns" style="height:17px;width:17px;display:flex;margin:-25px 430px;">
	                               </div>
								   
								   <br><br><br>
									
									
								 </div>
								  <?php 
								  }
								  else if($takedata['likeorno']==1)
								  {
									   ?>
									  <div class="icon" onclick="messtoggleicon(<?php echo $dyn;?>,<?php echo $popdyid;?>,<?php echo $commanddata['id'];?>)">
								   
								    <img  id="messgelikeIcon_<?php echo $dyn.''.$popdyid;?>" src="/rythm/assets/likeredhreat.png" alt="Heart Icon" class="zoomiconns" style="height:17px;width:17px;display:flex;margin:-25px 430px;">
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
							 
					<div class="comment-section" onkeyup="typeacommandsecond(<?php echo $dyn;?>);" style="width:68vh;margin-left:366px;">
					<textarea type="text" name="bio_<?php echo $dyn;?>" class="form-control emoji_act" id="bio_<?php echo $dyn;?>" placeholder="Add a Command" onkeyup="count_char(this, 140);"></textarea>
                    <span id="bio_val"></span>
                        <br>
						
                   <label id="postatag<?php echo $dyn;?>" style="color:blue;display:none;float:right;" onclick="commandinsert(<?php echo $dyn;?>, <?php echo $data['id'];?>,  <?php echo $rolemaster_id;?>);">Post</label>
				
				</div>
				
				
				
					 </div>
					
				</div>	
				



<div class="threedotpopup2" id="threedotpopup2_<?php echo $dyn;?>" style="display:none;margin:0 auto;">

    <div class="threedotpopup-content2"><br><br>

       <label style="color:red;font-weight:600;">Report</label>
	   <hr><br>
	   <label style="color:red;font-weight:600;">Unfollow</label>
	   <hr><br>
	   <label>Add to Favorites</label>
	   <hr><br>
	   <label>Go To Post</label>
	   <hr><br>
	   <label>share to ...</label>
	   <hr><br>
	   <label>copy link</label>
	   <hr><br>
	   <label>Embed</label>
	   <hr><br>
	   <label>About This Account</label>
	   <hr><br>
	   <label onclick="closePopup2()">Cancel</label>
    </div>
</div>

				
        
    </div>
</div>
							
<!------------------------------------------messagePopupContentEnd-------------------------------------->

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
}
?>

















</div>

<div class="footerlabeel" style="margin-left:400px;display:flex;justify-content:space-between">
    <label class="lableoffooter" style="font-size:18px;">©&nbspAll&nbsprights&nbspreserved&nbsp@2024</label><br>
    <label class="lableoffooter" style="font-size:18px;">Developed&nbspand&nbspMaintained&nbspby&nbspBluebase&nbspSoftware&nbspServices&nbspPrivate&nbspLimited</label>
</div>
<br><br>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Font Awesome CDN -->
<script>
// JavaScript to handle hover events and display overlay with counts
document.querySelectorAll('.item').forEach(item => {
    item.addEventListener('mouseenter', () => {
        item.querySelector('.overlay').style.display = 'flex';
    });

    item.addEventListener('mouseleave', () => {
        item.querySelector('.overlay').style.display = 'none';
    });
});
</script>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
// Add this JavaScript for handling the popup
function messagepopup(id, dyn) {

	//debugger;
    // Show the popup container
    document.getElementById('popup-container_'+dyn).style.display = 'block';

$.ajax({
    type: 'POST',
    url: 'messagecontent.php',
    data: {
        post_id: id
    },
    dataType: 'json', // Specify JSON dataType

    success: function (response) {
        var messagePopupContent = document.querySelector('.messagepopup-img'+dyn);

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
            videoElement.height = '120%';  // Set the same height percentage as the image
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
			videoElement.style.background='black';

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
    error: function (error) {
        console.error(error);
    }
});


	
	
    centerPopup(dyn);
}

function messageclosePopup(dyn) {
    // Close the popup container
    document.getElementById('popup-container_'+dyn).style.display = 'none';
}

function centerPopup(dyn) {
    // Center the popup on the screen
    var popupContainer = document.getElementById('popup-container_'+dyn);
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.js"></script>
  <script>
   $(document).ready(function() {
      $(".emoji_act").emojioneArea({
        emojiPlaceholder: ":smile_cat:",
        searchPlaceholder: "Search",
        buttonTitle: "Use your TAB key to insert emoji faster",
        searchPosition: "bottom",
        pickerPosition: "bottom"
      });
    });
	</script>
	<script>
    function showPopup2(dyiddddd) {
	//	debugger;
		var messag=document.getElementById('popup-container_'+dyiddddd);
		messag.style.display='none';
        var popup = document.getElementById('threedotpopup');
        popup.style.display = 'flex';
    }

    function closePopup2() {
        var popup = document.getElementById('threedotpopup');
        popup.style.display = 'none';
    }
	 
</script>

<script>
function messagereplyfunc(dynmicid,popdynmicid,commderid,posterid)
{
	//debugger;
	$.ajax({
            type: 'POST',
            url: 'getcommdername.php', 
            data: {
                post_id: posterid,
                //like_status: commderid,
				commder_id:commderid
            },
            success: function (response) {
				
				console.warn(response) ;
                  //document.getElementById('msgcmdlikelbelidd_'+cmdlikeid + '' +dynmid).innerText = response;	
               //window.location.href='/rythm/homee.php';				   
                
            },
            error: function (error) {
                
               // console.error(error);
            }
        });
}
</script>
<script>
  let isLiked2 = false;
  
function messtoggleicon(dynmid, cmdlikeid,cmdersid)
{
	//debugger;
	isLiked2 = !isLiked2;
        var likeIcon = document.getElementById('messgelikeIcon_' + dynmid + '' +cmdlikeid);
        var postimgvideoid = document.getElementById('postimgvideoid'+dynmid).value; 

        if (isLiked2) {
            likeIcon.src = "/rythm/assets/likeredhreat.png";
            likeIcon.style.filter = "brightness(1.2)";
            updateLikeStatusforcmds(postimgvideoid, 1,cmdersid,cmdlikeid,dynmid); // 1 indicates liked
        } else {
            likeIcon.src = "/rythm/assets/likeheart.png";
            likeIcon.style.filter = "brightness(1)";
            updateLikeStatusforcmds(postimgvideoid, 0,cmdersid,cmdlikeid,dynmid); // 1 indicates liked
        }
	
	
}

 function updateLikeStatusforcmds(postId,likeStatus,cmderrid,cmdlikeid,dynmid) {
		//debugger;
        $.ajax({
            type: 'POST',
            url: 'updatelikestsforcmnders.php', 
            data: {
                post_id: postId,
                like_status: likeStatus,
				commder_id:cmderrid
            },
            success: function (response) {
				
				console.warn(response) ;
				
                  document.getElementById('msgcmdlikelbelidd_'+cmdlikeid + '' +dynmid).innerText = response;	
                  
               //window.location.href='/rythm/homee.php';				   
                
            },
            error: function (error) {
                
               // console.error(error);
            }
        });
    }
	
function typeacommandsecond(dyid)
{
	$("#postatag"+dyid).slideDown();
}

function typeacommand(dyid)
{
	//debugger;
	$("#postatag_"+dyid).show();
}


function commandinsert(dyid, posterid, commanderid) {
	//debugger;
    var textareaval = $('#bio_' + dyid).val();
    var alldataval = posterid + "**" + commanderid + "**" + textareaval;

    $.ajax({
        type: "POST",
        url: "/rythm/commandsinsert.php",
        data: { alldata: alldataval },
        success: function(data) {
			
			if(data==1)
			{
				window.location.href="/rythm/homee.php";
				
				
			}
			
        }
    });
}
</script>
