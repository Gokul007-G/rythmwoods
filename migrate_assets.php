<?php
/**
 * Rythm Asset Migration Utility
 * Run this script ONCE through the browser to move assets to the new structure.
 */

$sourceDir = __DIR__;
$targetDir = __DIR__ . '/assets/images';

// Ensure target directory exists
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$filesToMove = [
    'rythmlogo.png', 'home2.png', 'search.png', 'explore.png', 'reels.png', 
    'messanger.png', 'notificationheart.png', 'add.png', 'profile.png',
    'music director.png', 'language.png', 'music.png', 'event.png', 
    'eventlist.png', 'rsz_logo2.png', 'lion.png', 'penguin.png', 
    'blkcolorcross.png', 'whitesearch.png', 'whitcloseicon.png',
    'likeheart.png', 'likeredhreat.png', 'speech-bubble.png', 'send.png',
    'bookmark.png', 'savedpost.png', 'circle.png', 'check.png', 'loadinggif.gif'
];

echo "<h2>Migrating Assets...</h2>";

foreach ($filesToMove as $file) {
    if (file_exists("$sourceDir/$file")) {
        if (rename("$sourceDir/$file", "$targetDir/$file")) {
            echo "Success: Moved $file to /assets/images/<br>";
        } else {
            echo "Error: Could not move $file<br>";
        }
    } else {
        echo "Skip: $file not found in root<br>";
    }
}

echo "<h3>Migration Complete!</h3>";
?>
