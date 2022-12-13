<?php
    session_start();
        if(isset($_POST['submit'])){
            $userName = $_POST["username"];
            $password = $_POST["password"];

            require_once ('connectdb.php');
            require_once ('functions.php');

            if(emptyInputLogin($userName,$password) !== false){
                header("location: ../../login?error=emptyinput");
                exit();
            }

            loginUser($conn,$userName,$password);

        }
        else{
            header("location: ../../login?error=emptyinput");
            exit();
        }
