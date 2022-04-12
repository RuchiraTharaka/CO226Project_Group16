<?php
    include("./partials/menu.php");

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "Group16Project";
    $email = $_SESSION["email"];
    $module = $_SESSION["module"];

    $error = "";
    $fname = $lname = $tel = "";
    $bod = $addr = $grade = "";

    // Create the sql connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (!$conn)
    {
        header("Location: ./error.php");
        exit();
    }

    if ($module ==  "ADM")
    {
        $sql = "SELECT U.USERID, U.FIRSTNAME, U.LASTNAME, U.TEL_NUMBER, A.ENROLLMENT_NUMBER, A.DEPARTMENT FROM user U, administrator A WHERE U.EMAIL = A.EMAIL AND U.EMAIL = '" .$email ."'";
    }
    else if ($module ==  "UGS")
    {
        $sql = "SELECT U.USERID, U.FIRSTNAME, U.LASTNAME, U.TEL_NUMBER, ug.UNI_REG_NO, ug.DEPARTMENT FROM user U, university_student ug WHERE U.EMAIL = ug.EMAIL AND U.EMAIL = '" .$email ."'";
    }
    else
    {
        $sql = "SELECT U.USERID, U.FIRSTNAME, U.LASTNAME, U.TEL_NUMBER, S.BIRTHDAY, S.ADDRESS, S.GRADE, SC.SCHOOL_NAME FROM user U, student S, school SC WHERE U.EMAIL = S.EMAIL AND S.SCHOOL_ID = SC.SCHOOL_ID AND U.EMAIL = '" .$email ."'";
    }

    $query = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($query);

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["fname"])) || empty(trim($_POST["lname"])) || empty(trim($_POST["tel"]))){
            $error = "Unable update profile. Feilds cannot be empty!";
        }
        else{
            if(is_numeric(trim($_POST["tel"])) && strlen(trim($_POST["tel"])) == 9){
                if($module == "STD") {
                    if(empty(trim($_POST["bod"])) || empty(trim($_POST["addr"])) || empty(trim($_POST["grade"]))){
                        $error = "Unable update profile. Feilds cannot be empty!";
                    }
                    else{
                        $sql = "CALL Update_STD(?, ?, ?, ?, ?, ?)";
                        if($stmt = mysqli_prepare($conn, $sql)){
                            // Bind variables to the prepared statement as parameters
                            // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                            mysqli_stmt_bind_param($stmt, "sssisi", $email, $fname, $lname, $tel, $addr, $grade);
                            
                            // Set parameters
                            $fname = trim($_POST["fname"]);
                            $lname = trim($_POST["lname"]);
                            $tel = trim($_POST["tel"]);
                            $addr = trim($_POST["addr"]);
                            $grade = trim($_POST["grade"]);
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                header("Location: ./profile.php");
                            }
                            else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                
                            // Close statement
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
                else{
                    $sql = "CALL Update_ADM_UGS(?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // mysqli_stmt_bind_param($stmt, "ssssis", $param_email, $fname, $lname, $module, $tel, $param_password);
                        mysqli_stmt_bind_param($stmt, "sssi", $email, $fname, $lname, $tel);
                        
                        // Set parameters
                        $fname = trim($_POST["fname"]);
                        $lname = trim($_POST["lname"]);
                        $tel = trim($_POST["tel"]);
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            header("Location: ./profile.php");
                        }
                        else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
            
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }
            }
            else {
                $error = "Unable update profile. Invalid Tele-Phone number!";
            }
        }
    }
    
