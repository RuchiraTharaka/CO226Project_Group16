<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nena Sala</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Header sections starts -->
    <div class="header">
        <div class="logo">
            <div class="logo-img">
                <a href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            <div class="logo-text">
                <a href="index.php">NENA SALA</a>
            </div>
        </div>

        <div class="navbar">
            <a href="./pages/home.php">Home</a>
            <a href="#Login">Login</a>
            <a href="#Register">Register</a>
            <a href="#About">About</a>
            <a href="#Contact us">Contact us</a>
        </div>
    </div>
    <!-- Header sections ends -->

    <section class="banner">
        <div class="content">
            <h3>NENA SALA TUTORING PROJECT</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In facilis voluptatibus, assumenda beatae repudiandae sequi? Doloribus molestias odit in ullam sed blanditiis facere praesentium consequuntur officia pariatur placeat possimus dignissimos perferendis architecto ipsum porro minima, itaque omnis facilis nam quis nemo. Itaque corrupti natus modi cum in numquam officia saepe!</p>
            <a href="#view" class="btn">View More</a>
        </div>
    </section>

    <section class="container">
        <h3>upcoming sessions</h3>

        <?php

        $dbhost = "localhost:3306";
        $dbuser = "root";
        $dbpass = "";
        $db = "Group16Project";

        // Create the sql connection
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

        if (!$conn)
        {
            die("Unabale to connect");
        }

        $sqlresult = "SELECT * FROM view_session_main_home";

        //  get the result from the query
        $query = mysqli_query($conn, $sqlresult);

        if (mysqli_num_rows($query) > 0)
        {
            echo "<div class=session-one>
                <table>
                    <th>date</th>
                    <th>time</th>
                    <th>topic</th>
                    <th>center name</th>";
                while($row = mysqli_fetch_array($query))
                {
                    echo "<tr>
                    <td>" .$row[0] ."</td>
                    <td>" .$row[1] ."</td>
                    <td>" .$row[2] ."</td>
                    <td>" .$row[3] ."</td>
                    </tr>";
                }
            echo "</table></div>";
        }
        ?>
    </section>

    <div class="view" id="view">
        helo there
    </div>


    <script src="script.js"></script>
</body>
</html>