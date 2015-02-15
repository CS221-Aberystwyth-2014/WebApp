<?php 

$title = "Log In";
$bodyid = "login";
require_once("../include/header.php"); 

if(isset($_GET['logout'])) {
    if($_GET['logout'] == "true") {
        session_destroy();

        header("Location: ../home/");
        exit;
    }
}

if(isset($_SESSION['uid'])) {
    header("Location: ../home/");
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
		                $providedUsername = strtoupper(htmlentities(strip_tags($_POST['username'])));
		                $providedPassword = htmlentities($_POST['password']);

		                if($providedUsername != $username || $providedPassword != $password) {
			                echo "<div class=\"message\">Invalid Login</div>";
		                }

		                if ($providedPassword == $password && $providedUsername == $username) {
			                $_SESSION['uid'] = $providedUsername;
			                $_SESSION['reserve'] = "All";
			                
                            header("Location: ../home/index.php");
			                exit;
		                }
		            }
		            ?>

		            <form method="POST" action="index.php">
		                <label class="aboveLabel" for="username">Login ID:</label>
                        <input type="text" name="username">
		                <label class="aboveLabel" for="password">Password:</label>
		                <input type="password" name="password">
		                <br />
		                <br />
		                <input type="submit" class="largeButtonCentered" name="submit" value="Submit">
		            </form>
                </center>
            </div>
        </div>
    </section>
        
<?php require_once("../include/footer.php"); ?>
