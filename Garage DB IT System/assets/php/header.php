<?php 
  session_start();
?>
<section class = "NavBar"> <!-- Using Bootstrap 4 NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/btmlogo.png" width="30" height="30" alt="">
                Byte Me Software <!-- NavBar Brand Title -->
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav"> <!-- NavBar Items --> 
                <?php 
                    if($_SESSION["role"] > 0){ // Session Check, Private Pages
                        echo '
                            <a id="navitem1" class="nav-item nav-link active" href="admin.php">Home</a>
                        ';  
                    }
                    if(isset($_SESSION["email"])){ // Session Check, Private Pages
                        echo '
                        <a id="navitem2" class="nav-item nav-link" href="assets/php/loggout.php">Logout</a>
                        ';
                    }
                ?>
            </div>
        </div>
    </nav>
</section>