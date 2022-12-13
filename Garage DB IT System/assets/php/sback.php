
<?php
ob_start(); 
if(isset($_POST["submitData"])){

	$firstDate = $_POST["FirstDate"];
	$endDate = $_POST["EndDate"];

      	header("location:../../admin.php?page=stockReport&FirstDate=".$firstDate."&EndDate=".$endDate."");
	
}

if(isset($_POST["printReport"])){

	$firstDate = $_POST["FirstDate"];
	$endDate = $_POST["EndDate"];


      	header("location:../../admin.php?page=printReport&FirstDate=".$firstDate."&EndDate=".$endDate."");
	
}
