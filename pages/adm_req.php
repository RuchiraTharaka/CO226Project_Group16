<?php
    include("./partials/menu.php");

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "Group16Project";
    $email = $userid = "";
    $error = "";

    // Create the sql connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (!$conn)
    {
        header("Location: ./error.php");
        exit();
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(strlen(trim($_POST["userid"])) == 6){
            $sql = "CALL Accept_Request(?, ?)";
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                mysqli_stmt_bind_param($stmt, "ss", $email, $userid);
                
                // Set parameters
                $email = trim($_POST["email"]);
                $userid = trim($_POST["userid"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    header($_SERVER["PHP_SELF"]);
                }
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        else {
            $error = "Unable accept account. Invalid UserID!";
        }
    }
?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="req">
                    <div class="menu">
                        <a href=adm_req.php>Admin Requests</a>
                        <a href=ugs_req.php>Undergraduate requests</a>
                        <a href=std_req.php>Student requests</a>
                    </div>
                    <div class="adm-req">
                        <?php
                            $sql = "SELECT * FROM view_adm_request";

                            $query = mysqli_query($conn, $sql);  
                            if (mysqli_num_rows($query) > 0)
                            {
                                echo "<table id=\"view\">
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Enrollment Number</th>";
                                        while($row = mysqli_fetch_array($query))
                                        {
                                            echo "<tr>
                                            <td>" .$row[0] ."</td>
                                            <td>" .$row[1] ."</td>
                                            <td>" .$row[2] ."</td>
                                            <td>" .$row[3] ."</td>
                                            <td>" .$row[4] ."</td>
                                            </tr>";
                                        }
                                echo "</table>";

                                echo "<p class=\"err\">" .$error ."</p>";
                                
                                echo "<form id=\"setID\" action=\"";
                                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                echo "\" method=\"POST\">";
                                echo
                                "<table>
                                <tr>
                                <td class=\"plbl\">Email</td>
                                <td><input type=\"text\" class=\"pinp\" name=\"email\" id=\"email\" value=\"\" readonly=\"readonly\" placeholder=\"select row\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">User ID</td>
                                <td><input type=\"text\" class=\"pinp\" name=\"userid\" id=\"userid\" value=\"\" placeholder=\"ADMxxx\"></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input class=\"btn\" type=\"submit\" value=\"Accept\">
                                <input class=\"btn\" type=\"submit\" value=\"Reject\"></td>
                                </tr>
                                </table>
                                </form>";
                            }
                            else
                            {
                                echo "no result to show";
                            }
                        ?>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste provident consectetur fugit aut dignissimos dolorum non pariatur asperiores dicta reiciendis.</p>
                </div>
            </section>
        </section>
    </div>
    <!-- Body Sections ends  -->

    <script src="./js/req.js"></script>
<?php
mysqli_close($conn);
include("./partials/footer.php"); 
?>

