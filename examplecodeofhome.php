<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="/rythm/mystyle.css">
	<link href="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.css" rel="stylesheet" />

    <title>Rythm woods</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="/rythm/assets/rythmlogo.png" alt="Logo" class="logo-img">
            </div>
            <nav>
                <ul>
                    <li>
                    <img src="/rythm/assets/home2.png" alt="home" style="height:4vh;width:4vh; margin-right: 10px;" class="sidebar-icon">
                    Home
                </li>
                <li>  <img src="/rythm/assets/search.png" alt="search" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
				Search</li>
                <li><img src="/rythm/assets/explore.png" alt="explore" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">Explore</li>
                <li><img src="/rythm/assets/reels.png" alt="reels" style="height:4vh;width:4vh; margin-right:10px;"class="sidebar-icon">Reels</li>
                <li><img src="/rythm/assets/messanger.png" alt="messanger" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">Messages</li>
                <li><img src="/rythm/assets/notificationheart.png" alt="heart" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">Notifications</li>
                <li><img src="/rythm/assets/add.png" alt="add" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">Create</li>
				<li>
				<img src="/rythm/assets/profile.png" alt="profile" style="height:5vh;width:5vh; margin-right:10px;" class="sidebar-icon">profile</li>
                </ul>
            </nav>
        </div>
		
	<!------------------------------ center content start portions ------------------------------------------->
<?php 
include("connect.php");


