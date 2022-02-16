<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nena Sala</title>
    <link rel="stylesheet" href="./css/main.css">
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
            <?php
                $AccMod = "STD";
                $profile   = "profile.php";
                $content  = "content.php";
                $center  = "center.php";
                $req  = "req.php";
                $session  = "session.php";
                $main = "../index.php";


                if ( $AccMod == "ADM")
                {
                    echo "<a href=" . $profile .">profile</a>
                    <a href=" . $content .">contents</a>
                    <a href=" . $center .">center</a>
                    <a href=" . $req .">requests</a>
                    <a href=" . $session .">Sessios</a>
                    <a href=" . $main .">logout</a>";
                }
                else if ($AccMod == "UGS")
                {
                    echo "<a href=" . $profile .">profile</a>
                    <a href=" . $content .">contents</a>
                    <a href=" . $main .">logout</a>";
                }
                else if ($AccMod == "STD")
                {
                    echo "<a href=" . $profile .">profile</a>
                    <a href=" . $content .">contents</a>
                    <a href=" . $main .">logout</a>";
              }
            ?>
        </div>
    </div>
    <!-- Headee sections ends -->
    <script src="./js/script.js"></script>
</body>
</html>