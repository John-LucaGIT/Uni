<?php
if(isset($_POST['submit'])){
    if(!empty($_POST["email"])){
        $email = $_POST["email"];
    }
    if(!empty($_POST["id"])){
        $id = $_POST["id"];
    }else{
        $id = $email;
    }
    
    if($id == "" && $email == ""){
        $id = 1;
    }
    
    $jobID = $_POST["jobID"];
    $partsCode = $_POST["partsCode"];
    $quant = $_POST["quantity"];

    require_once ('connectdb.php');
    require_once ('functions.php');

    echo "<h1>Err 1: ".$_COOKIE["stmterror"]."</h1>";
    echo "<h1>Err 2: ".$_COOKIE["stmterror2"]."</h1>";
    print($_COOKIE["mysqlerr"]);

    if(isset($email) && $email != ""){
        if(invalidEmail($email) !== false){
            header("location: ../../admin.php?page=buyparts&error=invalid+email");
            exit();
        }
    }
    echo"<h1>Test1</h1>";


    if(empty($partsCode) || empty($quant)){
        header("location: ../../admin.php?page=buyparts&error=no+input");
        exit();
    }
    echo"<h1>Test1</h1>";


    if(isset($jobID) && $jobID != ""){
        orderPartJob($conn,$id,$jobID,$partsCode,$quant);
        echo"<h1>Test2</h1>";

    }else{
        echo"<h1>Test3</h1>";
        echo"<h1 ID: >".$id." partsCode: ".$partsCode." Quantity: ".$quant."</h1>";

        orderPart($conn,$id,$partsCode,$quant);
    }
}

