<html>
<?php 
     $folowelist=$con->query("SELECT * FROM `user_master` where role_master_id='$rolemaster_id'");
     $data2 = $folowelist->fetch(PDO::FETCH_ASSOC);
	 

     ?>
     
     <div style="display:flex;justify-content:space-between;gap:120px;">
				<div class="user-profile" style="margin-left:50px; "!important;">
					 
						<img src="/rythm/assets/rsz_logo2.png" style="height:30px;width:30px;border-radius:50%;">&nbsp&nbsp
						<a class="user_name"><?php echo ucfirst($data2['user_name']) ?></a>
						
				</div>
				  <a href="#" class="swtichlabel">Switch</a>
	 </div>
           
        <div style="display:flex;justify-content:space-between;gap:80px;margin-left:60px">
					 
						<label class="Suggested_for_you" style="color:gray;text-decoration:none;font-size:17px;">Suggested&nbspfor&nbspyou</label>
						<a href="#" class="seeall" onclick="seeallfollowers();">See&nbspAll</a>
		</div>  <br><br>
		
		<?php
		$dyidd=0;
		 $folowesuggeslist=$con->query("SELECT * FROM `user_master` ORDER BY id DESC LIMIT 5");
		 if($folowesuggeslist)
		 {
           while($data3 = $folowesuggeslist->fetch(PDO::FETCH_ASSOC))
           {
             $dyidd++;  
		?>
		
		 <div style="display:flex;justify-content:space-evenly;gap:105px;margin-left:70px;">
		      <?php
    if($data3['followsts'] == 0) {
    ?>
    <div class="user-profile">
	<?php
	if($data3['profile_img']!= '') 
	{
	?>
        <img src="<?php echo $data3['profile_img'] ?>" style="height:30px;width:30px;border-radius:50%;">&nbsp;
	<?php
	}
	else
	{
    ?>	
	    <img src="/rythm/assets/defultuserprofile.png" style="height:30px;width:30px;border-radius:50%;">&nbsp;

	<?php
	}
	?>
	   <a class="user_name"><?php echo ucfirst($data3['user_name']) ?><br><span style="font-size:12px;color:gray;">Suggested&nbspfor&nbspyou</span></a>
       
    </div>
   
   
    
      
        <a href="#" class="followlabel" id="sugessfollobtn_<?php echo $dyidd;?>" onclick="followeingload(<?php echo $dyidd;?>,<?php echo $data3['id'];?>);">Follow</a>
       
    <?php
    
	
    ?>

</div>
<br>
		<?php
               }
           
		 }
		 }
		 else
		 {
		     echo "<label style='color:deeppink;font-sixe:18px;'>No Followes Yet!..<label>";
		 }
           ?>
           
           
           
        <div class="footerlabeel" style="">
            <label class="lableoffooter">©&nbspAll&nbsprights&nbspreserved&nbsp@2024</label><br>
             <label class="lableoffooter">
Developed&nbspand&nbspMaintained&nbspby&nbspBluebase&nbspSoftware&nbspServices&nbspPrivate&nbspLimited
</label>
            
            </div>  
<input type='hidden' id="dyiiidesett" value=""/>
<input type='hidden' id="useridsetinto" value=""/>



  <div  class="switchpopup" id="switchpopup">
          <div class="switchpopup-content">  
              
            <img src="/rythm/assets/blkcolorcross.png" style="float:right;height:20px;width:20px;margin-top:10px;margin-right:14px;" onclick="switchclosePopCard()">
               
                <br> <br>  <br>
                    <a href="../../index2.html" style="text-decoration:none;color:black;font-size:20px;font-family:auto;"><b>RythmWoods</b></a>
                <br> <br>
                     
                
                      <form method="POST" action="/rythm/login/validation.php" onsubmit="return validateForm();">
                          <div class="form-group">
                            <label for="exampleInputusername">Username</label>
                			<input class="form-control" name="Inputusername" type="email" aria-describedby="user_name" placeholder="Type Your Username" Autocomplete="off">
                          </div> <br> <br>
                          <div class="form-group">
                                        <label for="examplepassword">Password</label>
                                        <input class="form-control" name="InputPassword" type="password" placeholder="Type Your confirmpassword" autocomplete="off" id="InputPassword">
                                        <span id="password-error" style="color: red;"></span>
                                    </div>  <br>      <br>
                          <input type="submit" class="loginbtnnn" value="Login" /><br>
                		   <br>
                        </form><br> 
                		<div style="margin:0 auto;">
                <a href="/rythm/login/forgotpass.php" style="text-decoration:none;color:blue;">Forgot Password?</a>     
                       </div>
</div>
           
           
    </div> 
	
	
	
	





<div class="seeallpopup" id="seeallpopup">

    <div class="seeallpopup-content">
	
	 <h2 style="font-family:auto;">Suggested&nbspfor&nbspyou</h2>
  <img src="/rythm/assets/blkcolorcross.png" style="float:right;height:20px;width:20px;margin-top:-50px;margin-right:14px;" onclick="seeallPopCard()">
   <br> 
      
	    <br> 
	   
	   <?php
	   $dynamic=0;
		 $folowesuggeslist=$con->query("SELECT * FROM `user_master` ORDER BY id DESC LIMIT 4");
		 if($folowesuggeslist)
		 {
           while($data3 = $folowesuggeslist->fetch(PDO::FETCH_ASSOC))
           {
			   $dynamic++;
               
		?>
		
		 <div style="display:flex;justify-content:space-between;gap:100px;">
		      <?php
    if($data3['followsts'] == 0) {
    ?>
    <div class="user-profile" style="margin-left:70px;">
        <img src="/rythm/assets/rsz_logo2.png" style="height:30px;width:30px;border-radius:50%;">&nbsp;
        <a class="user_name" style="font-size:20px;"><?php echo ucfirst($data3['user_name']) ?><br><span style="font-size:12px;color:gray;">Suggested&nbspfor&nbspyou</span></a>
       
    </div>
   
   
    
      
        <a href="#" class="followbtn"   id="opensuggesfollobtn<?php echo $dynamic;?>" onclick="openfollofunct(<?php echo $dynamic;?>,<?php echo $data3['id'];?>);">Follow</a>
       
    <?php
    }
    ?>

</div>

 

<br>
		<?php
               }
           
		 }
		 else
		 {
		     echo "<label style='color:deeppink;font-sixe:18px;'>No Followes Yet!..<label>";
		 }
           ?>
           
	   
	   
	   
	   
    </div>
</div>


<input type='hidden' id="opensugdyidset" value=""/>
<input type='hidden' id="opensuguseridset" value=""/>



	</html>