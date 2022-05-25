<?php
    include("./partials/menu.php");

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "Group16Project";
    $email = $userid = "";
    $error = "";
    $sclid = $sclname = $scltel = $scl_cename = "";

    // Create the sql connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (!$conn)
    {
        header("Location: ./error.php");
        exit();
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sclid = trim($_POST["sclid"]);

        if (isset($_POST['ce-cfmdlt'])) {
            // Prepare a select statement
            $sql = "CALL Remove_school(?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $sclid);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    header("Location: ./scl.php");
                }
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        } else if (isset($_POST['ce-save']) || isset($_POST['ce-add'])) {
            // delete button pressed
            // check whether Center name field is empty
            if(empty(trim($_POST["sclname"])))
            {
                $error = "School Name cannot be empty";
            } else {
                $sclname = trim($_POST["sclname"]);
            }
    
            // // Check wheather center telephone number is empty and valid
            if(empty(trim($_POST["scltel"]))) {
                $error = "Tel Number cannot be empty";
            } elseif(is_numeric(trim($_POST["scltel"])) && strlen(trim($_POST["scltel"])) == 9){
                $scltel = trim($_POST["scltel"]);
            }
            else {
                $error = "Invalid phone number";
            }
    
            // Check wheather the given representative email is valid
            if(empty(trim($_POST["scl-cename"])))
            {
                $error = "Center Name cannot be empty";
            } else {
                $scl_cename = trim($_POST["scl-cename"]);
            }

            if ($error == ""){
                if (isset($_POST['ce-save'])) {
                    $sql = "CALL Update_school(?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "isi", $sclid, $sclname, $scltel);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./scl.php");
                        }
                        else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
            
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                } else if (isset($_POST['ce-add'])) {
                    $sql = "CALL Create_school(?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "sis", $sclname, $scltel, $scl_cename);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./scl.php");
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
?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="center">   
                    <?php
                        $sql = "SELECT s.SCHOOL_ID, s.SCHOOL_NAME, s.TEL_NUMBER, c.CENTER_NAME FROM school s, center c WHERE s.CENTER_ID = c.CENTER_ID ORDER BY s.SCHOOL_ID";

                        $query = mysqli_query($conn, $sql);  
                        if (mysqli_num_rows($query) > 0)
                        {
                            echo "<div  class=\"head\"><table>
                                    <th width= 10%>School ID</th>
                                    <th width= 35%>School Name</th>
                                    <th width= 20%>Tel Number</th>
                                    <th width= 35%>Center Name</th></table></div>";
                            echo "<div class=\"rslt-view\"><table>";
                                    while($row = mysqli_fetch_array($query))
                                    {
                                        echo "<tr>
                                        <td width= 10%>" .$row[0] ."</td>
                                        <td width= 35%>" .$row[1] ."</td>
                                        <td width= 20%>" .$row[2] ."</td>
                                        <td width= 35%>" .$row[3] ."</td>
                                        </tr>";
                                    }
                            echo "</table></div>";


                            
                            echo "<div class=\"edit-form\"><form id=\"center-edit\" action=\"";
                            echo htmlspecialchars($_SERVER["PHP_SELF"]);
                            echo "\" method=\"POST\">";
                            echo "<p id=\"error\" class=\"err\">" .$error ."</p>";
                            echo
                            "<table>
                            <tr>
                            <td class=\"plbl\">School ID</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"sclid\" id=\"sclid\" value=\"\" placeholder=\"\" readOnly=\"true\"></td>
                            </tr>
                            <tr>
                            <td class=\"plbl\">School Name</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"sclname\" id=\"sclname\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            <tr>
                            <td class=\"plbl\">Tel Number</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"scltel\" id=\"scltel\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            </tr>
                            <tr>
                            <td class=\"plbl\">Center Name</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"scl-cename\" id=\"scl-cename\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td id=\"eqcell\">
                            <button type=\"button\" onclick=\"edit()\" id=\"scl-edit\" class=\"btn\">edit</button>
                            <button type=\"button\" onclick=\"add_new()\" id=\"scl-add-new\" class=\"btn\">Add New</button>
                            <button type=\"button\" onclick=\"dlt()\" id=\"scl-dlt\" class=\"btn\">Delete</button>
                            <input id=\"scl-save\" name=\"ce-save\" class=\"btn hide\" type=\"submit\" value=\"Save\">
                            <input id=\"scl-add\" name=\"ce-add\" class=\"btn hide\" type=\"submit\" value=\"Add\">
                            <input id=\"scl-cfmdlt\" name=\"ce-cfmdlt\" class=\"btn hide\" type=\"submit\" value=\"Confirm Delete\">
                            <button type=\"button\" onclick=\"cancel()\" id=\"scl-cancel\" class=\"btn hide\">Cancel</button></td>
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
            </section>
        </section>
    </div>
    <!-- Body Sections ends  -->

    <script src="./js/scl.js"></script>
<?php
mysqli_close($conn);
include("./partials/footer.php"); 
?>

