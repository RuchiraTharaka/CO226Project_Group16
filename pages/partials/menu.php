<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nena Sala</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <div class="logo-img">
                <a href="home.php"><img src="images/logo.png" alt=""></a>
            </div>
            <div class="logo-text">
                <a href="home.php">NENA SALA</a>
            </div>
        </div>

        <div class="navbar">
            <a href=profile.php>profile</a>
            <a href=content.php>contents</a>
            <?php
                $AccMod = $_SESSION["module"];

                if ( $AccMod == "ADM")
                {
                    echo "<a href=center.php>center</a>
                    <a href=req.php>requests</a>
                    <a href=session.php>Sessios</a>";
                }
            ?>
            <a href=logout.php>logout</a>
        </div>
    </div>
    <!-- Headee sections ends -->