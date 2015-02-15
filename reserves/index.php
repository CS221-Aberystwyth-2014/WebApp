<?php 
    $title = "Reserves";
    $bodyid = "reserves";
    require_once("../include/header.php"); 

    // Delete a reserve if the user is logged in and an id is provided                                                                              
    if(isset($_GET['id']) && isset($_SESSION['uid'])) {
        $id = htmlentities(strip_tags($_GET['id']));
        $query = "DELETE FROM reserves WHERE rsv_id='$id'";
        $result = mysqli_query($connection, $query);
    }
?>

    <section>  
        <div class="message">
            On this page you can view, edit and delete reserves!
        </div>
        <br />

        <table id="reserve">
            <tr>
                <th>Reserve Name</th>
                <th>Location (OS Grid Reference)</th>
                <th>Description</th>
                <?php if(isset($_SESSION['uid'])) { ?><th>Options</th><?php } ?>

            </tr>

            <?php 
                $query = "SELECT rsv_id,rsv_name,rsv_loc,rsv_desc FROM reserves ORDER BY rsv_name ASC";
                $result = mysqli_query($connection, $query);

                //==================//
                //    PAGINATION    //
                //==================//

                $num_rows = mysqli_num_rows($result);
                $rows_per_page = 10;
                $total_pages = ceil($num_rows / $rows_per_page);
                $page_links =  5;
                $url = "{$_SERVER['PHP_SELF']}?";

                // Get current page and set as default
                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                // Check that the page exists
                if ($page > $total_pages) {
                    $page = $total_pages;
                }
                else if ($page < 1) {         
                    $page = 1;
                }

                $offset = ($page - 1) * $rows_per_page;

                // Free previous result
                mysqli_free_result($result);

                // Retrieve all songs for the current page
                $query .= " LIMIT $rows_per_page OFFSET $offset";

                $result = mysqli_query($connection, $query);


                while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?php echo $row['rsv_name']; ?></td>
                <td><?php echo $row['rsv_loc']; ?></td>
                <td><?php echo $row['rsv_desc']; ?></td>
                <?php if(isset($_SESSION['uid'])) { ?>

                <td>
                    <a href="edit.php?id=<?php echo $row['rsv_id']; ?>"><input type="submit" class="smallButton" name="smallButton" value="Edit" /></a>
                    <a href="index.php?id=<?php echo $row['rsv_id']; ?>"><input type="submit" class="smallButton" name="smallButton" value="Delete" /></a>
                </td><?php } ?>

            </tr>

        <?php } ?>

        </table>

        <br />
        <?php if(isset($_SESSION['uid'])) { ?>

        <a href="add.php"><input type="submit" class="largeButton" name="largeButton" value="Add Reserve" /></a><br />
        <?php } 
            require_once("../include/php/functions.php");

            // Show page links if theres more than one
            if($total_pages > 1) {
                $page_output = paginate($page, $total_pages, $page_links, $url); 
                echo $page_output;
            }
        ?>

    </section>
    
    <?php if($num_rows != 0) { ?><div class="spacer"></div><?php } ?>

<?php require_once("../include/footer.php"); ?>
