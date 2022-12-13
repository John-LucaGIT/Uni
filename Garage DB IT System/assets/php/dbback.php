<?php
session_start();
// Administration Page Users Backend
if(isset($_POST['dbpull'])){      
    if($_SESSION['role'] != 5){
        header("location: ../../admin.php?page=database&error=insufficient+permissions");
        exit();
    }

    require_once ('functions.php'); 
    
    createDBBackup();
}
else if(isset($_POST['dbpush'])){    

    if($_SESSION['role'] != 5){
        header("location: ../../admin.php?page=database&error=insufficient+permissions");
        exit();
    }

    $dir = $_POST['myfile'];
    echo "<h1> DIR: ".$dir."</h1>";

    if(empty($dir) || $dir == ""){
        header("location: ../../admin.php?page=database&error=no+file+selected");
        exit();
    }

    require_once ('connectdb.php');
    require_once ('functions.php'); 

    restoreDatabaseTables($conn,$dir);
}