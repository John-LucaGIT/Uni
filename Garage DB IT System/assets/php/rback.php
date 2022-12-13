 <?php

    // Registration Page Backend

    if(isset($_POST["submit"])){
        $name_first = $_POST['name_first'];
        $name_last = $_POST['name_last'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tel = $_POST['tel'];
        $fax = $_POST['fax'];
        $address = $_POST['address'];
        $postcode = $_POST['postcode'];  
        $role = $_POST['userChangeRole'];   
    
        require_once ('connectdb.php');
        require_once ('functions.php');

        $name_last = fillFields($name_last,1);
        $name_first = fillFields($name_first,1);
        $tel = fillFields($tel,0);
        $fax = fillFields($fax,0);
        $address = fillFields($address,1);
        $postcode = fillFields($postcode,1);
        
        if($_SESSION['role'] == 5){
            if($role == "Choose..."){
                header("location: ../../admin.php?page=users&error=emptyinput+role");
                exit();
            }
        }else if($_SESSION['role'] < 5){
            if($role < 1 || empty($role)){
                $role = 0;
            }
        }

        if(invalidEmail($email) !== false){
            header("location: ../../admin.php?page=users&error=invalidEmail");
            exit();
        }
        if(unameDupp($conn,$email) !== false){
            header("location: ../../admin.php?page=users&error=emailTaken");
            exit();
        }

        if($role > 0 && $role != "Choose..."){
            if(emptyInputSignup($email,$password) !== false){
                header("location: ../../admin.php?page=users&error=emptyinput");
                exit();
            }
            createUser($conn,$name_last,$name_first,$email,$password,$tel,$fax,$address,$postcode,$role);
        }else{
            $password = "norpe";
            if(emptyInputSignup($email,$password) !== false){
                header("location: ../../admin.php?page=users&error=emptyinput+customer");
                exit();
            }
            createCustomer($conn,$name_last,$name_first,$email,$tel,$fax,$address,$postcode);
        }

    }
    else{
        header("location: ../../admin.php?page=users&error=sometingwong");
        exit();
    }
