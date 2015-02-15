<?php  
    // Set the save path for sessions 
    session_save_path("/aber/pjn/web/tmp");

    session_start();

    if(!isset($_SESSION['uid'])) {
        // Make session last for 7 days
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
        session_regenerate_id();
    }
?>
