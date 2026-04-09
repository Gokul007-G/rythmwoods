<div style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 24px;">Notifications</h2>
        <img src="/rythm/assets/images/blkcolorcross.png" onclick="thirdclssidebr()" 
             style="height: 24px; width: 24px; cursor: pointer;" class="zoomicons">
    </div>
    
    <div style="position: relative; margin-bottom: 20px;">
        <input type="text" id="notisearch" placeholder="Search notifications..." 
               style="width: 100%; padding: 10px 15px; border: 1px solid var(--border-color); border-radius: 8px; outline: none;">
    </div>

    <div class="notifications-list" id="nofiticationallaredisplay">
        <label style="font-weight: 600; margin-bottom: 10px; display: block;">New</label>
        <hr style="margin-bottom: 15px;">
        
        <?php
        $getsql = $con->query("SELECT * FROM `posters` where username_id='$rolemaster_id' and likestatus!=0");
        while ($notifi = $getsql->fetch(PDO::FETCH_ASSOC)) {
            $getuseridd = $notifi['liker_id'];
            $posttype = $notifi['post_type'];
            
            $getwholikes = $con->query("SELECT * FROM `user_master` WHERE users_id='$getuseridd'");
            $whokiesss = $getwholikes->fetch(PDO::FETCH_ASSOC);
            
            if ($whokiesss) {
                $now = time();
                $datediff = $now - strtotime($notifi['likesdate']);
                $numofdays = round($datediff / (60 * 60 * 24));
                $likesdateee = ($numofdays == 0) ? 'Today' : $numofdays . 'd';
                ?>
                <div class="notification-item" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <img src="/rythm/assets/images/lion.png" alt="Profile" style="width: 45px; height: 45px; border-radius: 50%;">
                    <div style="flex: 1;">
                        <span style="font-weight: 600;"><?php echo ucfirst($whokiesss['user_name']); ?></span>
                        <span style="color: var(--text-muted); font-size: 14px;"> liked your <?php echo $posttype; ?>.</span>
                        <div style="font-size: 12px; color: var(--text-muted);"><?php echo $likesdateee; ?></div>
                    </div>
                    <?php if ($posttype == 'video'): ?>
                        <video style="width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">
                            <source src="<?php echo $notifi['postvideos']; ?>" type="video/mp4">
                        </video>
                    <?php else: ?>
                        <img src="<?php echo $notifi['postimg']; ?>" style="width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">
                    <?php endif; ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
