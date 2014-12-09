<?php 
    $dbhost = "db.dcs.aber.ac.uk";
    $dbuser = "pjn";
    $dbpass = "********";
    $dbname = "pjn";
    
    // Open connection to the database
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if(!$connection) {
        echo "Could not connect to the database!";
        exit;
    }
        
    // End the database connection
    function disconnect_db() {
        global $connection;
        mysqli_close($connection);
    }
?>