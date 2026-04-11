<style>
.profile-details-container {
    padding: 40px;
    max-width: 935px;
    margin: 0 auto;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 44px;
}

.profile-img-container {
    flex-basis: 0;
    flex-grow: 1;
    display: flex;
    justify-content: center;
    margin-right: 30px;
}

.profile-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    cursor: pointer;
    border: 1px solid #dbdbdb;
}

.profile-info {
    flex-basis: 0;
    flex-grow: 2;
}

.profile-title-row {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-info h1 {
    font-size: 28px;
    font-weight: 300;
    margin: 0;
}

.edit-profile-button {
    margin-left: 20px;
    padding: 5px 24px;
    font-size: 14px;
    font-weight: 600;
    background-color: transparent;
    border: 1px solid #dbdbdb;
    border-radius: 4px;
    color: #262626;
    text-decoration: none;
    transition: background-color 0.2s ease;
}

.edit-profile-button:hover {
    background-color: #efefef;
    color: #262626;
}

.counts {
    display: flex;
    margin-bottom: 20px;
}

.counts span {
    margin-right: 40px;
    font-size: 16px;
}

.counts span strong {
    font-weight: 600;
}

.labels {
    display: flex;
    justify-content: center;
    border-top: 1px solid #dbdbdb;
    margin-top: 50px;
}

.label-btn {
    background: none;
    border: none;
    border-top: 1px solid transparent;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    padding: 20px 0;
    margin-right: 60px;
    display: flex;
    align-items: center;
    color: #8e8e8e;
    text-transform: uppercase;
    margin-top: -1px;
}

.label-btn.active {
    border-top: 1px solid #262626;
    color: #262626;
}

.label-btn img {
    height: 12px;
    width: 12px;
    margin-right: 6px;
}

.post-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    margin-top: 20px;
}

.post-item {
    position: relative;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    cursor: pointer;
}

.post-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.post-item .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: none;
    justify-content: center;
    align-items: center;
    color: white;
    font-weight: 600;
}

.post-item:hover .overlay {
    display: flex;
}

.overlay div {
    margin: 0 10px;
    display: flex;
    align-items: center;
}

.overlay img {
    width: 18px !important;
    height: 18px !important;
    margin-right: 5px;
}

/* Modal styles scoping */
.profile-details-container .modal_hidden {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    width: 400px;
    height: auto;
}
</style>
<?php
session_start();
require("connect.php"); 

$username = $_SESSION['username'];
 $rolemaster_id = $_SESSION['role_master_id'];
 
 
