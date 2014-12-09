<!-- EDIT RESERVES PAGE [reserves/edit.php]
   - Displays a list of form fields which have been pre-populated by data of the reserve that the user has selected to update
        > FIELDS REQUIRED <
            > Reserve Name (text field)
            > Location (text field)
            > Description (text area)
            > Update Button (submit)
   - The data in the form fields will need to be validated both client side and server side (Javascript & PHP)
     before being sent to the database
-->

<?php 
require_once("../include/header.php");

if(isset($_GET['id'])) {
    $id = htmlentities(strip_tags($_GET['id']));
}

?>

    <section>
        <div class="section_header">
            <div class="section_header_text">
                Editing Reserve <?php echo $id; ?>
            </div>
        </div>
        <div class="section_body">
            <div class="section_body_text">
                <?php 
                $query = "SELECT * FROM reserves WHERE rsv_id = $id";
                $result = mysqli_query($connection, $query);
                
                if($result) {
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
            
                <center>
                    <form method="POST" action="edit.php">
                        Reserve Name
                        <p>
                        <input type="text" id="reserveName" name="reserveName" value="<?php echo $row['rsv_name']; ?>">
                        </p>
                        <br>
                        Location
                        <p>
                        <input type="text" id="location" name="location" value="<?php echo $row['rsv_loc']; ?>">
                        </p>
                        <br>
                        Description
                        <p>
                        <input type="textarea" id="description" name="description" value="<?php echo $row['rsv_desc']; ?>">
                        </p>
                        <br>
                        <input type="submit" id="submit" name="submit" value="Update">
                    </form>
                </center>
            </div>
        </div>
    </section>

<?php require_once("../include/footer.php"); ?>