<?php
session_start();
if(isset($_POST['submit'])){
      $email = $_POST["email"];
      $password = $_POST["password"];

      require_once ('connectdb.php');
      require_once ('functions.php');

      $uinfo = findUserInfoEmail($conn,$email);

      if(emptyInputSignup($email,$password) !== false){
            header("location: ../../?error=emptyinput");
            exit();
      }

      // Check email
      if(invalidEmail($email) !== false){
            header("location: ../../?error=invalidEmail");
            exit();
      }

      if($uinfo['role'] >= 1){
            loginUser($conn,$email,$password);     
      }else{
            header("location: ../../?error=insufficient+permissions");
      }

}
else{
      header("location: ../../?error=emptyinput");
      exit();
}