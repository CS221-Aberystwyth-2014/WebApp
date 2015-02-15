<?php 

$title = "Add Reserve";
$bodyid = "reserves";
require_once("../include/header.php");

// If the user isnt logged in, redirect
if(!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit;
}

// If the form has been submitted
if(isset($_POST['submit'])) {
    $rsv_name = htmlentities(strip_tags($_POST['reserveName']));
    $rsv_loc = htmlentities(strip_tags($_POST['location']));
    $rsv_desc = htmlentities(strip_tags($_POST['description']));

    // Validate reserve name
    if(!empty($rsv_name)) {
	    if(strlen($rsv_name) > 64) {
	        $errors[] = "Reserve name is too long (64 char max)";		
	    }
    } else {
        $errors[] = "Please enter a reserve name";
    }
    
    // Validate reserve location
    if(!empty($rsv_loc)) {
	    $rsv_loc = $string = str_replace(' ', '', $rsv_loc);
	    if(!preg_match("/^((([sS]|[nN])[a-hA-Hj-zJ-Z])|(([tT]|[oO])[abfglmqrvwABFGLMQRVW])|([hH][l-zL-Z])|([jJ][lmqrvwLMQRVW]))([0-9]{2})?([0-9]{2})?([0-9]{2})?([0-9]{2})?([0-9]{2})?$/", $rsv_loc)) {
	        $errors[] = "Please enter a valid OS Grid Reference location";
	    }
    } else {
        $errors[] = "Please enter a reserve location";
    }

    // Validate reserve description
    if(!empty($rsv_desc)) {
	    if(strlen($rsv_desc) > 100) {
	        $errors[] = "Reserve description is too long (100 char max)";
	    }
    } else {
	    $errors[] = "Please enter a reserve description";
    }

    // If there are no errors, update the reserve information
    if(empty($errors)) {
	    $query = "INSERT INTO reserves (rsv_name,rsv_loc,rsv_desc) VALUES ('$rsv_name', '$rsv_loc', '$rsv_desc')";
	    $result = mysqli_query($connection, $query);

	    header("Location: index.php");
	    exit;
    }
}

?>

    <section>
        <div class="section_header">
            <div class="section_header_text">
                Add New Reserve
            </div>
        </div>
        <div class="section_body">
            <div class="section_body_text">
		        <?php if(!empty($errors)) { ?>
		        <div class="message">
		            <center>
		            <?php 
                        foreach($errors as $error) {
		                    echo $error . "<br />";
			            }
		            ?>
		            </center>
		        </div>
		        <br />
		        <?php } ?>     
                <center>
                    <form method="POST" action="add.php">
                        <label class="aboveLabel" for="reserveName">Reserve Name</label>
                        <input type="text" id="reserveName" name="reserveName" value="<?php echo $_POST['reserveName']; ?>" />
                        <label class="aboveLabel" for="location">Location</label>
                        <input type="text" id="location" name="location" value="<?php echo $_POST['location']; ?>" />
                        <label class="aboveLabel" for="description">Description</label>
                        <textarea id="description" name="description"><?php echo $_POST['description']; ?></textarea>
                        <br />
                        <br />
                        <input type="submit" class="largeButtonCentered" name="submit" value="Add Reserve">
                    </form>
                </center>

            </div>
        </div>
    </section>

<?php require_once("../include/footer.php"); ?>
