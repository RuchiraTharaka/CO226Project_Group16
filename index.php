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
            <a href="#about">About</a>
            <a href="#contact">Contact us</a>
        </div>
    </div>
    <!-- Header sections ends -->

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <div class="banner">
                <h3>nena sala tutoring project</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In facilis voluptatibus, assumenda beatae repudiandae sequi? Doloribus molestias odit in ullam sed blanditiis facere praesentium consequuntur officia pariatur placeat possimus dignissimos perferendis architecto ipsum porro minima, itaque omnis facilis nam quis nemo. Itaque corrupti natus modi cum in numquam officia saepe!</p>
                <a href="#view" class="btn">View More</a>
            </div>
            
            <section class="container">
                <div class="sessions section">
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
                        header("Location: ./error.php");
                        exit();
                    }

                    $sqlresult = "SELECT * FROM view_session_main_home";

                    //  get the result from the query
                    $query = mysqli_query($conn, $sqlresult);

                    if (mysqli_num_rows($query) > 0)
                    {
                        echo "<table id=\"m\">
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
                        echo "</table>";
                    }
                            
                    mysqli_close($conn);
                    ?>
                </div>

                <div class="space"></div>
                <div class="about section" id="about">
                    <h3>About us</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa magni beatae autem unde voluptas debitis distinctio nemo quae laudantium mollitia sequi, architecto recusandae tenetur totam facere commodi tempore ea eligendi libero! Consectetur accusantium tempore inventore totam obcaecati minus consequuntur, ratione necessitatibus quidem deserunt aliquid amet quas, fuga nihil asperiores, praesentium iste quaerat! Quasi esse recusandae dolorum sint, reiciendis eos praesentium.
                    </p>
                    <div class="statistics">                        
                        <div class="row">
                            <div class=" acol col-1">
                                <p>centers</p>
                                <h5>10+</h5>
                            </div>
                            <div class=" acol col-2">
                                <p>schools</p>
                                <h5>100+</h5>
                            </div>
                            <div class=" acol col-3">
                                <p>volunteers</p>
                                <h5>500+</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
                <div class="contact section" id="contact">
                    <h3>contact us</h3>
                    <div class="contact-form">

                    </div>
                </div>
            </section>
        </section>
    </div>
    <!-- Body Sections ends  -->
    




    <script src="script.js"></script>
</body>
</html>