$sql=$con->query("SELECT * FROM `posters`");
while($data = $sql->fetch(PDO::FETCH_ASSOC))
{
 if($data)
  {
	echo $postimg=$data['postimg'];
	$postvideos=$data['postvideos'];
	 //$likestscount=count($data['likestatus']);
	 		  
?>
<input type="hidden" id="postimgid" name="postimgid" value="<?php echo $data['id'];?>" >
        <div class="content">
		
            <div class="user-profile">
                <img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic">
                <span class="username"><span style="font-weight:600;">Rythm Woods</span> . 6d</span>
				</div>
			<label class="locationname">Chennai</label><br>
			<label class="moredott" onclick="showPopup()">. . .</label>
			 <div style="display:flex;justify-content:space-between;gap:150px;">
            <div class="post">
                <img src="<?php echo $postimg; ?>" alt="Post Image" class="post-image"><br><br>
		        <div style="display:flex;gap:33vh;">
			  <div class="icons" style="display:flex;justify-content:flex-start;gap:30px">
				<div class="icon" onclick="toggleLike()">
				<?php
				 if($data['likestatus']==0)
				 {
				?>
					<img  id="likeIcon" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns">
				<?php
				 }
				 else
				 {
				?>
					<img  id="likeIcon" src="/rythm/assets/likeredhreat.png" alt="Heart Icon" class="zoomiconns">

				<?php
				 }
				 ?>
				</div>
				<div class="icon" onclick="messagepopup(<?php echo $data['id'];?>)">
					<img src="/rythm/assets/speech-bubble.png" alt="Message Icon" style="height:25px;width:25px;" class="zoomiconns">
				</div>
				
				<div class="icon" onclick="sharePost()">
					<img src="/rythm/assets/send.png" alt="Send Icon" style="height:25px;width:25px;" class="zoomiconns">
				</div>
				
			</div>
			
		    <div class="icon">
					<img id="savebtnicon" src="/rythm/assets/bookmark.png" alt="Save Icon" style="height:25px;width:25px;" class="zoomiconns">
					<div class="save-label">Save</div>
			 </div>


		 </div><br>
		   <label id="likelbelidd" style="font-weight:600;font-size:18px;"></label><br><br>
		   
            <label style="font-weight:600;">Rythm Woods</label>
                <div class="post-details">
                    <p class="post-caption">This is a sample caption for the post. #Rythmwoods #webpage</p>
					
					<div class="comment-section">
					<textarea type="text" name="bio" class="form-control emoji_act" id="bio" placeholder="Add a Command" onkeyup="count_char(this, 140)"></textarea>
                    <span id="bio_val"></span>

				</div>
					
					
                </div>
				<hr>
				
            </div>
            <div class="suggested-users">
			 <div style="display:flex;justify-content:space-between">
                <label style="color:deeppink;font-weight:600;font-size:18px;">Suggested for you</label>
				<label><a href="#" style="color:deeppink;font-weight:600;text-decoration:none;font-size:18px;">See All</a></label>
				 </div><br>
                <div class="user">
                    <img src="/rythm/assets/lion.png" alt="Quadsel Profile" class="profile-pic">
					
                    <span class="followername">quadsel </span>
					
                </div>
				<div style="display: flex; justify-content: space-between; align-items: center;">
                  <label class="whothis">Follows you</label>
                   <button class="follow-button">Follow</button>
                 </div>

                <div class="user">
                    <img src="/rythm/assets/penguin.png" alt="Vaishnavi SS10 Profile" class="profile-pic">
					 <span class="followername">diehard_fan_of_vaishnavi_ss10</span><br><br>
				    
				</div>
				<div style="display: flex; justify-content: space-between; align-items: center;">
                   <label class="whothis">Suggested for you</label>
				  <button class="follow-button">Follow</button>
 
				 </div>
            </div>
			 </div>
        </div>
		
		
		
		
		
		
		<div class="messagepopup" id="messagepopup">
        <img src="/rythm/assets/whitcloseicon.png" class="close-button" onclick="messageclosePopup()">

				<div class="messagepopup-content">
				
				<div class="messagepopup-img" style="">
				
				</div>
				
				<div style="margin-left:40vh; margin-top:-650px;">
					<div class="user-profile">
					<img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic">
					<span class="username"><span style="font-weight:600;"><?php echo $data['username'];?></span> . 6d</span>
					</div>
				<label class="locationname">Chennai</label><br>
				<label class="mesgmoredott" onclick="showPopup()">. . .</label>
				</div>
                    <hr style="width:70vh;margin-left:56vh;color:lightgray;">
					
					
					
			            <div class="messageddcontent" style="margin-left:40vh; margin-top:10px;">
								<div class="user-profile1">
								<img src="/rythm/assets/rsz_logo2.png" alt="User Profile" class="profile-pic1">
								<label class="username"><font style="font-weight:600;"><?php echo $data['username'];?></font><span style="font-weight:normal;color:blue;">  #rythmwoods#Instagram post likes with this hashtag generator. Inflact gives you top #hashtags for #Instagram based off of one #keyword, #photo, or #link.</span></label>
                                  								
								</div><br><br>
							      <label style="color:gray;margin-left:180px;">6d</label>
								  <br><br>
								  
								  <div style="margin-left:18vh;">
									<div class="user">
								<img src="/rythm/assets/penguin.png" alt="Vaishnavi SS10 Profile" class="profile-pic">
								 <span class="followername">diehard_fan_of_vaishnavi_ss10</span>
								 
								   </div>
								   <div style="display:flex;justify-content:space-flex-start;">
								   <label style="color:gray;margin-left:48px;">1d</label>
								   <label style="color:gray;margin-left:48px;">12likes</label>
								   <label style="color:gray;margin-left:48px;">Reply</label>
						           
								   </div>
								    <img  id="likeIcon" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns" style="height:17px;width:17px;display:flex;margin:-25px 430px">
	 
								   <br><br><br>
									<div class="user">
											<img src="/rythm/assets/lion.png" alt="Quadsel Profile" class="profile-pic">
											
											<span class="followername">quadsel </span>
											
									 </div>
									 
									  <div style="display:flex;justify-content:space-flex-start;">
								   <label style="color:gray;margin-left:48px;">18d</label>
								   <label style="color:gray;margin-left:48px;">127likes</label>
								   <label style="color:gray;margin-left:48px;">Reply</label>
								   	
								   </div>
								   <img  id="likeIcon" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns" style="height:17px;width:17px;display:flex;margin:-25px 430px">
	 
								 </div>
								 
							   </div><br><br>
							   <hr style="width:70vh;margin-left:56vh;color:lightgray;">
				<br>
				           <div style="display:flex;justify-content:space-between;gap:150px;">
                  <div class="post">
					 <div style="display:flex;gap:33vh;margin-left:40vh;">
						  <div class="icons" style="display:flex;justify-content:flex-start;gap:30px">
							<div class="icon" onclick="toggleLike2222()">
							<?php
							 if($data['likestatus']==0)
							 {
							?>
								<img  id="likeIcon" src="/rythm/assets/likeheart.png" alt="Heart Icon" class="zoomiconns">
							<?php
							 }
							 else
							 {
							?>
								<img  id="likeIcon" src="/rythm/assets/likeredhreat.png" alt="Heart Icon" class="zoomiconns">

							<?php
							 }
							 ?>
							</div>
							<div class="icon" onclick="messagepopup(<?php echo $data['id'];?>)">
								<img src="/rythm/assets/speech-bubble.png" alt="Message Icon" style="height:25px;width:25px;" class="zoomiconns">
							</div>
							
							<div class="icon" onclick="sharePost()">
								<img src="/rythm/assets/send.png" alt="Send Icon" style="height:25px;width:25px;" class="zoomiconns">
							</div>
							
						</div>
						
								<div class="icon">
										<img id="savebtnicon" src="/rythm/assets/bookmark.png" alt="Save Icon" style="height:25px;width:25px;margin-left:10vh;" class="zoomiconns">
								</div>
                     </div>
					 
					 <br>
		   <label id="likelbelidd" style="font-weight:600;font-size:18px;margin-left:40vh;">3 likes</label><br><br>
		   <label style="color:gray;margin-left:40vh;">18d</label>
				
				<br><br>
				
					<div class="comment-section22" style="margin-left:260px;width:500px;">
						<textarea type="text" name="bio22" class="form-control emoji_act" id="bio22" placeholder="Add a Command" onkeyup="count_char(this, 140)" ></textarea>
						<span id="bio_val22"></span>
					</div>
				
				</div>					
					</div>
							
			
				   </div>



		<?php
  
  
  //elseif($postvideos !='') 
  //{
	?>
	  <video  width="100%">
            <source src="movie.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
		
<?php
    //}

  
  
}

  else
  {
	echo "<label style='text-align:center;color:red;font-size:30px;font-weight:600;'>Data Not Found!..</label>";  
  }
  
  
  
}
		?>
		<!------------------------------ center content end portions ------------------------------------------->
    </div>
	<div class="threedotpopup" id="threedotpopup">

    <div class="threedotpopup-content"><br><br>

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
	   <label onclick="closePopup()">Cancel</label>
    </div>
