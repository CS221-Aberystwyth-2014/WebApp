<!-- LOGIN PAGE [login/index.php]
   - Displays a login form to the user, requires an administrator login id and password
        > FIELDS REQUIRED <
            > Login ID (text field)
            > Password (password field)
            > Login Button (submit)
   - The data in the form fields will need to be validated both client side and server side (Javascript & PHP)
        > Client side, check for empty fields
        > Server side, check that the login id exists (is valid) and check the password is correct
-->

<?php 
require_once("../include/header.php"); 

if(isset($_GET['logout'])) {
    if($_GET['logout'] == "true") {
        session_destroy();
        header("Location: ../home/index.php");
        exit;
    }
}

$password = '123';
$username = 'ADMIN';
?>

    <section>
        <div class="section_header">
            <div class="section_header_text">
                Log In
            </div>
        </div>
        <div class="section_body">
            <div class="section_body_text">
                <center>
                <?php 
                if(isset($_POST['submit'])) {
                    $providedUsername = strtoupper(htmlentities(strip_tags($_POST['login'])));
                    $providedPassword = htmlentities($_POST['password']);
                
                    if($providedUsername != $username || $providedPassword != $password) {
                        echo "<div class=\"message\">Invalid Login</div>";
                    }

                    if ($providedPassword == $password && $providedUsername == $username) {
                        $_SESSION['uid'] = $providedUsername;
                        header("Location: ../home/index.php");
                        exit;
                    }
                }
                ?>
                <br />
                    <form method="POST" action="index.php">
                        Login ID:
                        <p>
                        <input type="text" id="password" name="login">
                        </p>
                        <br>
                        Password:
                        <p>
                        <input type="password" id="password" name="password">
                        </p>
                        <br>
                        <input type="submit" id="submit" name="submit" value="Submit">
                    </form>
                </center>
            </div>
        </div>
    </section>
        
<?php require_once("../include/footer.php"); ?>
