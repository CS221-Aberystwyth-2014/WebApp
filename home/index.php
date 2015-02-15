<?php 

$title = "Home";
$bodyid = "home";
require_once("../include/header.php"); 
?>

    <section>
        <div class="section_header">
            <div class="section_header_text">
                Welcome to the Plant Database Website<?php if(isset($_SESSION['uid'])) { echo ", " . $_SESSION['uid'] . "!"; } ?>

            </div>
        </div>
        <div class="section_body">
            <div class="section_body_text">
                <p>This website enables you to manage the data gathered by the plant database mobile application! You can also view and sort through recordings in addition to being able to view,edit,delete and add reserves.</p>
                <br />
                <h2>Resources Used</h2>
                <p>PHP COORD - <a href="http://www.jstott.me.uk/phpcoord/">http://www.jstott.me.uk/phpcoord/</a> (To convert latitude and longitude into OS Grid Reference)</p>
                <p>Eric Meyer's Reset CSS - <a href="http://cssreset.com">http://cssreset.com</a> (To reset CSS elements)</p>
                <p>Lightbox - <a href="http://lokeshdhakar.com/projects/lightbox2/">http://lokeshdhakar.com/projects/lightbox2/</a> (To view images in a pop-up window)</p>
                <p>Regexlib - <a href="http://regexlib.com/">http://regexlib.com/</a> (Used to find regular expressions for validation)
            </div>
        </div>
    </section>
    
<?php require_once("../include/footer.php"); ?>

