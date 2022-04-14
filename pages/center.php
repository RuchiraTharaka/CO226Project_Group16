<?php
    include("./partials/menu.php");

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "Group16Project";
    $email = $userid = "";
    $error = "";
    $ceid = $cename = $ceaddr = $cetel = $cerep = "";
    $param_cerep = "";

    // Create the sql connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (!$conn)
    {
        header("Location: ./error.php");
        exit();
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $ceid = trim($_POST["ceid"]);

        if (isset($_POST['ce-cfmdlt'])) {
            // Prepare a select statement
            $sql = "CALL Remove_center(?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $ceid);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    header("Location: ./center.php");
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
            if(empty(trim($_POST["cename"])))
            {
                $error = "Center Name cannot be empty";
            } else {
                $cename = trim($_POST["cename"]);
            }
    
            // check whether Center address field is empty
            if(empty(trim($_POST["ceaddr"])))
            {
                $error = "Center Address cannot be empty";
            } else {
                $ceaddr = trim($_POST["ceaddr"]);
            }
    
            // // Check wheather center telephone number is empty and valid
            if(empty(trim($_POST["cetel"]))) {
                $error = "Fields cannot be empty";
            } elseif(is_numeric(trim($_POST["cetel"])) && strlen(trim($_POST["cetel"])) == 9){
                $cetel = trim($_POST["cetel"]);
            }
            else {
                $error = "Invalid phone number";
            }
    
            // Check wheather the given representative email is valid
            if(empty(trim($_POST["cerep"])))
            {
                $error = "Representative email cannot be empty";
            } else {
                // Prepare a select statement
                $sql = "SELECT EMAIL FROM USER WHERE EMAIL = ?";
                
                if($stmt = mysqli_prepare($conn, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_cerep);
                    
                    // Set parameters
                    $param_cerep = trim($_POST["cerep"]);
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $cerep = trim($_POST["cerep"]);
                        } else{
                            $error = "No Undergraduate with this email. Please check again.";
                        }
                    } else{
                        $error =  "Oops! Something went wrong. Please try again later.";
                    }
    
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            if ($error == ""){
                if (isset($_POST['ce-save'])) {
                    $sql = "CALL Update_center(?, ?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "issss", $ceid, $cename, $ceaddr, $cetel, $cerep);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./center.php");
                        }
                        else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
            
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                } else if (isset($_POST['ce-add'])) {
                    $sql = "CALL Create_center(?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "ssss", $cename, $ceaddr, $cetel, $cerep);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./center.php");
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
                        $sql = "SELECT * FROM center";

                        $query = mysqli_query($conn, $sql);  
                        if (mysqli_num_rows($query) > 0)
                        {
                            echo "<div  class=\"head\"><table>
                                    <th width= 10%>Center ID</th>
                                    <th width= 20%>Center Name</th>
                                    <th width= 30%>Address</th>
                                    <th width= 20%>Tel Number</th>
                                    <th width= 20%>Representative</th></table></div>";
                            echo "<div class=\"rslt-view\"><table>";
                                    while($row = mysqli_fetch_array($query))
                                    {
                                        echo "<tr>
                                        <td width= 10%>" .$row[0] ."</td>
                                        <td width= 20%>" .$row[1] ."</td>
                                        <td width= 30%>" .$row[2] ."</td>
                                        <td width= 20%>" .$row[3] ."</td>
                                        <td width= 20%>" .$row[4] ."</td>
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
                            <td class=\"plbl\">Center ID</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"ceid\" id=\"ceid\" value=\"\" placeholder=\"\" readOnly=\"true\"></td>
                            </tr>
                            <tr>
                            <td class=\"plbl\">Center Name</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"cename\" id=\"cename\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            <tr>
                            <td class=\"plbl\">Address</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"ceaddr\" id=\"ceaddr\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            <tr>
                            <td class=\"plbl\">Tel Number</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"cetel\" id=\"cetel\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            </tr>
                            <tr>
                            <td class=\"plbl\">Representative</td>
                            <td><input type=\"text\" class=\"pinp\" name=\"cerep\" id=\"cerep\" value=\"\" placeholder=\"\" readonly=\"readonly\"></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td id=\"eqcell\">
                            <button type=\"button\" onclick=\"edit()\" id=\"ce-edit\" class=\"btn\">edit</button>
                            <button type=\"button\" onclick=\"add_new()\" id=\"ce-add-new\" class=\"btn\">Add New</button>
                            <button type=\"button\" onclick=\"dlt()\" id=\"ce-dlt\" class=\"btn\">Delete</button>
                            <input id=\"ce-save\" name=\"ce-save\" class=\"btn hide\" type=\"submit\" value=\"Save\">
                            <input id=\"ce-add\" name=\"ce-add\" class=\"btn hide\" type=\"submit\" value=\"Add\">
                            <input id=\"ce-cfmdlt\" name=\"ce-cfmdlt\" class=\"btn hide\" type=\"submit\" value=\"Confirm Delete\">
                            <button type=\"button\" onclick=\"cancel()\" id=\"ce-cancel\" class=\"btn hide\">Cancel</button></td>
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

    <script src="./js/center.js"></script>
<?php
mysqli_close($conn);
include("./partials/footer.php"); 
?>

