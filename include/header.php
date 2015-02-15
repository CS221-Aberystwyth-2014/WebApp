<?php 
require_once("../include/php/connect.php");
require_once("../include/php/session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Plant Catalog - <?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="../include/css/style.css">
    <link href="../include/css/lightbox.css" rel="stylesheet" />
</head>

<!-- LIGHTBOX -->
<script src="../include/js/jquery-1.11.0.min.js"></script>
<script src="../include/js/lightbox.min.js"></script>

<body id="<?php echo $bodyid; ?>">
    <header>
        <h1>Plant Database</h1>
        <nav>
            <ul id="navigation">
                <li><a href="../home/index.php" id="homeLink">Home</a></li>
                <li><a href="../records/index.php" id="recordingsLink">Recordings</a></li>
                <li><a href="../reserves/index.php" id="reservesLink">Reserves</a></li>
                <?php if(!isset($_SESSION['uid'])) {?><li><a href="../login/index.php" id="loginLink">Login</a></li>
                <?php } else { ?><li><a href="../login/index.php?logout=true">Log Out</a></li><?php } ?>          
            </ul>
        </nav>
    </header>

<div class="spacer"></div>
