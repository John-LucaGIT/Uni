<?php
// Administration Page Invoice Backend
if(isset($_POST['viewInvoice'])){
    $sid = $_POST["sid"];
    $iid = $_POST["iid"];
    header("location:../../admin.php?page=invoice&sid=".$sid."&iid=".$iid."");
}else if(isset($_POST['isPaid'])){
    $sid = $_POST["sid"];
    $iid = $_POST["iid"];

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    payInvoice($conn,$iid);
}else if(isset($_POST['deleteinvoice'])){
    $iid = $_POST["iid"];
    echo "<h1>IID: ".$iid."</h1>";

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    deleteInvoice($conn,$iid);
}

