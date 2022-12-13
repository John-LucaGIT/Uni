<?php

// Booking Page Backend

if(isset($_POST["createBooking"])){
      if(!empty($_POST["bookingTypeOther"]) && ($_POST["bookingTypeOther"]) != ""){
            $bookingType = $_POST['bookingTypeOther'];
      }else{
            $bookingType = $_POST['bookingType'];
      }
      $bookingDate = $_POST['bookingDate'];
      $vehID = $_POST['vehID'];
      $bookingID = $_POST['bid'];

      require_once ('connectdb.php');
      require_once ('functions.php'); 

      allVehIDs($conn);

      for($i = 0; $i <= sizeof($vehIDs); $i++){
            if($vehID == $vehIDs[$i]['vehID']){
                  $vehExists = true;
                  break;
            }else{
                  $vehExists = false;
            }
      }
      if(!$vehExists){
            header("location:../../admin.php?page=bookings&error=no+veh");
      }
      else{
            if(!empty($bookingDate) && !empty($vehID) && !empty($bookingType)){
                  echo "<h1>Test 2</h1>";
                  if(empty($bookingID) || $bookingID == ""){
                        createBooking($conn,$vehID,$bookingType,$bookingDate);
                  }else if(isset($bookingID)){
                        changeBooking($conn,$bookingID,$vehID,$bookingType,$bookingDate);
                  }
            }
            else{
                  header("location:../../admin.php?page=bookings&error=no+input");
            }
      }
}

else if(isset($_POST["bookingwjob"])){
      $dow = $_POST["dow"];
      $et = $_POST["et"];
      $mechanicID = $_POST["mechanicID"];
      $completed = $_POST["isCompleted"];
      $bookingID = $_POST["bid"];
      $vehBay = $_POST["vehicleBay"];

      require_once ('connectdb.php');
      require_once ('functions.php'); 

      if($completed == "true"){
            createJobCompleted($conn,$bookingID,$dow,$et,$vehBay,$mechanicID);
      }else{
            createJob($conn,$bookingID,$dow,$et,$vehBay,$mechanicID);
      }
}
else if(isset($_POST['modify'])){
      $sid = $_POST["sid"];
      $bid = $_POST["bookingID"];
      header("location:../../admin.php?page=bookings&sid=".$sid."&bid=".$bid."&f=modify");
}
else if(isset($_POST['deleteBooking'])){
      $bid = $_POST["bookingID"];

      require_once ('connectdb.php');
      require_once ('functions.php'); 
      
      deleteBooking($conn,$bid);
}
