<?php
    include("./partials/menu.php");

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "Group16Project";
    $email = $userid = "";
    $error = "";
    $coid = $cotopic = $codesc = $colink1 = $colink2 = "";
    $param_colink2 = "";

    // Create the sql connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (!$conn)
    {
        header("Location: ./error.php");
        exit();
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $coid = trim($_POST["coid"]);

        if (isset($_POST['co-cfmdlt'])) {
            // Prepare a select statement
            $sql = "CALL Remove_content(?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $coid);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    header("Location: ./content.php");
                }
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        } else if (isset($_POST['co-save']) || isset($_POST['co-add'])) {
            // delete button pressed
            // check whether Content topic field is empty
            if(empty(trim($_POST["cotopic"])))
            {
                $error = "Content topic cannot be empty";
            } else {
                $cotopic = trim($_POST["cotopic"]);
            }
    
            // check whether Content description field is empty
            if(empty(trim($_POST["codesc"])))
            {
                $error = "Content description cannot be empty";
            } else {
                $codesc = trim($_POST["codesc"]);
            }

            if ($error == ""){
                if (isset($_POST['co-save'])) {
                    $sql = "CALL Update_content(?, ?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "issss", $coid, $cotopic, $codesc, $colink1, $colink2);

                        //Set parameters
                        $colink1 = trim($_POST["colink1"]);
                        $colink2 = trim($_POST["colink2"]);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./content.php");
                        }
                        else{
                            $error =  "Oops! Something went wrong. Please try again later.";
                        }
            
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                } else if (isset($_POST['co-add'])) {
                    $sql = "CALL Create_content(?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "ssss", $cotopic, $codesc, $colink1, $colink2);

                        //Set parameters
                        $colink1 = trim($_POST["colink1"]);
                        $colink2 = trim($_POST["colink2"]);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./content.php");
                        }
                        else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
            
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }
            }
        }     
    }

    function php_func($coid) {
        $sql = "SELECT DESCRIPTION, LINK1, LINK2 FROM CONTENT WHERE CONTENT_ID = " .$coid;

        $query = mysqli_query($conn, $sql);

        $row = mysqli_fetch_array($query);

        $codesc = $row[0];
        $colink1 = $row[1];
        $colink2 = $row[2];
    }
?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="content">   
                    <?php
                        // $sql = "SELECT CONTENT_ID, CONTENT_TOPIC FROM CONTENT";
                        $sql = "SELECT * FROM CONTENT";

                        $query = mysqli_query($conn, $sql);  
                        if (mysqli_num_rows($query) > 0)
                        {
                            if ($_SESSION['module'] == "STD") {
                                
                                while($row = mysqli_fetch_array($query))
                                {
                                    echo 
                                    "<div class=\"std-view\">
                                    <h4>" .$row[1] ."</h4>
                                    <table>
                                    <tr>
                                    <td width= 20%>Description</td>
                                    <td class=\"pinplbl\">" .$row[2] ."</td>
                                    </tr>
                                    <tr>
                                    <td>References</td>
                                    <td><a class=\"pinplbl\" href=" .$row[3] ." target=\"_blank\">" .$row[3] ."</td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    <td><a class=\"pinplbl\" href=" .$row[4] ." target=\"_blank\">" .$row[4] ."</td>
                                    </tr>
                                    </table>
                                    </div>";
                                }

                                echo "<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste provident consectetur fugit aut dignissimos dolorum non pariatur asperiores dicta reiciendis.</p>
                                ";
                            } 
                            else {
                                
                                echo "<div class=\"head\"><table>
                                    <th width= 10%>Content ID</th>
                                    <th width= 20%>Content Topic</th>
                                    <th width= 20%>Description</th>
                                    <th width= 25%>Link1</th>
                                    <th width= 25%>Link2</th></table></div>";
                                echo "<div class=\"rslt-view\"><table>";
                                        while($row = mysqli_fetch_array($query))
                                        {
                                            echo "<tr>
                                            <td width= 10%>" .$row[0] ."</td>
                                            <td width= 20%>" .$row[1] ."</td>
                                            <td width= 20%>" .$row[2] ."</td>
                                            <td width= 25%>" .$row[3] ."</td>
                                            <td width= 25%>" .$row[4] ."</td>
                                            </tr>";
                                        }
                                echo "</table></div>";

                                echo "<div class=\"edit-form\"><form id=\"content-edit\" action=\"";
                                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                echo "\" method=\"POST\">";

                                echo "<p id=\"error\" class=\"err\">" .$error ."</p>";

                                echo
                                "<table>
                                <tr>
                                <td class=\"plbl\">Content ID</td>
                                <td><input type=\"text\" class=\"pinp\" name=\"coid\" id=\"coid\" value=\"\" placeholder=\"\" readOnly=\"true\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Content Topic</td>
                                <td><input type=\"text\" class=\"pinp\" name=\"cotopic\" id=\"cotopic\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Description</td>
                                <td><textarea name=\"codesc\" id=\"codesc\" form=\"content-edit\" class=\"pinp\"cols=\"60\" rows=\"4\" readonly=\"readonly\"></textarea></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Reference Links</td>
                                <td><textarea name=\"colink1\" id=\"colink1\" form=\"content-edit\" class=\"pinp\"cols=\"60\" rows=\"2\" readonly=\"readonly\"></textarea></td>
                                </tr>
                                </tr>
                                <tr>
                                <td class=\"plbl\"></td>
                                <td><textarea name=\"colink2\" id=\"colink2\" form=\"content-edit\" class=\"pinp\"cols=\"60\" rows=\"2\" readonly=\"readonly\"></textarea></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td id=\"eqcell\">
                                <button type=\"button\" onclick=\"edit()\" id=\"co-edit\" class=\"btn\">Edit</button>
                                <button type=\"button\" onclick=\"add_new()\" id=\"co-add-new\" class=\"btn\">Add New</button>
                                <button type=\"button\" onclick=\"dlt()\" id=\"co-dlt\" class=\"btn\">Delete</button>
                                <input id=\"co-save\" name=\"co-save\" class=\"btn hide\" type=\"submit\" value=\"Save\">
                                <input id=\"co-add\" name=\"co-add\" class=\"btn hide\" type=\"submit\" value=\"Add\">
                                <input id=\"co-cfmdlt\" name=\"co-cfmdlt\" class=\"btn hide\" type=\"submit\" value=\"Confirm Delete\">
                                <button type=\"button\" onclick=\"cancel()\" id=\"co-cancel\" class=\"btn hide\">Cancel</button></td>
                                </tr>
                                </table>
                                </form>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste provident consectetur fugit aut dignissimos dolorum non pariatur asperiores dicta reiciendis.</p>
                                </div>";
                            }
                        }
                        else
                        {
                            echo "no result to show";
                        }
                    ?>
                </div>
            </section>
        </section>
    </div>
    <!-- Body Sections ends  -->

    <script src="./js/content.js"></script>
<?php
mysqli_close($conn);
include("./partials/footer.php"); 
?>

