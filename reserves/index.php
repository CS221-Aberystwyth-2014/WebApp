<!-- VIEW RESERVES PAGE [reserves/index.php]
   - Displays a table containing a list of all the reserves and information about them
   - Database Table Name: reserves
   - Database Table Column Names: 
        | rsv_id | rsv_name | rsv_loc | rsv_desc |
   - Reserves will probably be displayed in alphabetical order [A-Z]
   - Must include an option to add (create) a new reserve
   - Must include options to update or delete a reserve (probably at the end of each table row)
-->

<?php require_once("../include/header.php"); ?>
        
    <section>  
        <div class="message">
            On this page you can view, edit and delete reserves!
        </div>
        <br />
        <table id="reserve">
            <tr>
                <th>ID</th>
                <th>Reserve Name</th>
                <th>Location</th>
                <th>Description</th>
                <?php if(isset($_SESSION['uid'])) { ?>
                <th>Options</th>
                <?php } ?>
            </tr>
            <tr>
                <td>123</td>
                <td>Aberystwyth Reserve</td>
                <td>53.66,1.01</td>
                <td>Wet, Green</td>
                <?php if(isset($_SESSION['uid'])) { ?>
                <td><a href="edit.php?id=1">Edit</a> | <a href="#">Delete</a></td>
                <?php } ?>
            </tr>
            <tr>
                <td>124</td>
                <td>Borth Reserve</td>
                <td>40.21, 2.33</td>
                <td>Lots of leaves</td>
                <?php if(isset($_SESSION['uid'])) { ?>
                <td><a href="edit.php?id=2">Edit</a> | <a href="#">Delete</a></td>
                <?php } ?>
            </tr>
            <tr>
                <td>125</td>
                <td>Slough Reserve</td>
                <td>35.34, -7.25</td>
                <td>Vibrant colours</td>
                <?php if(isset($_SESSION['uid'])) { ?>
                <td><a href="edit.php?id=3">Edit</a> | <a href="#">Delete</a></td>
                <?php } ?>
            </tr>
            <tr>
                <td>126</td>
                <td>Abermad Reserve</td>
                <td>52.30, -4.20</td>
                <td>Sloppy ground</td>
                <?php if(isset($_SESSION['uid'])) { ?>
                <td><a href="edit.php?id=4">Edit</a> | <a href="#">Delete</a></td>
                <?php } ?>
            </tr>
        </table>
        <br>
        
    </section>

<?php require_once("../include/footer.php"); ?>
