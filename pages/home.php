    <?php include('partials/menu.php'); ?>

        <!-- Body Sections begin  -->
        <div class="body">
            <section class="gradient">
                <div class="banner">
                    <h3>nena sala tutoring project</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In facilis voluptatibus, assumenda beatae repudiandae sequi? Doloribus molestias odit in ullam sed blanditiis facere praesentium consequuntur officia pariatur placeat possimus dignissimos perferendis architecto ipsum porro minima, itaque omnis facilis nam quis nemo. Itaque corrupti natus modi cum in numquam officia saepe!</p>
                    <a href="#vision" class="btn">View More</a>
                </div>
                
                <section class="container">
                    <div class="sessions section">
                        <h3>upcoming sessions</h3>

                        <?php

                        $dbhost = "localhost:3306";
                        $dbuser = "root";
                        $dbpass = "";
                        $db = "Group16Project";
                        $mail = $_SESSION["email"];

                        // Create the sql connection
                        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

                        if (!$conn)
                        {
                            header("Location: ./error.php");
                            exit();
                        }

                        if ($_SESSION["module"] == "STD")
                        {
                            $sqlresult = "SELECT * FROM view_session_user v, school sc, student s , center c WHERE s.SCHOOL_ID = sc.SCHOOL_ID AND sc.CENTER_ID = c.CENTER_ID AND c.CENTER_NAME = v.Ce_Name AND s.EMAIL = '" .$mail ."'";
                        }   
                        else
                        {
                            $sqlresult = "SELECT * FROM view_session_user";
                        }

                        //  get the result from the query
                        $query = mysqli_query($conn, $sqlresult);

                        if (mysqli_num_rows($query) > 0)
                        {
                            while($row = mysqli_fetch_array($query))
                            {
                                echo "<div class=\"session-01\">";
                                echo "<h3>" .$row[0] ."  @  " .$row[1] ."</h3>";
                                echo "<table>
                                <tr>
                                    <td>date</td>
                                    <td>" .$row[0] ."</td>
                                </tr>
                                <tr>
                                    <td>time</td>
                                    <td>" .$row[1] ."</td>
                                </tr>
                                <tr>
                                    <td>center name</td>
                                    <td>" .$row[2] ."</td>
                                </tr>
                                <tr>
                                    <td>session number</td>
                                    <td>" .$row[3] ."</td>
                                </tr>
                                <tr>
                                    <td>zoom link</td>
                                    <td><a href=" .$row[4] ." target=\"_blank\">Join</a></td>
                                </tr>
                                <tr>
                                    <td>topic</td>
                                    <td>" .$row[5] ."</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>" .$row[6] ."</td>
                                </tr>
                                <tr>
                                    <td>tutor</td>
                                    <td>" .$row[7] ."</td>
                                </tr>
                                <tr>
                                    <td>tutor's e-mail</td>
                                    <td><a class=\"none\" href=\"https://mail.google.com/\" target=\"_blank\">" .$row[8] ."</td>
                                </tr>
                                <tr>
                                    <td>reference links</td>
                                    <td><a class=\"none\" href=" .$row[9] ." target=\"_blank\">" .$row[9] ."</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a class=\"none\" href=" .$row[10] ." target=\"_blank\">" .$row[10] ."</td>
                                </tr>";
                                echo "</table></div>";
                            }
                        }
                        else{
                            echo "no result to show";
                        }
                                
                        mysqli_close($conn);
                        ?>
                    </div>

                    <div class="space"></div>

                    <div class="vision section" id="vision">
                        <h3>our vision</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa magni beatae autem unde voluptas debitis distinctio nemo quae laudantium mollitia sequi, architecto recusandae tenetur totam facere commodi tempore ea eligendi libero! Consectetur accusantium tempore inventore totam obcaecati minus consequuntur, ratione necessitatibus quidem deserunt aliquid amet quas, fuga nihil asperiores, praesentium iste quaerat! Quasi esse recusandae dolorum sint, reiciendis eos praesentium.
                        </p>
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
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis hic accusamus vel asperiores. Quae, sed?lorem30</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci, quos maiores? Quam repellendus consequuntur autem neque exercitationem numquam dicta voluptates nemo odio! Id veritatis ullam, autem sint recusandae nulla quod. </p>
                        <div class="contact-form">
                            <div class="form">
                                <table>
                                    <tr>
                                        <td class="lbl" >full name</td>
                                        <td class="lbl" >e mail</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="inp" placeholder="Christina magie"></td>
                                        <td><input type="email" name="" id="email" class="inp" placeholder="example@gmail.com"></td>
                                    </tr>
                                    <tr>
                                        <td class="lbl" >telephone</td>
                                        <td class="lbl" >organaizations</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="inp" placeholder="+94 71 300 00 00"></td>
                                        <td><input type="text" class="inp" id="" placeholder="university of peradeniya"></td>
                                    </tr>
                                </table>
                                <table>
                                    <tr><td class="lbl">add comments</td></tr>
                                    <tr>
                                        <td><textarea name="" id="" cols="60" rows="6"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td class="btn  "><button type="submit">submit</button></td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td ><a href="https://www.instagram.com/" target="_blank"><img class="contact-img" src="./images/insta.png" alt=""></a></td>
                                        <td ><a href="https://www.facebook.com/" target="_blank"><img class="contact-img" src="./images/fb.png" alt=""></a></td>
                                        <td ><a href="https://web.whatsapp.com/" target="_blank"><img class="contact-img" src="./images/wp.png" alt=""></a></td>
                                        <td ><a href="https://mail.google.com/" target="_blank"><img class="contact-img" src="./images/email.png" alt=""></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <!-- Body Sections ends  -->

    <?php include('partials/footer.php'); ?>