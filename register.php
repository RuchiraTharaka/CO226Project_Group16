<?php include("./partials/menu.php"); ?>

    <!-- Body Sections begin  -->
    <div class="body">
        <section class="gradient">
            <section class="container">
                <div class="registration section" id="">
                    <h3>Register</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis hic accusamus vel asperiores. Quae, sed?lorem30</p>
                    <div class="registration-form">
                        <div class="form">
                            <table>
                                <tr>
                                    <td class="lbl"><label for="module">Select module</label></td>
                                    <td>
                                        <select class="inp" name="module" id="module">
                                            <option value="student">student</option>
                                            <option value="undergraduate">undergraduate</option>
                                            <option value="admin">admin</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lbl" ><label for="fname">first name</label></td>
                                    <td><input type="text" name="fname" id="fname" class="inp" placeholder="first name"></td>
                                </tr>
                                <tr>
                                    <td class="lbl" ><label for="lname">last name</label></td>
                                    <td><input type="text" name="lname" id="lname" class="inp" placeholder="last name"></td>
                                </tr>
                                <tr>
                                    <td class="lbl" ><label for="email">email</label></td>
                                    <td><input type="email" name="email" id="email" class="inp" placeholder="example@gmail.com"></td>
                                </tr>
                                <tr>
                                    <td class="lbl" ><label for="telno">TEL-number</label></td>
                                    <td><input type="text" name="telno" id="telno" class="inp" placeholder="0713000000"></td>
                                </tr>
                                <tr>
                                    <td for="password" class="lbl" >password</td>
                                    <td><input type="password" class="inp" id="password" name="password" placeholder="Enter password here"></td>
                                </tr>
                                <tr>
                                    <td for="re-password" class="lbl" >re-password</td>
                                    <td><input type="password" class="inp" id="re-password" name="re-password" placeholder="re-enter password here"></td>
                                </tr>
                            </table>
                            <table>
                            <tr>
                                <td class="msg">If you haven an account</td>
                            </tr>
                            <tr>
                                <td><a class="reg-link" href="./login.php">login here</a></td>
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

<?php include("./partials/footer.php"); ?>