$folowelist=$con->query("SELECT * FROM `user_master` where role_master_id='$rolemaster_id'");
   $getallposters2 = $folowelist->fetch(PDO::FETCH_ASSOC);
   
   $getposter=$con->query("SELECT * FROM `posters` where username_id='$rolemaster_id'");
   
   $getallposters3 = $getposter->fetch(PDO::FETCH_ASSOC);
   
	   
	   $getpostcount=$con->query("SELECT 
    COUNT(CASE WHEN post_type = 'image' THEN 1 END) AS image_count,
    COUNT(CASE WHEN post_type = 'video' THEN 1 END) AS video_count
FROM 
    posters
WHERE 
    username_id = '$rolemaster_id'");
	
	
	$getcountt=$getpostcount->fetch(PDO::FETCH_ASSOC);
	
	$addcounts=$getcountt['image_count']+$getcountt['video_count'];
	
	
	
	//get followers count /////
	
	$getcntfollowing=$con->query("SELECT SUM(user_id) as followingcount FROM `following_details` WHERE role_master_id='$rolemaster_id' and following_sts='1'");
	$getdata=$getcntfollowing->fetch(PDO::FETCH_ASSOC);
	
 ?>
<div class="profile-details-container">
    <div class="profile-header">
        <div class="profile-img-container">
            <?php if($getallposters2['profile_img'] != '') { ?>
                <img src="<?php echo $getallposters2['profile_img'];?>" alt="Profile Picture" class="profile-img" onclick="chnageprofilepic(<?php echo $getallposters2['id']?>);">
            <?php } else { ?>
                <img src="/rythm/assets/profile.png" alt="Profile Picture" class="profile-img" onclick="chnageprofilepic(<?php echo $getallposters2['id']?>);">
            <?php } ?>
        </div>
        <div class="profile-info">
            <div class="profile-title-row">
                <h1><?php echo ucfirst($getallposters2['user_name']);?></h1>
                <a href="editprofile.php" class="edit-profile-button">Edit Profile</a>
            </div>
            <div class="counts">
                <span><strong><?php echo $addcounts; ?></strong> posts</span>
                <span><strong>0</strong> followers</span>
                <span><strong><?php echo intval($getdata['followingcount']);?></strong> following</span>
            </div>
        </div>
    </div>

<br>
<div style="display:flex;justify-content:flex-start;gap:50px;">
   <div class="highlight">
  <div class="highlight-image"><img src="/rythm/assets/postimg1.jpg" alt="Highlight 1" style="height:80px;width:80px;border-radius:50px;"><br><label>Highlights</label></div>

</div>

  <div class="highlight">
  <div class="highlight-image"><img src="/rythm/assets/addstory.png" alt="Highlight 1" style="height:75px;width:75px;"><br><label style="margin:0 26px;">New</label></div>

</div>
</div>
<br>
<br>
<hr style="border-color: deeppink; width:100%;">


    <div class="labels">
        <button class="label-btn active" id="posttid" onclick="showSection('posts')">
            <img src="/rythm/assets/posticon.png"> POSTS
        </button>
        <button class="label-btn" id="reelsid" onclick="showSection('reels')">
            <img src="/rythm/assets/video.png"> REELS
        </button>
        <button class="label-btn" id="svedid" onclick="showSection('saved')">
            <img src="/rythm/assets/bookmark.png"> SAVED
        </button>
    </div>
  
  
  
    <div id="posts" class="post-grid">
        <?php 
        $getposts = $con->query("SELECT * FROM `posters` WHERE post_type='image' AND status='1' AND username_id='$rolemaster_id'");
        $dyn=0;
        while($getallposters = $getposts->fetch(PDO::FETCH_ASSOC)) {
			 $now = time();
        $datediff = $now - strtotime($getallposters['created_on']);
        $numofdays = round($datediff / (60 * 60 * 24));
        $postdate = ($numofdays == 0) ? 'Today' : $numofdays . 'd';
			$dyn++;
            echo '<div class="post-item" onclick="messagepopup('.$getallposters['id'].','. $dyn.')">';
            echo '<img src="' . $getallposters['postimg'] . '" alt="Post Image">';
            
			$posteridd=$getallposters['poster_id'];
			$getcountoflike=$con->query("SELECT sum(likestatus) as likescount FROM `posters` WHERE poster_id='$posteridd'");
			$getcountoflikes = $getcountoflike->fetch(PDO::FETCH_ASSOC);
			
			$getcmscount=$con->query("SELECT count(commands) as cmdcounts FROM `posters_commads` WHERE posterid='$posteridd'");
			$getcountocmd = $getcmscount->fetch(PDO::FETCH_ASSOC);
			
            echo '<div class="overlay">';
			if($getcountoflikes['likescount'] != 0) {
                echo '<div class="likes"><img src="/rythm/assets/heartwhite.png"> '.$getcountoflikes['likescount'].'</div>';
			}
			if($getcountocmd['cmdcounts'] != 0) {
                echo '<div class="comments"><img src="/rythm/assets/messagewhite.png"> '.$getcountocmd['cmdcounts'].'</div>';
			}
            echo '</div>';
            echo '</div>';
			
			?>
			
				
	<input type="hidden" id="postimgvideoid<?php echo $dyn;?>" name="postimgvideoid<?php echo $dyn;?>" value="<?php echo $getallposters['id'];?>">
 
  <input type="hidden" id="posterspath<?php echo $dyn;?>" name="posterspath<?php echo $dyn;?>" value="<?php echo $getallposters['postimg'];?>">
	
	
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
							<span class="username"><span style="font-weight:600;"><?php echo $getallposters['username'];?></span> . <?php echo $postdate?></span>
							</div>
						<label class="locationname" style="margin-left:60px;"><?php echo $getallposters['location'];?></label><br>
						<label class="mesgmoredott" onclick="showPopup2(<?php echo $dyn; ?>)" >. . .</label>
				</div>
                    <hr style="width:72vh;margin-left:50vh;color:lightgray;">
					
					
					<div class="messageddcontent" style="margin-top:-10px;">
								<div class="user-profile1" style="margin-left:49vh;">
								<img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic1">
								
								 <div style="max-width:380px;">
								<label class="username"><font style="font-weight:600;"><?php echo $getallposters['username'];?></font><span style="font-weight:normal;color:blue;">&nbsp;&nbsp;<?php echo $getallposters['posters_caption'];?>  </span></label>
                                 </div>							
								</div><br><br>
							      <label style="color:gray;margin-left:53vh;"><?php echo $postdate;?></label>
								  <br><br>
								  
								  <?php
								  $posteriddddd=$getallposters['id'];
								  
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
								 
								   <div class="icon" onclick="messagereplyfunc(<?php echo $dyn;?>,<?php echo $popdyid;?>,<?php echo $getallposters['username_id'];?>,<?php echo $posteriddddd;?>)">
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
						
                   <label id="postatag<?php echo $dyn;?>" style="color:blue;display:none;float:right;" onclick="commandinsert(<?php echo $dyn;?>, <?php echo $getallposters['id'];?>,  <?php echo $rolemaster_id;?>);">Post</label>
				
				</div>
				
				
				
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
							
<!------------------------------------------messagePopupContentEnd-------------------------------------->

	
	
			
			
			
			
			
			
			
			
			
			
			
			
			
			<?php
			
        }
       
        ?>
    </div>
	 </div>
</div>

<style>
    /* CSS for the hover effect */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        width: 100%;
        height: 100%;
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .post-item { 
        padding:8px;
        position: relative;
        overflow: hidden;
    }

    .post-item:hover .overlay {
        display: flex;
    }
</style>

<script>
 document.querySelectorAll('.item').forEach(item => {
    const overlay = item.querySelector('.overlay');
    const likeCount = overlay.querySelector('.like-count');
    const messageCount = overlay.querySelector('.message-count');
    
    item.addEventListener('mouseenter', () => {
        overlay.style.display = 'flex';
        // Display the likes count
        likeCount.style.display = 'block';
        // Display the message count
        messageCount.style.display = 'block';
    });

    item.addEventListener('mouseleave', () => {
        overlay.style.display = 'none';
        // Hide the likes count
        likeCount.style.display = 'none';
        // Hide the message count
        messageCount.style.display = 'none';
    });
});

</script>


</div>

  <div id="reels" style="display:none;">
    <div class="post-container" style="">
        <?php 
        $getposts = $con->query("SELECT * FROM `posters` WHERE post_type='video' AND status='1'");
        $count2 = 0; // Initialize counter
		$dyn=0;
        while($getallposters = $getposts->fetch(PDO::FETCH_ASSOC)) {
			$dyn++;
			
            if($count2 % 3 == 0) {
                // Start a new row for every three items
                echo '<div class="row" style="display:flex;margin-left:500px;">';
            }
            // Output your video post here
            echo '<div class="post-item" data-post-id="' . $getallposters['poster_id'] . '" onclick="hhh('.$dyn.');">'; // Add data-post-id attribute for each post
            // Display your video content
            echo '<div class="video-container" style="height: 150px; width: 150px; background-color: gray; overflow: hidden;">'; // Container with fixed dimensions
            echo '<video controls style="width: 50%; height: 50%; object-fit: cover;">'; // Video tag with fixed dimensions and object-fit cover
            echo '<source src="' . $getallposters['postvideos'] . '" type="video/mp4">'; // Video source
            echo 'Your browser does not support the video tag.'; // Fallback text
            echo '</video>'; // Close video tag
            echo '</div>'; // Close container
            // Add placeholders for likes and comments count
			
			$posteridd=$getallposters['poster_id'];
			$getcountoflike=$con->query("SELECT sum(likestatus) as likescount FROM `posters` WHERE poster_id='$posteridd'");
			$getcountoflikes = $getcountoflike->fetch(PDO::FETCH_ASSOC);
			//echo $getcountoflikes['likescount']; 
			
			$getcmscount=$con->query("SELECT count(commands) as cmdcounts FROM `posters_commads` WHERE posterid='$posteridd'");
			//echo "SELECT sum(commands) as cmdcounts FROM `posters_commads` WHERE posterid='$posteridd'";
			$getcountocmd = $getcmscount->fetch(PDO::FETCH_ASSOC);
			
			
            echo '<div class="overlay">';
			if($getcountoflikes['likescount']!=0)
			{
            echo '<div class="like-count" style="display: none;"><img src="/rythm/assets/heartwhite.png" style="height:25px;width:25px;">&nbsp;'.$getcountoflikes['likescount'].'</div>';
			}
			if($getcountocmd['cmdcounts']!=0)
			{
            echo '<div class="message-count" style="display: none;"><img src="/rythm/assets/messagewhite.png" style="height:25px;width:25px;">&nbsp;'.$getcountocmd['cmdcounts'].'</div>';
           
			}
			 echo '</div>';
            echo '</div>';
            $count2++;
            if($count2 % 3 == 0) {
                // Close the row after every three items
                echo '</div>';
            }
			?>
			
			
	<input type="hidden" id="postimgvideoid<?php echo $dyn;?>" name="postimgvideoid<?php echo $dyn;?>" value="<?php echo $getallposters['id'];?>">
 
  <input type="hidden" id="posterspath<?php echo $dyn;?>" name="posterspath<?php echo $dyn;?>" value="<?php echo $getallposters['postimg'];?>">
	
	<div class="">		

    <img src="/rythm/assets/whitcloseicon.png" class="close-button" onclick="closePopup()">

<div id="popup-card_<?php echo $dyn; ?>" class="popup-card" style="display: none; position: fixed; background: white;; padding: 20px; z-index: 999;margin-left:403px !important;width:831px !important;margin-top:px !important;">
   
   
   
   </div>
   
   
   
   
   
   
   

</div>

			
			

			<?php
        }
       
        ?>
    </div>


	
  </div>

<style>
    .gallery-item {
        width: 300px;
        height: 300px;
        overflow: hidden; /* Ensure content doesn't overflow */
    }
    .gallery-item img,
    .gallery-item video {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintain aspect ratio */
    }
</style>

<div id="saved" style="display:none;">
    <?php
    $getallsavdpost = $con->query("SELECT * FROM `poster_download` WHERE downloader_id='$rolemaster_id' AND donwload_sts='1'");

    if ($getallsavdpost->rowCount() > 0) {
        echo "<div class='gallery' style='display:flex;margin-left:500px;'>";
        while ($getallsavedpsttt = $getallsavdpost->fetch(PDO::FETCH_ASSOC)) {
            $poster_path = $getallsavedpsttt['poster_path'];
            $extension = pathinfo($poster_path, PATHINFO_EXTENSION);

            // Check if the file is an image or video
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Display image
                echo "<div class='gallery-item'><img src='$poster_path' alt='Image'></div>";
            } elseif (in_array($extension, ['mp4', 'avi', 'mov', 'mkv'])) {
                // Display video
                echo "<div class='gallery-item'><video controls><source src='$poster_path' type='video/mp4'>Your browser does not support the video tag.</video></div>";
            }
        }
        echo "</div>"; // Close the gallery container
    } else {
        echo "No data found";
    }
    ?>
