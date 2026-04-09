<?php
/**
 * Rythm Project - Ultimate Cleanup Script
 * Run this ONCE to purge all redundant legacy files.
 */

$files_to_remove = [
    'homee.php',
    'profiledetails.php',
    'messagecontent.php',
    'rythmsidebar.php',
    'sidebar.php',
    'center_content_two.php',
    'chat.php',
    'examplecodeofhome.php',
    'exploder.php',
    'horizontallscrollbar.php',
    'migrate_assets.php',
    'rythmrightsidecontent.php',
    'account_details.php',
    'caldenshowww.php',
    'deleteold.php',
    'footer.php',
    'mystyle.css',
    'style.css', // Root style.css - using assets/css/style.css
    'sample.html',
    'user.php',
    'datetimechange.php',
    'admin_verifications.php',
    'addsonginsert.php',
    'addsongsconcept.php',
    'commandsinsert.php',
    'conceptamypay.php',
    'fetch_post.php',
    'fetche_following_name.php',
    'followingsts.php',
    'get_users.php',
    'getameinsreach.php',
    'getcommdername.php',
    'getfollowsts.php',
    'getmessage.php',
    'handle_request.php',
    'handle_requests.php',
    'insert_profile_pic.php',
    'load_message.php',
    'messagesendandpost.php',
    'paymentinsert.php',
    'posponedupade.php',
    'posponetevents.php',
    'save_posters.php',
    'save_video.php',
    'scheduleedit.php',
    'scheduleinsert.php',
    'unfollowdet.php',
    'update_profile.php',
    'updatelikests.php',
    'updatelikestsforcmnders.php',
    'updateposters_saved.php',
    'updateprofile.php',
	'adminlogin',
	'jquery',
	'bootstrap',
	'dompdf',
	'lyrics',
	'mobility',
	'neha_android',
	'plugins',
	'portfolio',
	'professional_singer'
];

$dirs_to_remove = [
    'pages',
    '_legacy_backup',
    '_legacy_v3_backup',
    '_FINAL_CLEANUP_BACKUP'
];

echo "<h2>Rythm Project Cleanup Start...</h2>";

foreach ($files_to_remove as $file) {
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "<p style='color:green;'>DELETED: $file</p>";
        } else {
            echo "<p style='color:red;'>FAILED: $file</p>";
        }
    } else {
        echo "<p style='color:gray;'>NOT FOUND: $file (Skipped)</p>";
    }
}

foreach ($dirs_to_remove as $dir) {
    if (file_exists($dir) && is_dir($dir)) {
        // Simple recursive directory removal
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $item) {
            if ($item->isDir()){
                rmdir($item->getRealPath());
            } else {
                unlink($item->getRealPath());
            }
        }
        if (rmdir($dir)) {
            echo "<p style='color:green;'>DELETED DIR: $dir</p>";
        } else {
            echo "<p style='color:red;'>FAILED DIR: $dir</p>";
        }
    }
}

echo "<h3>Cleanup Complete!</h3>";
?>
