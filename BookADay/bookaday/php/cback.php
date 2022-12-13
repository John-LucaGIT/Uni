<?php
    if(isset($_POST['submit'])){
        $name_first = $_POST['name_first'];
        $name_last = $_POST['name_last'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        require_once ('connectdb.php');
        require_once ('functions.php');
        

        if(emptyInputContact($name_last,$name_first,$email,$title,$date,$time) !== false){
            header("location: ../../contact?error=emptyinput");
            exit();
        }

        if(invalidEmail($email) !== false){
            header("location: ../../contact?error=invalidEmail");
            exit();
        }

        createContact($conn,$name_last,$name_first,$email,$title,$date,$time);

    }
    else{
        header("location: ../../contact?error=emptyinput");
        exit();
    }
?>

                
