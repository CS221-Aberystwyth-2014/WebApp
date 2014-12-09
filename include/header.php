<!-- PAGE HEADER [include/header.php]
   - Overall header of the website, contains the banner & site navigation bar
        > NAV LINKS <
            > Home
            > Recordings
            > Reserves
            > Login
    - Included by every page
-->
<?php 
require_once("../include/php/connect.php");
require_once("../include/php/session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Group Project</title>
    <link rel="stylesheet" type="text/css" href="../include/css/style.css">
</head>
<body>
    <header>
        <h1>Plant Database</h1>
        <nav>
            <ul id="navigation">
                <li>
                    <a href="../home/index.php">Home</a>
                </li>
                <li>
                    <a href="../records/index.php">Recordings</a>
                </li>
                <li>
                    <a href="../reserves/index.php">Reserves</a>
                </li>
                <?php if(!isset($_SESSION['uid'])) {?>
                <li>
                    <a href="../login/index.php">Login</a>
                </li>
                <?php } else { ?>
                <li>
                    <a href="../login/index.php?logout=true">Log Out</a>
                </li>
                <?php } ?>
                
            </ul>
        </nav>
    </header>