</div>




</body>
</html>

<!-- Add this inside the <body> tag, after the popup structure -->
<script>
    function showPopup() {
        var popup = document.getElementById('threedotpopup');
        popup.style.display = 'flex';
    }

    function closePopup() {
        var popup = document.getElementById('threedotpopup');
        popup.style.display = 'none';
    }
	 
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- ... (your existing HTML code) ... -->

<script>
    let isLiked = false;

    function toggleLike() {
        isLiked = !isLiked;
        var likeIcon = document.getElementById('likeIcon');
        var postImgId = document.getElementById('postimgid').value; 

        if (isLiked) {
            likeIcon.src = "/rythm/assets/likeredhreat.png";
            likeIcon.style.filter = "brightness(1.2)";
            updateLikeStatus(postImgId, 1); // 1 indicates liked
        } else {
            likeIcon.src = "/rythm/assets/likeheart.png";
            likeIcon.style.filter = "brightness(1)";
            updateLikeStatus(postImgId, 0); // 0 indicates unliked
        }
    }

    function updateLikeStatus(postId, likeStatus) {
		//debugger;
        $.ajax({
            type: 'POST',
            url: 'updatelikests.php', 
            data: {
                post_id: postId,
                like_status: likeStatus
            },
            success: function (response) {
				
                   document.getElementById('likelbelidd').innerText = response;			  
                
            },
            error: function (error) {
                
               // console.error(error);
            }
        });
    }
</script>
	
	
<script>
 function messagepopup(postId) {
    var popup = document.getElementById('messagepopup');
    popup.style.display = 'flex';

   $.ajax({
        type: 'POST',
        url: 'messagecontent.php',
        data: {
            post_id: postId
        },
        success: function (response) {
            var messagePopupContent = document.querySelector('.messagepopup-img');

            messagePopupContent.innerHTML = '';

            var imgElement = document.createElement('img');

            imgElement.src = response;

            imgElement.style.width = '40%'; 
            imgElement.style.height = '680px'; 
            
            
            messagePopupContent.appendChild(imgElement);
        },
        error: function (error) {
            console.error(error);
        }
    });
}


function messageclosePopup() {
    var popup = document.getElementById('messagepopup');
    popup.style.display = 'none';
}

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

<style>



 .emoji_act {
      box-shadow: none;
      outline: none;
      border: none;
      padding: 10px; /* Optional: add padding to make it look better */
    }
    
    .emojionearea, .emojionearea.form-control {
    display: block;
    position: relative !important;
    width: 100%;
    height: auto;
    padding: 0;
    font-size: 14px;
    border: 0;
    background-color: #FFFFFF;
    /* border: 1px solid #CCCCCC; */
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-transition: border-color 0.15s ease-in-out, -moz-box-shadow 0.15s ease-in-out;
    -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.emojionearea .emojionearea-editor {
    display: block;
    height: auto;
    min-height: 0em !important; 
    max-height: 15em;
    overflow: auto;
    padding: 6px 24px 6px 12px;
    line-height: 1.42857143;
    font-size: inherit;
    color: #555555;
    background-color: transparent;
    border: 0;
    cursor: text;
    margin-right: 1px;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

	.emojionearea .emojionearea-button.active + .emojionearea-picker-position-bottom {
    margin-top: -50vh;
	margin-right:-70vh;
}
</style>
