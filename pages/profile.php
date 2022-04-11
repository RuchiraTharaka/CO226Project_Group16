<?php
    include("./partials/menu.php");

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "Group16Project";
    $mail = $_SESSION["email"];
    $module = $_SESSION["module"];

    // Create the sql connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (!$conn)
    {
        header("Location: ./error.php");
        exit();
    }

    if ($module ==  "ADM")
    {
        $sql = "SELECT U.USERID, U.FIRSTNAME, U.LASTNAME, U.TEL_NUMBER, A.ENROLLMENT_NUMBER, A.DEPARTMENT FROM user U, administrator A WHERE U.EMAIL = A.EMAIL AND U.EMAIL = '" .$mail ."'";
    }
    else if ($module ==  "UGS")
    {
        $sql = "SELECT U.USERID, U.FIRSTNAME, U.LASTNAME, U.TEL_NUMBER, ug.UNI_REG_NO, ug.DEPARTMENT FROM user U, university_student ug WHERE U.EMAIL = ug.EMAIL AND U.EMAIL = '" .$mail ."'";
    }
    else
    {
        $sql = "SELECT U.USERID, U.FIRSTNAME, U.LASTNAME, U.TEL_NUMBER, S.BIRTHDAY, S.ADDRESS, S.GRADE, SC.SCHOOL_NAME FROM user U, student S, school SC WHERE U.EMAIL = S.EMAIL AND S.SCHOOL_ID = SC.SCHOOL_ID AND U.EMAIL = '" .$mail ."'";
    }

    $query = mysqli_query($conn, $sql);

    $row0 = mysqli_fetch_array($query);
    
?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="profile">
                    <div class="profile-pic">
                        <img class="pp" src="./images/pp.png" alt="">
                        <h4><?php echo $mail ?></h4>
                    </div>
                    <div class="details">
                        <table>
                            <tr>
                                <td class="plbl">USER ID</td>
                                <td class="plbl"> <?php echo $_SESSION["userid"] ?></td>
                            </tr>
                            <tr>
                                <td class="plbl">First Name</td>
                                <td><input type="text" class="pinp" value="<?php echo $row0[1] ?>"></td>
                            </tr>
                            <tr>
                                <td class="plbl">Last Name</td>
                                <td><input type="text" class="pinp" value="<?php echo $row0[2] ?>"></td>
                            </tr>
                            <tr>
                                <td class="plbl">Tel Number</td>
                                <td><input type="text" class="pinp" value="<?php echo $row0[3] ?>"></td>
                            </tr>

                            <?php
                            if ($module == "STD")
                            {
                                echo
                                "<tr>
                                <td class=\"plbl\">BIRTH DATE</td>
                                <td><input type=\"text\" class=\"pinp\" value=\"" .$row0[4] ."\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Address</td>
                                <td><input type=\"text\" class=\"pinp\" value=\"" .$row0[5] ."\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Grade</td>
                                <td><input type=\"text\" class=\"pinp\" value=\"" .$row0[6] ."\"></td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">School</td>
                                <td class=\"plbl\">" .$row0[7] ."</td>
                                </tr>";
                            }
                            else
                            {
                                echo 
                                "<tr>
                                <td class=\"plbl\">Enrol Number</td>
                                <td class=\"plbl\">" .$row0[4] ."</td>
                                </tr>
                                <tr>
                                <td class=\"plbl\">Department</td>
                                <td class=\"plbl\">" .$row0[5] ."</td>
                                </tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <!-- Body Sections ends  -->

<?php
include("./partials/footer.php"); 
mysqli_close($conn);
?>
<script src="./js/script.js"></script>

