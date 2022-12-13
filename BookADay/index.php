<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap4/css/bootstrap.css"> <!-- Using Bootstrap 4 -->
        <link rel="stylesheet" href="bookaday/style.css"> <!-- Original Stylesheet -->
        <script src="https://kit.fontawesome.com/2eeb0a3584.js" crossorigin="anonymous"></script> <!-- Fontawesome Icons -->
    </head>
    <section class = "indexMain">
      <body> 
        <?php
        include_once("bookaday/php/header.php");
        ?>
        
        <section class = "imageCarousel-main"> <!-- Using Bootstrap 4 imageCarousel -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/slide1.jpg" class="d-block w-100" alt="Hero image 1/3 showing California highway by a beach at sunset">  <!-- Image from https://wallpaperaccess.com/california-coast -->
                  <div class="carousel-caption d-none d-md-block">
                    <h1>BookADay</h1>
                    <p>Spend a day exploring all California has to offer!</p>
                    <?php 
                      if(isset($_SESSION["userName"])){
                        echo '<h3>Hello '.$_SESSION["userName"].'!</h3>';
                      }
                      else{
                        echo 
                        '<a href="login" class="btn btn-info">Login</a>
                        <a href="register" class="btn btn-warning">Register</a>'; 
                      }
                    ?>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="images/slide2.jpg" class="d-block w-100" alt="Hero image 2/3 showing California Lake Tahoe."> <!-- Image from https://www.istockphoto.com/de/foto/see-lake-tahoe-gm480641071-36497954?irgwc=1&cid=IS&utm_medium=affiliate&utm_source=TinEye&clickid=xRB1nnRUNxyLWXt0WlXSvXJOUkEXOjSjBXyHV00&utm_content=435504&irpid=77643-->
                  <div class="carousel-caption d-none d-md-block">
                    <h1>BookADay</h1>
                    <p>Select one of our trip pacakages from a day in Lake Tahoe to exploring night life in Malibu!</p>
                    <?php 
                      if(isset($_SESSION["userName"])){
                        echo '<h3>Hello '.$_SESSION["userName"].'!</h3>';
                      }
                      else{
                        echo 
                        '<a href="login" class="btn btn-info">Login</a>
                        <a href="register" class="btn btn-warning">Register</a>'; 
                      }
                    ?>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="images/slide3.jpg" class="d-block w-100" alt="Hero image 3/3 showing Golden Gate Bridge"> <!-- Image from https://www.pixel4k.com/golden-gate-bridge-morning-91472 -->
                  <div class="carousel-caption d-none d-md-block">
                    <h1>BookADay</h1>
                    <p>Explore our Family value packages for a great deal!</p>
                    <?php 
                      if(isset($_SESSION["userName"])){
                        echo '<h3>Hello '.$_SESSION["userName"].'!</h3>';
                      }
                      else{
                        echo 
                        '<a href="login" class="btn btn-info">Login</a>
                        <a href="register" class="btn btn-warning">Register</a>'; 
                      }
                    ?>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> 
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> 
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </section>

        <?php
        include_once("bookaday/php/footer.php");
        ?>

    </section>
        <!-- Including necessary scripts for bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tether@2.0.0-beta.5/js/tether.min.js"></script>
        <script src="bootstrap4/js/bootstrap.min.js"></script>
        <script src="bootstrap4/js/bootstrap.js"></script>
        <!-- My Validation Script -->
        <script src="bookaday/js/validate.js"></script>         
        <script>
          headerCurrent("index");
        </script>
  </body>
</html>