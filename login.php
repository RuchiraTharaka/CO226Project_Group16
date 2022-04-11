<?php

include("./partials/menu.php");

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./pages/home.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT EMAIL, USERID, USER_MODUlE, PASSWORD FROM USER WHERE EMAIL = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $email, $userid, $module, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(!is_null($userid))
                        {
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["email"] = $email;
                                $_SESSION["userid"] = $userid;
                                $_SESSION["module"] = $module;
                                
                                // Redirect user to welcome page
                                header("location: ./pages/home.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid email or password.";
                            }
                        }
                        else{
                            $login_err = "Your account not verified yet. please contact an admin.";
                        }
                    }
                } else{
                    // email doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="login section" id="">
                    <h3>login</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis hic accusamus vel asperiores. Quae, sed?lorem30</p>
                    <div class="login-form">
                        <div class="form">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <table>
                                    <tr>
                                        <td class="lbl" >email</td>
                                    </tr>
                                    <tr>
                                        <td><input type="email" name="email" id="email" class="inp simple" placeholder="example@gmail.com"></td>
                                    </tr>
                                    <tr>
                                        <td for="password" class="lbl" >password</td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" class="inp" id="password" name="password" placeholder="Enter password here"></td>
                                    </tr>
                                    <tr>
                                        <td class="btn"><input type="submit" value="login"></td>
                                    </tr>
                                    <tr>
                                        <td><span class="lbl invalid"><?php echo $login_err; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="msg">If you haven't an account</td>
                                    </tr>
                                    <tr>
                                        <td><a class="reg-link" href="./register.php">register here</a></td>
                                    </tr>
                                </table>
                            </form>
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

<?php include("./partials/footer.php"); ?>
<script src="./js/script.js"></script>

