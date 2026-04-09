<?php
// session_start();
$cat = $_SESSION['title'];
?>

<html>
<div class="logo">
    <img src="/rythm/assets/rythmlogo.png" alt="Logo" class="logo-img" style="width: 80%; padding: 20px;">
</div>
<nav>
    <ul>
        <li onclick="homesidebar();">
            <img src="/rythm/assets/home2.png" alt="home" style="height:4vh;width:4vh; margin-right: 10px;" class="sidebar-icon">
            <span id="homeText">Home</span>
        </li>
        <!-- <li onclick="toggleText('search','home','explore','reels','messanger','heart','add','profile','music_director','language','music','addevent','eventlist','Request_Profile_Verification','Payment_Track');">
                <img src="/rythm/assets/search.png" alt="search" class="sidebar-icon">
                <span id="searchText">Search</span>
            </li> -->
        <!-- <li onclick="explodee();">
                <img src="/rythm/assets/explore.png" alt="explore" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="exploreText">Explore</span>
            </li> -->
        <li onclick="reeelss();">
            <img src="/rythm/assets/reels.png" alt="reels" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
            <span id="reelsText">Reels</span>
        </li>
        <li onclick="messages()">
            <img src="/rythm/assets/messanger.png" alt="messanger" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
            <span id="messangerText">Messages</span>
        </li>
        <!-- <li onclick="notificationtogle( 'home','explore','reels','messanger','heart','add','profile','music_director','language','music','addevent','eventlist','Request_Profile_Verification','Payment_Track');">
            <img src="/rythm/assets/notificationheart.png" alt="heart" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
            <span id="heartText">Notifications</span>
        </li> -->
        <li onclick="createpost();">
            <img src="/rythm/assets/add.png" alt="add" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
            <span id="addText">Create</span>
        </li>
        <li onclick="showprofile();">
            <img src="/rythm/assets/profile.png" alt="profile" style="height:6vh;width:6vh; margin-right:10px;" class="sidebar-icon">
            <span id="profileText">Profile</span>
        </li>

        <?php if ($cat == 'singer') { ?>
            <!-- <li onclick="showprofile()">
                                  <img src="/rythm/assets/profile.png" alt="home" style="height:5vh;width:5vh; margin-right:10px;" class="sidebar-icon">Profile
                              </li> -->
            <li onclick="showdirectors()">
                <img src="/rythm/assets/music director.png" alt="music_director" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="music_directorText">Music Director</span>
            </li>
            <li onclick="showlanguage()">
                <img src="/rythm/assets/language.png" alt="language" style="height:5vh;width:5vh; margin-right:10px;" class="sidebar-icon">
            <li onclick="showdirectors(this)">
                <img src="/rythm/assets/music director.png" alt="music_director" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="music_directorText">Music Director</span>
            </li>
            <li onclick="showlanguage(this)">
                <img src="/rythm/assets/language.png" alt="language" style="height:5vh;width:5vh; margin-right:10px;" class="sidebar-icon">
                <span id="languageText">Language</span>
            </li>
            <li onclick="showmusic(this)">
                <img src="/rythm/assets/music.png" alt="music" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="musicText">Music</span>
            </li>
            <li onclick="showevent(this)">
                <img src="/rythm/assets/event.png" alt="addevent" style="height:4vh;width:4vh; margin-right: 10px;" class="sidebar-icon">
                <span id="addeventText">Add Event</span>
            </li>
            <li onclick="showeventlist(this)">
                <img src="/rythm/assets/eventlist.png" alt="eventlist" style="height:4vh;width:4vh; margin-right: 10px;" class="sidebar-icon">
                <span id="eventlistText">Event List </span>
            </li>
            <li onclick="showprof()">
                <img src="/rythm/assets/music.png" alt="Request_Profile_Verification" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="Request_Profile_VerificationText">Request Profile Verification</span>
            </li>

            <!-- <li onclick="showdirectors()">
                                  <img src="/rythm/assets/payment.png" alt="Payment_Track" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
								  <span id="Payment_TrackText">Payment Track </span>
                              </li> -->
        <?php }
        if ($cat == 'amateur singer') { ?>

            <!-- <li onclick="showprofile()">
                                  <img src="/rythm/assets/profile.png" alt="home" style="height:5vh;width:5vh; margin-right:10px;" class="sidebar-icon">Profile
                              </li> -->
            <li onclick="showdirectors()">
                <img src="/rythm/assets/music director.png" alt="music_director" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="music_directorText">Music Director</span>
            </li>
            <li onclick="showlanguage()">
                <img src="/rythm/assets/language.png" alt="language" style="height:5vh;width:5vh; margin-right:10px;" class="sidebar-icon">
                <span id="languageText">Language</span>
            </li>
            <li onclick="showmusic()">
                <img src="/rythm/assets/music.png" alt="music" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
                <span id="musicText">Music</span>
            </li>

            <!-- <li onclick="showdirectors()">
                                  <img src="/rythm/assets/payment.png" alt="Payment_Track" style="height:4vh;width:4vh; margin-right:10px;" class="sidebar-icon">
								  <span id="Payment_TrackText">Payment Track </span>
                              </li> -->

        <?php } ?>

    </ul>
</nav>

</html>