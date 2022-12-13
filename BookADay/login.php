<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap4/css/bootstrap.css"> <!-- Using Bootstrap 4 -->
        <link rel="stylesheet" href="bookaday/style.css"> <!-- Original Stylesheet -->
        <link rel="stylesheet" href="bootstrap4/css/signin.css"> <!-- Bootstrap 4 Login CSS Template -->

        <script src="https://kit.fontawesome.com/2eeb0a3584.js" crossorigin="anonymous"></script> <!-- Fontawesome Icons -->
    </head>
    <section class = "loginMain">
      <body> 
      <?php
        include("bookaday/php/header.php");
      ?>

        <section class="login-section">  <!-- Using Bootstrap 4 to create Login -->
            <form class="form-signin" method="POST" action="bookaday/php/lback.php">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <p class="mb-3 black-link">Don't have an account yet? Register <a href="register">here</a>.</p>
                <?php 
                        if ($_GET["error"] == "emptyinput"){
                            echo "<p>fill in all fields!</p>";
                        }
                        else if ($_GET["error"] == "loginFailure"){
                            echo "<p>Username / Email does not match Password or Account does not exist!</p>";
                        }
                    ?>
                <div class="uname">
                    <label for="inputUsername" class="sr-only">Username</label>
                    <small id="usernameHelp" class="form-text text-muted">Enter your Username.</small>
                    <input type="username" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>
                </div>
                <div class="pword">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <small id="passwordHelp" class="form-text text-muted">Enter your Password.</small>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                </div>
                <br>
                <button class="btn btn-lg btn-primary btn-block" name = "submit" type="submit">Sign in</button>
            </form>
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