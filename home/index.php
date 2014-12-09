<!-- FRONT PAGE [home/index.php]
   - Welcome message
   - Description of the website and what it does
   - Information about how to use the website
-->
<?php require_once("../include/header.php"); ?>

    <section>
        <div class="section_header">
            <div class="section_header_text">
                Welcome to the Plant Database Website, <?php echo $_SESSION['uid']; ?>!
            </div>
        </div>
        <div class="section_body">
            <div class="section_body_text">
                <p>This is group 10's project for CS21100.</p>
                <p>This website allows the admin to log in to edit the reserves. It also allows the reserves and recordings to be viewed online.</p>
                <p>To use the website just select the pages you want to view in the navigation above. Admin can login and make any necessary changes.</p>
            </div>
        </div>
    </section>
    
<?php require_once("../include/footer.php"); ?>

