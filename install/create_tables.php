<!-- This php file creates the database tables if they don't exist -->

<?php
    require_once("../include/php/connect.php");

    $sql = "SHOW TABLES FROM pjn";
    $result = mysqli_query($connection, $sql);
    
    if(isset($_POST['submit'])) {
        if(!mysqli_query($connection, "DESCRIBE reserves")) {
        
            // Create Reserves Table
            $createReservesTable =     "CREATE TABLE reserves ( 
                                        rsv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,     
                                        rsv_name VARCHAR(64), 
                                        rsv_loc VARCHAR(64), 
                                        rsv_desc TEXT)";
            $result = mysqli_query($connection, $createReservesTable); 
 
            if(!$result) { echo "Error creating reserves table"; }

        } else {
            echo "Reserves table already exists!<br />";
        }
        
        if(!mysqli_query($connection, "DESCRIBE recordings")) {
        
            // Create Recordings Table
            $createRecordingsTable =   "CREATE TABLE recordings ( 
                                        rec_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                                        rec_sess_id INT, 
                                        users_name VARCHAR(64), 
                                        users_phone VARCHAR(22), 
                                        users_email VARCHAR(255), 
                                        time DATETIME, 
                                        species VARCHAR(255),
                                        reserve VARCHAR(255), 
                                        location VARCHAR(255), 
                                        abundance CHAR(1), 
                                        add_info TEXT, 
                                        scene_photo VARCHAR(255), 
                                        specimen_photo VARCHAR(255))";

            $result2 = mysqli_query($connection, $createRecordingsTable);
            if(!$result2) { echo "Error creating recordings table"; }

        } else {
            echo "Recordings table already exists!<br />";
        }

        if(!mysqli_query($connection, "DESCRIBE species")) {
        
            // Create Species Table
            $createSpeciesTable =      "CREATE TABLE species ( 
                                        species_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                                        species_name VARCHAR(255),
                                        authority VARCHAR(255),
                                        common_name VARCHAR(255))";

            $result2 = mysqli_query($connection, $createSpeciesTable);
            if(!$result2) { echo "Error creating species table"; }

        } else {
            echo "Species table already exists!<br />";
        }
    }
?>
<br />
<form id="createTables" method="POST" action="create_tables.php">
    <input type="submit" id="submit" name="submit" value="Create Tables"/>
</form>
