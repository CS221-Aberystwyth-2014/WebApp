<!-- VIEW RECORDINGS PAGE [records/index.php]
   - Displays a table containing all of the recordings stored in the database.
   - Database Table Name: recordings
   - Database Table Column Names:
     | rec_id | rec_sess_id | users_name | users_phone | users_email | time | species | location | abundance | add_info | scene_photo | specimen_photo |
   - Recordings must be displaced in alphabetical order of latin name
   - Must include a drop down menu to select a reserve, table will then only contain recordings from the specified reserve
   - Must include an option to sort by date (Oldest - Newest & Newest - Oldest)
-->

<?php 

$title = "Recordings";
$bodyid = "recordings";
require_once("../include/header.php");

// Save search parameters to session
if(isset($_POST['submit'])) {
    $_SESSION['reserve'] = $_POST['reserves'];
    $_SESSION['order'] = $_POST['order'];
}

// Set default search parameters
if(!isset($_SESSION['reserve'])) {
    $_SESSION['reserve'] = "All";
    $_SESSION['order'] = "species";
}

$reserve_selected = $_SESSION['reserve'];
$order = $_SESSION['order'];

?>
    <section>
        <div class="message">
            <form id="search_by_reserve" method="POST" action="index.php">

                Select a Reserve:
                <select name="reserves">

                    <option value="All">All</option>
                    <?php 
                        $query = "SELECT rsv_name FROM reserves";
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                    ?><option value="<?php echo $row['rsv_name']; ?>" <?php if($row['rsv_name'] == $reserve_selected) { echo "selected=\"selected\"";} ?>><?php echo $row['rsv_name']; ?></option>
                    <?php } ?>

                </select>

                Order By:
                <input type="radio" class="acheckbox" name="order" value="date" <?php if($order == "date") { echo "checked=\"checked\""; } ?> />Date 
                <input type="radio" class="acheckbox" name="order" value="species" <?php if($order != "date") { echo "checked=\"checked\""; } ?> />Species &nbsp; 
                <input type="submit" class="smallButton" name="submit" value="Search" />
            </form>
        </div>
        <br />
        <?php
            // Get recordings at specific reserves
            if($reserve_selected == "All") {
                $query = "SELECT rec_id,users_name,time,species,reserve,location,abundance,add_info,scene_photo,specimen_photo FROM recordings";
            } else {
                $query = "SELECT rec_id,users_name,time,species,reserve,location,abundance,add_info,scene_photo,specimen_photo FROM recordings WHERE reserve='$reserve_selected'";
            }

            // Order recordings by date or species
            if($order == "date") {
                $query .= " ORDER BY time DESC";
            } else {
                $query .= " ORDER BY species ASC";
            }

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

            if($num_rows != 0) {
                $result = mysqli_query($connection, $query);
        ?>

        <table id="recording">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Species</th>
                <th>Reserve</th>
                <th>Location</th>
                <th>Abundance</th>
                <th width="250px">Additional Info</th>
                <th>Scene Photo</th>
                <th>Specimen Photo</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?php echo $row['rec_id']; ?></td>
                <td><?php echo $row['users_name']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['species']; ?></td>
                <td><?php echo $row['reserve']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php 
                    switch($row['abundance']) {
                        case "D": echo "Dominant";   break;
                        case "A": echo "Abundant";   break;
                        case "F": echo "Frequent";   break;
                        case "O": echo "Occasional"; break;
                        case "R": echo "Rare";       break;
                        default:  echo "N/A";        break;
                    } ?></td>
                <td><?php echo $row['add_info']; ?></td>
                <td>
                    <?php echo "<a href=\"../include/images/scene/" . $row['scene_photo'] . "\"  data-lightbox=\"image-" . $row['scene_photo'] . "\" data-title=\"Scene Image Name: " . $row['scene_photo'] . "\">
                    <img class=\"thumb\" src=\"../include/images/scene/" . $row['scene_photo'] . "\" /></a>"; ?>
                </td>
                <td>
                    <?php echo "<a href=\"../include/images/specimen/" . $row['specimen_photo'] . "\"  data-lightbox=\"image-" . $row['scene_photo'] . "\" data-title=\"Specimen Image Name: " . $row['specimen_photo'] . "\">
                    <img class=\"thumb\" src=\"../include/images/specimen/" . $row['specimen_photo'] . "\" /></a>"; ?>

                </td>
            </tr>
            <?php 
            }
            ?>

        </table>

        <?php 
            require_once("../include/php/functions.php");

            // Show page links if theres more than one
            if($total_pages > 1) {
                $page_output = paginate($page, $total_pages, $page_links, $url); 
                echo $page_output;
            }
        }
        else {
        ?>

        <div class="message">
        No recordings can be found that match your search criteria!
        </div>

        <?php
        }
        ?>

    </section>

    <?php if($num_rows != 0) { ?><div class="spacer"></div><?php } ?>

<?php require_once("../include/footer.php"); ?>
