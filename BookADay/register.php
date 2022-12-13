<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap4/css/bootstrap.css"> <!-- Using Bootstrap 4 -->
        <link rel="stylesheet" href="bookaday/style.css"> <!-- Original Stylesheet -->
        <script src="https://kit.fontawesome.com/2eeb0a3584.js" crossorigin="anonymous"></script> <!-- Fontawesome Icons -->
    </head>
    <section class = "registerMain">
        <body> 
            <?php
            include("bookaday/php/header.php");
            ?>

            <section class="registration">
                <div class="card registration-form">
                    <div class="card-body">
                    <h4 class="mb-3 black-link">Registration Form</h4>
                    <p class="mb-3 black-link">Already registered? Login <a href="login">here</a>.</p>
                    <?php 
                        if ($_GET["error"] == "emptyinput"){
                            echo "<p>fill in all fields!</p>";
                        }
                        else if ($_GET["error"] == "invalidUserName"){
                            echo "<p>Choose a valid username!</p>";
                        }
                        else if ($_GET["error"] == "invalidEmail"){
                            echo "<p>Choose a valid email address!</p>";
                        }
                        else if ($_GET["error"] == "pwdMatch"){
                            echo "<p>Passwords do not match!</p>";
                        }
                        else if ($_GET["error"] == "unameTaken"){
                            echo "<p>Username is taken!</p>";
                        }
                        else if ($_GET["error"] == "stmtfailure"){
                            echo "<p>Something went wrong!</p>";
                        }
                        else if ($_GET["error"] == "none"){
                            echo "<p>You have successfully signed up!</p>";
                        }
                    ?>
                        <form class = "needs-validation" method="POST" action="bookaday/php/rback.php">
                            <div class="form-group">
                                <label for="name_first">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="name_first" placeholder="John" value="" required>
                                <small id="nameHelp" class="form-text text-muted">Enter your first name.</small>
                                <div class="invalid-feedback">
                                  Valid first name is required.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_last">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Doe" name="name_last" value="" required>
                                <small id="lastnameHelp" class="form-text text-muted">Enter your last name.</small>
                                <div class="invalid-feedback">
                                  Valid last name is required.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername">Username</label>
                                <input type="username" class="form-control" id="exampleInputUsername" name="username" aria-describedby="usernameHelp" placeholder="JohnDoe28" required>
                                <small id="usernameHelp" class="form-text text-muted">Enter a unique username.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="johndoe@provider.com" required>
                                <small id="emailHelp" class="form-text text-muted">Please enter a valid email address.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPhone">Phone Number</label>
                                <input type="number" class="form-control" id="exampleInputPhone" name="phone" aria-describedby="phoneHelp" placeholder="12345678910" required>
                                <small id="phoneHelp" class="form-text text-muted">Please enter your phone number, digits only.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
                                <small id="passwordHelp" class="form-text text-muted">Enter a unique password at least 6 characters long, must contain upper- and lower-case letters, numbers and at least one symbol.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2">Confirm Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" name="passwordconfirm" placeholder="Repeat Password" required>
                                <small id="passwordHelp" class="form-text text-muted">Please repeat your above entered password.</small>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="newsletter">
                                <label class="form-check-label" for="exampleCheck1">Subscribe to our Newsletter</label><br><br>
                            </div>
                            <button type="submit" name = "submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </section>

            <?php
            include("bookaday/php/footer.php");
            ?>
    </section>
            <!-- Including necessary scripts for bootstrap -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/tether@2.0.0-beta.5/js/tether.min.js"></script>
            <script src="bootstrap4/js/bootstrap.min.js"></script>
            <script src="bootstrap4/js/bootstrap.js"></script>
        </body>
</html>