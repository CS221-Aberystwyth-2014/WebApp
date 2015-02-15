<?php 
require_once("connect.php");
require_once("phpcoord-2.3.php");

if(!empty($_POST['reserveName'])) {
    $users_name     = $_POST['Name'];
    $users_email    = $_POST['Email'];
    $users_phone    = $_POST['Phone'];
    $reserveName    = $_POST['reserveName'];
    $date           = $_POST['Date'];
    $speciesName    = $_POST['speciesName'];
    $description    = $_POST['description'];
    $abundance      = $_POST['abundance'];
    $latitude       = $_POST['latitude'];
    $longitude      = $_POST['longitude'];
    $location       = "";

    // Validate Users Name (64 char, alphabetic)
    if(!empty($users_name)) {
        if(strlen($users_name) > 64)
            $errors[] = "USERS_NAME :: Users name must be less than 64 characters in length";
        if(!preg_match("/^[a-zA-Z][a-zA-Z\\s]+$/", $users_name))
            $errors[] = "USERS_NAME :: Users name must only contain alphabetic characters";
    }

    // Validate Users Email (255 char, valid email)
    if(!empty($users_email)) {
        if(strlen($users_email) > 255)
            $errors[] = "USERS_EMAIL :: Users email must be less than 255 characters in length";
        if(!filter_var($users_email, FILTER_VALIDATE_EMAIL))
            $errors[] = "USERS_EMAIL :: Email is an invalid format";
    }

    // Validate Users Phone (22 char, numeric)
    if(!empty($users_phone)) {
        if(strlen($users_phone) > 22)
            $errors[] = "USERS_PHONE :: Phone number is an invalid format";
        if(!preg_match("/^[0-9]*$/", $users_phone))
            $errors[] = "USERS_PHONE :: Phone number is an invalid format";
    }

   // Validate Reserve Name (255 char)
    if(!empty($reserveName)) {
        if(strlen($reserveName) > 255)
            $errors[] = "RESERVE_NAME :: Reserve name must be less than 255 characters in length";
    }

    // Validate Date (YY-MM-DD HH:MM:SS)
    if(!empty($date)) {
        if(!preg_match("/([0-9]{2,4})-([0][0-9]|1[0-2])-([0-2][0-9]|3[0-1]) (?:([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))?/", $date))
            $errors[] = "DATE :: Invalid date format";
    }

    // Validate Species Name (255 char)
    if(!empty($speciesName)) {
        if(strlen($speciesName) > 255)
            $errors[] = "SPECIES_NAME :: Species name must be less than 255 characters in length";
    }

    // Validate Description (100 char)
    if(!empty($description)) {
        if(strlen($description) > 100)
            $errors[] = "ADDITIONAL_INFO :: Description must be less than 100 characters in length";
    }

    // Validate Abundance (1 char)
    if(!empty($abundance)) {
        if(strlen($abundance) > 1)
            $errors[] = "ABUNDANCE :: Invalid abundance";
    }

    // Validate Location
    if(!empty($latitude) && !empty($longitude)) {
        if(preg_match("/^-?[0-9]\d*(\.\d+)?$/", $latitude) && preg_match("/^-?[0-9]\d*(\.\d+)?$/", $longitude)) {
            $latlong = new LatLng($latitude, $longitude);
            $alocation = $latlong->toOSRef();
            $location = $alocation->toSixFigureString();
        } else {
            $errors[] = "LOCATION :: Invalid Location";
        }
    }

    if(empty($users_name) | empty($users_email) | empty($users_phone) | empty($reserveName) | empty($date) | empty($speciesName) | empty($description) | empty($abundance) | empty($latitude) | empty($longitude)) {
        $errors[] = "EMPTY_FIELDS :: Recording is incomplete";
    }


    // Placeholder Images
    $scene_photo = "noimage.png";
    $specimen_photo = "noimage.png";

    // If there are no errors, add recording to the database
    if(empty($errors)) {
        $query = "INSERT INTO recordings (users_name, users_phone, users_email, time, species, reserve, location, abundance, add_info, scene_photo, specimen_photo)
                  VALUES ('{$users_name}','{$users_phone}','{$users_email}','{$date}','{$speciesName}','{$reserveName}','{$location}','{$abundance}','{$description}','{$scene_photo}','{$specimen_photo}')";
        $result = mysqli_query($connection, $query);

        if(!$result) 
            $errors[] = "DATABASE_ERROR: Could not add recording";
    }
}

// Write any errors to a log file
$errorfile = fopen("errorLog.txt", "a");

fwrite($errorfile,"\n" . $_SERVER['UNIQUE_ID'] . "\n====================================================\n");

foreach($_SERVER as $key=>$serverInfo) {
    fwrite($errorfile,$key . ": " . $serverInfo . "\n");
}

foreach($_POST as $key=>$postInfo) {
    fwrite($errorfile,$key . ": " . $postInfo . "\n");
}

fwrite($errorfile, "\nERRORS\n====================================================\n");

if(!empty($errors)) {
    foreach($errors as $error) {
        fwrite($errorfile, $error . "\n");
    }
}

fwrite($errorfile,"====================================================\n\n\n");

fclose($errorfile);
?>