</div>


  
   <?php
   
   ?>
   
</div>
    <script src="script.js"></script>
  
			<br><br>
	<div class="modal_hidden" id="profileUploadModal">
    <h2>Change Your Profile Photo</h2>   
        <label class="modal-label" style="color:blue;margin-left:101px;" onclick="uploadProfileImage();">Upload&nbsp;&nbsp;a&nbsp;&nbsp;Photo</label><br>
        
        <input type="file" id="fileInput" style="display: none;" onchange="fileSelected(event);">
        <br>
        <div style="display:none;margin:0 auto;" id="picuplodedsavebtn">
           
            <button type="button" class="savebtnnn" onclick="saveProfileImage();">Save</button> 
             <span id="selectedFileName"></span> <span class="close-icon" id="" onclick="clearSelectedFile();" style="cursor: pointer;">&#x2716;</span> <!-- Close icon -->
        </div>
        <hr><br>
        <label class="modal-label" style="color: red;margin-left:77px;">Remove&nbsp;&nbsp;Profile&nbsp;&nbsp;Picture</label>
		
		<br>
        <hr><br>
        <label class="modal-label" style="margin-left:140px;" onclick="hidepopcardd();">Cancel</label>
</div>                                                                                                                                                                                                                                     



</body>


 
 
            
           
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
	
	
	document.querySelectorAll('.post-item').forEach(item => {
    const overlay = item.querySelector('.overlay');
    const likeCount = overlay.querySelector('.like-count');
    const messageCount = overlay.querySelector('.message-count');
    
    item.addEventListener('mouseenter', () => {
        overlay.style.display = 'flex';
        // Display the likes count
        likeCount.style.display = 'block';
        // Display the message count
        messageCount.style.display = 'block';
    });

    item.addEventListener('mouseleave', () => {
        overlay.style.display = 'none';
        // Hide the likes count
        likeCount.style.display = 'none';
        // Hide the message count
        messageCount.style.display = 'none';
    });
});

	
	
	
	
	
	
 function showSection(val) {
    if(val=='reels') {
        $("#posts").slideUp();
        $("#saved").slideUp();
        $("#reels").slideDown();  
        $("#svedid").css("background", "none"); 
        $("#reelsid").css("background", "pink"); 
        $("#posttid").css("background", "none");
        // Remove hover effect for other buttons
				// Add hover effect for #svedid and #posttid
		

    } 
    else if(val=='saved') {
        $("#posts").slideUp();
        $("#reels").slideUp();
        $("#saved").slideDown();
        $("#svedid").css("background", "pink"); 
        $("#reelsid").css("background", "none"); 
        $("#posttid").css("background", "none");
        // Remove hover effect for other buttons
        $("#reelsid, #posttid").addClass("hover-effect");
		
		

    } 
    else if(val=='posts') {
        $("#reels").slideUp();
        $("#saved").slideUp();  
        $("#posts").slideDown();
        $("#svedid").css("background", "none"); 
        $("#reelsid").css("background", "none"); 
        $("#posttid").css("background", "pink");
        // Remove hover effect for other buttons
        $("#reelsid, #svedid").addClass("hover-effect");
    }
    
   
}