?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="profile">
                    <div class="profile-pic">
                        <img class="pp" src="./images/pp.png" alt="">   
                        <h4><?php echo $email ?></h4>
                    </div>
                    <div class="details">

                        <!-- start profile view section -->
                        <table id="view">
                            <tr>
                                <td class="plbl">USER ID</td>
                                <td class="pinplbl"> <?php echo $_SESSION["userid"] ?></td>
                            </tr>
                            <tr>
                                <td class="plbl">Name</td>
                                <td class="pinplbl"><?php echo $row[1] ." " .$row[2]?></td>
                            </tr>
                            <tr>
                                <td class="plbl">Tel Number</td>
                                <td class="pinplbl"><?php echo $row[3] ?></td>
                            </tr>

                            <?php
                            if ($module == "STD")
                            {
                                echo
                                "<tr>
                                <td class=\"plbl\">Birth Day</td>
                                <td class=\"pinplbl\">" .$row[4] ."</td>
                                </tr>
                                <tr>                                                                                            
                                <td class=\"plbl\">Address</td>
                                <td class=\"pinplbl\">" .$row[5] ."</td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Grade</td>
                                <td class=\"pinplbl\">" .$row[6] ."</td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">School</td>
                                <td class=\"pinplbl\">" .$row[7] ."</td>
                                </tr>";
                            }
                            else
                            {
                                echo 
                                "<tr>
                                <td class=\"plbl\">Enrol Number</td>
                                <td class=\"pinplbl\">" .$row[4] ."</td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Department</td>
                                <td class=\"pinplbl\">" .$row[5] ."</td>
                                </tr>";
                            }
                        ?>
                            <tr>
                                <td></td>
                                <td>
                                    <p class="err"><?php echo $error?></p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button onclick="show_edit()" class="btn">edit</button></td>
                            </tr>
                        </table>
                        <!-- ends profile view section -->
                        
                        <!-- start edit form section -->
                        <form id="edit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <table>
                                <tr>
                                    <td class="plbl">USER ID</td>
                                    <td class="plbl"> <?php echo $_SESSION["userid"] ?></td>
                                </tr>
                                <tr>
                                    <td class="plbl">First Name</td>
                                    <td><input type="text" class="pinp" name="fname" id="fname" value="<?php echo $row[1] ?>"></td>
                                </tr>
                                <tr>
                                    <td class="plbl">Last Name</td>
                                    <td><input type="text" class="pinp" name="lname" id="lname" value="<?php echo $row[2] ?>"></td>
                                </tr>
                                <tr>
                                    <td class="plbl">Tel Number</td>
                                    <td><input type="text" class="pinp" name="tel" id="tel" value="<?php echo $row[3] ?>"></td>
                                </tr>

                                <?php
                                if ($module == "STD")
                                {
                                    echo
                                    "<tr>
                                    <td class=\"plbl\">Birth Day</td>
                                    <td><input type=\"text\" class=\"pinp\" name=\"bod\" id=\"bod\" value=\"" .$row[4] ."\"></td>
                                    </tr>
                                    <tr>
                                    <td class=\"plbl\">Address</td>
                                    <td><input type=\"text\" class=\"pinp\" name=\"addr\" id=\"addr\" value=\"" .$row[5] ."\"></td>
                                    </tr>
                                    <tr>
                                    <td class=\"plbl\">Grade</td>
                                    <td><input type=\"text\" class=\"pinp\" name=\"grade\" id=\"grade\" value=\"" .$row[6] ."\"></td>
                                    </tr>
                                    <tr>
                                    <td class=\"plbl\">School</td>
                                    <td class=\"plbl\">" .$row[7] ."</td>
                                    </tr>";
                                }
                                else
                                {
                                    echo 
                                    "<tr>
                                    <td class=\"plbl\">Enrol Number</td>
                                    <td class=\"plbl\">" .$row[4] ."</td>
                                    </tr>
                                    <tr>
                                    <td class=\"plbl\">Department</td>
                                    <td class=\"plbl\">" .$row[5] ."</td>
                                    </tr>";
                                }
                                ?>
                            </table>
                            <table>
                                <tr>
                                    <td><input class="btn" type="submit" value="save">
                                    <button onclick="hide_edit()" class="btn">Cancel</button></td>
                                </tr>
                            </table>
                        </form>
                        <!-- ends edit form section -->
                    </div>
                </div>
            </section>
        </section>
    </div>
    <!-- Body Sections ends  -->

<script src="./js/profile.js"></script>
<?php
mysqli_close($conn);
include("./partials/footer.php"); 
?>

