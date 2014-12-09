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
require_once("../include/header.php");
?>

    <section>
        <div class="message">
            Select a Reserve:
            <select>
                <option value="aberystwyth">Aberystwyth</option>
                <option value="borth">Borth</option>
                <option value="slough">Slough</option>
                <option value="abermad">Abermad</option>
            </select>
        </div>
        <br />
        <table id="recording">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Date</th>
                <th>Species</th>
                <th>Location</th>
                <th>Abundance</th>
                <th>Additional Info</th>
                <th>Scene Photo</th>
                <th>Specimen Photo</th>
            </tr>
        <?php 
        $query = "SELECT * FROM recordings";
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['rec_id']; ?></td>
                <td><?php echo $row['users_name']; ?></td>
                <td><?php echo $row['users_phone']; ?></td>
                <td><?php echo $row['users_email']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['species']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td>
                <?php 
                    switch($row['abundance']) {
                        case "D":
                            echo "Dominant";
                            break;
                        case "A":
                            echo "Abundant";
                            break;
                        case "F":
                            echo "Frequent";
                            break;
                        case "O":
                            echo "Occasional";
                            break;
                        case "R":
                            echo "Rare";
                            break;
                        default:
                            echo "N/A";
                            break;
                    }
                ?>
                </td>
                <td><?php echo $row['add_info']; ?></td>
                <td><?php echo $row['scene_photo']; ?></td>
                <td><?php echo $row['specimen_photo']; ?></td>
            </tr>
        <?php 
        }
        ?>
        </table>
    </section>

<?php require_once("../include/footer.php"); ?>
