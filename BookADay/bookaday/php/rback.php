<?php
    if(isset($_POST["submit"])){
        $name_first = $_POST['name_first'];
        $name_last = $_POST['name_last'];
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['passwordconfirm'];
        
        if(isset($_POST['newsletter'])){
            $newsletter = 1;
        }
        else{
            $newsletter = 0;
        }

        require_once ('connectdb.php');
        require_once ('functions.php');


        if(emptyInputSignup($name_first,$name_last,$userName,$email,$phone,$password,$cpassword) !== false){
            header("location: ../../register?error=emptyinput");
            exit();
        }
        if(invalidUname($userName) !== false){
            header("location: ../../register?error=invalidUserName");
            exit();
        }
        if(invalidEmail($email) !== false){
            header("location: ../../register?error=invalidEmail");
            exit();
        }
        if(pwdMatch($password,$cpassword) !== false){
            header("location: ../../register?error=pwdMatch");
            exit();
        }
        if(unameDupp($conn,$userName,$email) !== false){
            header("location: ../../register?error=unameTaken");
            exit();
        }

        createUser($conn,$name_last,$name_first,$userName,$email,$password,$phone,$newsletter);
        
    }
    else{
        header("location: ../../register");
        exit();
    }
