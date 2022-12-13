<?php 
  session_start();
?>
<section class = "NavBar"> <!-- Using Bootstrap 4 NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index">BookADay</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a id="navitem1" class="nav-item nav-link active" href="index">Home</a>
                <a id="navitem2" class="nav-item nav-link" href="about">About</a>
                <a id="navitem3" class="nav-item nav-link" href="contact">Contact</a>
                <?php 
                    if(isset($_SESSION["userName"])){
                        echo '
                        <a id="navitem4" class="nav-item nav-link" href="myaccount">My Account</a>
                        <a id="navitem5" class="nav-item nav-link" href="bookaday/php/logout">Logout</a>
                        ';
                    }
                ?>
            </div>
        </div>
    </nav>
</section>