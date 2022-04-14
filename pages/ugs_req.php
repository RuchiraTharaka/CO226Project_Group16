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
                    <div class="ugs-req">
                        <?php
                            $sql = "SELECT * FROM view_ugs_request";

                            $query = mysqli_query($conn, $sql);  
                            if (mysqli_num_rows($query) > 0)
                            {
                                echo "<div  class=\"head\"><table>
                                        <th width= 20%>First Name</th>
                                        <th width= 20%>Last Name</th>
                                        <th width= 20%>Email</th>
                                        <th width= 30%>Department</th>
                                        <th width= 10%>Registration Number</th></table></div>";
                                echo "<div class=\"rslt-view\"><table>";
                                        while($row = mysqli_fetch_array($query))
                                        {
                                            echo "<tr>
                                            <td width= 20%>" .$row[0] ."</td>
                                            <td width= 20%>" .$row[1] ."</td>
                                            <td width= 20%>" .$row[2] ."</td>
                                            <td width= 30%>" .$row[3] ."</td>
                                            <td width= 10%>" .$row[4] ."</td>
                                            </tr>";
                                        }
                                echo "</table></div>";

                                
                                echo "<div class=\"edit-form\"><form id=\"setID\" action=\"";
                                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                echo "\" method=\"POST\">";
                                echo "<p class=\"err\">" .$error ."</p>";
                                echo
                                "<table>
                                <tr>
                                <td class=\"plbl\">Email</td>
                                <td><input type=\"text\" class=\"pinp\" name=\"email\" id=\"email\" value=\"\" readonly=\"readonly\" placeholder=\"select row\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">User ID</td>
                                <td><input type=\"text\" class=\"pinp\" name=\"userid\" id=\"userid\" value=\"\" placeholder=\"UGSxxx\"></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td id=\"eqcell\">
                                <input class=\"btn\" type=\"submit\" value=\"Accept\">
                                <input class=\"btn\" type=\"submit\" value=\"Reject\"></td>
                                </tr>
                                </table>
                                </form>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste provident consectetur fugit aut dignissimos dolorum non pariatur asperiores dicta reiciendis.</p>
                                </div>";
                            }
                            else
                            {
                                echo "no result to show";
                            }
                        ?>
                    </div>
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