</script>
<script>
    var selectedFile = null; // Variable to store selected file

    function chnageprofilepic(idd) {
        $("#profileUploadModal").show();
    }

    function uploadProfileImage() {
        // Code to trigger the file upload process
        // For example:
        document.getElementById('fileInput').click();
        $("#picuplodedsavebtn").show(); 
    }

    // Function to hide the pop-up card
    function hidepopcardd() {
        clearSelectedFile(); // Clear selected file when hiding the modal
        document.getElementById('profileUploadModal').style.display = 'none';
    }

    // Function to handle file selection
    function fileSelected(event) {
        selectedFile = event.target.files[0];
        displaySelectedFileName(); // Display selected file name
    }

    // Function to display selected file name
    function displaySelectedFileName() {
        if (selectedFile) {
            document.getElementById('selectedFileName').textContent = selectedFile.name;
        }
    }

    // Function to handle saving the profile image
function saveProfileImage() {
	//debugger;
    if (selectedFile) {
        var formData = new FormData();
        formData.append('profileImage', selectedFile);

        $.ajax({
            url: 'insert_profile_pic.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response
				if(response!='0')
				{
					alert('profile uploaded Successfully...Waiting Admin Approvel!!!');
					window.location.href='/rythm/homee.php';
					//console.warn(response);
				}
				else
				{
					alert('profile not Uploaded !!!');
					window.location.href='/rythm/homee.php';
				}
               // console.log('File uploaded successfully.');
                clearSelectedFile(); // Clear selected file after upload
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error uploading file:', error);
            }
        });
    }
}


    // Function to clear selected file
    function clearSelectedFile() {
        selectedFile = null;
        document.getElementById('selectedFileName').textContent = ""; // Clear displayed file name
        document.getElementById('fileInput').value = ""; // Clear file input value
    }
</script>

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
	debugger;
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

 <script>
      
    function hhh(dyn) {
		debugger;
        var popupCard = document.getElementById("popup-card_"+dyn);
        // Position the pop-up card relative to the clicked video post
        var videoPost = document.getElementsByClassName("post-item")[dyn - 1];
        var rect = videoPost.getBoundingClientRect();
        var offsetTop = rect.top + window.scrollY;
        var offsetLeft = rect.left + window.scrollX;
        popupCard.style.top = offsetTop + "px";
        popupCard.style.left = offsetLeft + "px";
        // Show the pop-up card
        popupCard.style.display = "block";
    }

    function closePopup() {
        document.getElementById("popup-card").style.display = "none";
    }

    </script>