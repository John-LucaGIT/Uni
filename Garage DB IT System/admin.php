<!DOCTYPE html>
<?php
      include_once("assets/php/connectdb.php");
      include_once("assets/php/functions.php");
      include_once('assets/php/includes.php');
      include_once('assets/php/header.php');

      $uinfo = findUserInfoEmail($conn,$_SESSION['email']);
      if($uinfo['role'] < 1){
            header("location:../?error=insufficient+permissions");
      }

      if($_SESSION["role"] == 4){
            if($_GET["page"] == "users"){
                  include_once('assets/php/frontend/users.php');
            }
            else if($_GET["page"] == "jobs"){
                  include_once("assets/php/frontend/jobs.php");
            }
            else if($_GET["page"] == "bookings"){
                  include_once("assets/php/frontend/bookings.php");
            }
            else if($_GET["page"] == "stockreport"){
                  include_once("assets/php/frontend/stockreport.php");
            }
            else if($_GET["page"] == "buyparts"){
                  include_once("assets/php/frontend/buyparts.php");
            }
            else if($_GET["page"] == "invoice"){
                  include_once("assets/php/frontend/invoice.php");
            }
            else{
                  include_once("assets/php/frontend/controlboard.php");
            }
      }
      else if($_SESSION["role"] < 4 && $_SESSION["role"] > 0){
            if($_GET["page"] == "jobs"){
                  include_once("assets/php/frontend/jobs.php");
            }
            else if($_GET["page"] == "bookings"){
                  include_once("assets/php/frontend/bookings.php");
            }
            else{
                  include_once("assets/php/frontend/controlboard.php");
            }
      }
      else if($_SESSION["role"] == 5){
            if($_GET["page"] == "users"){
                  include_once('assets/php/frontend/users.php');
            }
            else if($_GET["page"] == "database"){
                  include_once('assets/php/frontend/db.php');
            }
            else{
                  include_once("assets/php/frontend/controlboard.php");
            }
      }
      else{
            header("location:../?error=insufficient+permissions");
      }

      if($_SESSION["role"] == 1){
            if($_GET["page"] == "invoice"){
                  include_once("assets/php/frontend/invoice.php");
            }
      }else{
            header("location:../?error=insufficient+permissions");
      }

      include_once("assets/php/frontend/footer.php"); 
?>
