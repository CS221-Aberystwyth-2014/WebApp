<?php 
require_once("../include/php/connect.php");

$xml          = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$root_element = "species"; 
$xml         .= "<$root_element>";

//select all items in table
$query = "SELECT * FROM species";
 
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Invalid query: ' . mysqli_error());
}
 
if(mysqli_num_rows($result) > 0)
{
   while($result_array = mysqli_fetch_assoc($result))
   {
      $xml .= "<aspecies>";
 
      //loop through each key,value pair in row
      foreach($result_array as $key => $value)
      {
         //$key holds the table column name
         $xml .= "<$key>";
 
         //embed the SQL data in a CDATA element to avoid XML entity issues
         $xml .= htmlentities($value);
 
         //and close the element
         $xml .= "</$key>";
      }
 
      $xml .="</aspecies>";
   }
}

//close the root element
$xml .= "</$root_element>";
 
//send the xml header to the browser
header ("Content-Type:text/xml");
 
//output the XML data
echo $xml;
?>

