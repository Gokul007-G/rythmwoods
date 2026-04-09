<?php
/**
 * Rythm Unified Sidebar - Professional Pink System
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cat = $_SESSION['title'] ?? 'guest';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="logo text-center p-3 mb-3 border-bottom border-secondary">
        <img src="/rythm/assets/rythmlogo.png" alt="Logo" class="img-fluid w-75">
    </div>
    <nav class="sidebar-nav">
        <ul class="list-unstyled p-0 m-0">
            <li class="sidebar-item <?php echo ($current_page == 'home.php' || $current_page == 'homee.php' || $current_page == 'index.php') ? 'active' : ''; ?>" 
                onclick="location.href='/rythm/home.php'">
                <img src="/rythm/assets/home2.png" alt="Home" class="sidebar-icon">
                <span>Home</span>
            </li>
            <li class="sidebar-item <?php echo ($current_page == 'reels.php') ? 'active' : ''; ?>" onclick="location.href='/rythm/reels.php'">
                <img src="/rythm/assets/reels.png" alt="Reels" class="sidebar-icon">
                <span>Reels</span>
            </li>
            <li class="sidebar-item <?php echo ($current_page == 'message.php') ? 'active' : ''; ?>" onclick="location.href='/rythm/message.php'">
                <img src="/rythm/assets/messanger.png" alt="Messages" class="sidebar-icon">
                <span>Messages</span>
            </li>
            <li class="sidebar-item" onclick="location.href='/rythm/postercreation.php'">
                <img src="/rythm/assets/add.png" alt="Create" class="sidebar-icon">
                <span>Create</span>
            </li>
            <li class="sidebar-item <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>" onclick="location.href='/rythm/profile.php'">
                <img src="/rythm/assets/profile.png" alt="Profile" class="sidebar-icon rounded-circle" style="width: 24px; height: 24px;">
                <span>Profile</span>
            </li>

            <hr class="mx-3 opacity-25">

            <?php if ($cat == 'singer' || $cat == 'amateur singer' || $cat == 'musician' || $cat == 'bands') { ?>
                <hr class="mx-3 opacity-25">
                <li class="sidebar-item" onclick="showdirectors()">
                    <img src="/rythm/assets/music director.png" alt="Music Director" class="sidebar-icon">
                    <span>Music Director</span>
                </li>
                <li class="sidebar-item" onclick="showlanguage()">
                    <img src="/rythm/assets/language.png" alt="Language" class="sidebar-icon">
                    <span>Language</span>
                </li>
                <li class="sidebar-item" onclick="showmusic()">
                    <img src="/rythm/assets/music.png" alt="Music" class="sidebar-icon">
                    <span>Music</span>
                </li>
                
                
                <li class="sidebar-item" onclick="showevent(this)">
                    <img src="/rythm/assets/event.png" alt="Events" class="sidebar-icon">
                    <span>Events</span>
                </li>
                
                <li class="sidebar-item" onclick="showeventlist(this)">
                    <img src="/rythm/assets/eventlist.png" alt="Event List" class="sidebar-icon">
                    <span>Event List</span>
                </li>
                
            <?php } ?>
        </ul>
    </nav>
</aside>
