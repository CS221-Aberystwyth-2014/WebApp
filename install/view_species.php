<?php

$dbhost = "db.dcs.aber.ac.uk";
$dbuser = "pjn";
$dbpass = "8By65h7o4m!";
$dbname = "pjn";

// Open connection to the database
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "SELECT * FROM species";
$result = mysqli_query($connection, $query);

echo "<table>\n\t<tr>\n";

// Create table column headers           
foreach(array_keys(mysqli_fetch_assoc($result)) as $col_name) {
    echo "\t  <td><strong>{$col_name}</strong></td>\n";
}

echo "\t</tr>";

// Reset pointer
mysqli_data_seek($result, 0); 

while($row = mysqli_fetch_assoc($result)) {
?>
    
        <tr>
            <td><?php echo $row['species_id']; ?></td>
            <td><?php echo $row['species_name']; ?></td>
            <td><?php echo $row['authority']; ?></td>
            <td><?php echo $row['common_name']; ?></td>
        <tr>
<?php

}
echo "</table>";


?>