<?php
// Administration Page Users Backend

if(isset($_POST['view'])){
      $uid = $_POST["id"];
      $rid = $_POST["realID"];
      header("location:../../admin.php?page=users&sid=".$uid."&rid=".$rid."");
}
else if(isset($_POST['edit'])){
      $uid = $_POST["id"];
      $rid = $_POST["realID"];
      header("location:../../admin.php?page=users&sid=".$uid."&rid=".$rid."&f=edit");
}
else if(isset($_POST['deleteuser'])){
      require_once ('connectdb.php');
      require_once ('functions.php'); 

      $uid = $_POST["realID"];
      deleteUser($conn,$uid);
}
else if(isset($_POST['submitData'])){
      $uid = $_POST["id"];
      $email = $_POST['usersChangeEmail'];
      $tel = $_POST['usersChangeTel'];
      $fax = $_POST['usersChangeFax'];
      $address = $_POST['usersChangeAddress'];
      $postCode = $_POST['usersChangePostCode'];
      $role = $_POST['userChangeRole'];
      $role2 = $_POST['userChangeAccountRole'];
      $notes = $_POST['userChangeNotes'];    
      $discount = $_POST['discountPlan'];
      $discountplanNum = $_POST['discountPlanNum'];

      require_once ('connectdb.php');
      require_once ('functions.php'); 

      echo "<h1>UID: ".$uid." DiscountPlan: ".$discount." DiscountNum: ".$discountplanNum."</h1>";

      if(invalidEmail($email) !== false){
            header("location: ../../admin.php?page=users&error=invalidEmail");
            exit();
      }
      if($role2 != "Choose..." && isset($role2)){
            $role = $role2;
      }
      if(isset($discount) && $discount != "Choose..." && isset($discountplanNum)){
            updateDiscount($conn,$uid,$discount,$discountplanNum);
      }


      $tel = fillFields($tel,0);
      $fax = fillFields($fax,0);
      $address = fillFields($address,1);
      $postCode = fillFields($postCode,1);
      $notes = fillFields($notes,1);

      updateUser($conn,$uid,$email,$tel,$fax,$address,$postCode,$role,$notes); 
}
else if(isset($_POST["addVeh"])){
      $rid =  $_POST["realID"];
      $vehMake = $_POST['createVehMake'];
      $vehModel = $_POST['createVehModel'];
      $vehReg = $_POST['createVehReg'];
      $vehSerial = $_POST['createVehSerial'];
      $vehChas = $_POST['createVehChasNum'];
      $vehColor = $_POST['createVehColor'];
      $MOT = $_POST['createMOTEXP'];

      require_once ('connectdb.php');
      require_once ('functions.php'); 

      createVehicle($conn,$rid,$vehMake,$vehModel,$vehReg,$vehSerial,$vehChas,$vehColor,$MOT);
}
else if(isset($_POST["delVeh"])){
      $vid = $_POST["vehID"];

      require_once ('connectdb.php');
      require_once ('functions.php'); 


      deleteVehicle($conn,$vid);
}
