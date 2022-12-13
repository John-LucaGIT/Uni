<?php
// Administration Page Users Backend

if(isset($_POST['jobs'])){
    $uid = $_POST["sid"];
    $jid = $_POST["jid"];
    header("location:../../admin.php?page=jobs&sid=".$uid."&jid=".$jid."");
}
else if(isset($_POST["editJob"])){
    $jobID = $_POST["jid"];
    $dow = $_POST["dow"];
    $et = $_POST["et"];
    $mechanicID = $_POST["mechanicID"];
    $completed = $_POST["isCompleted"];
    $bookingID = $_POST["bid"];
    $vehBay = $_POST["vehicleBay"];

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    editJob($conn,$jobID,$dow,$et,$vehBay,$mechanicID,$completed);
}
else if(isset($_POST["setCompleted"])){
    $jobID = $_POST["jid"];

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    setJobCompleted($conn,$jobID);
}
else if(isset($_POST["assignMechanic"])){

    $mid = $_POST["assignMechanic"];
    $jid = $_POST["jid"];

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    echo "<h1>MID: ".$mid."JID: ".$jid."</h1>";

    assignMechanic($conn,$jid,$mid);
}

if(isset($_POST["createInvoice"])){
    $jobID = $_POST["jid"];

    require_once ('connectdb.php');
    require_once ('functions.php'); 
    $sum = 0;
    findOrderNo($conn,$jobID);
    print_r($orderNums);
    if($orderNums == 0){
        createJobInvoice($conn,$jobID,$sum);
    }else{
        for($i = 0; $i < sizeof($orderNums); $i++){
            $query[$i] = findPOP($conn,$orderNums[$i]['orderNum']);
            $prices[$i] = calculateTotalPartsPrice($conn,$query[$i]["orderNum"]);
        }
        foreach($prices as $e){
            $sum += $e;
        }  
        createJobInvoice($conn,$jobID,$sum);
    }
}

if(isset($_POST["deletejob"])){
    $jobID = $_POST["jid"];

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    deleteJob($conn,$jobID);
}

