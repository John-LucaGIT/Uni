<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
      <head>
            <title>BTM - GARITS : Users</title>
      </head>

        <?php
            if($_SESSION['role'] < 5){
                $hide = "hiddenfields";
              }
        ?>

      <body>
            <!-- Page Title -->

            <div class="btm black-link pageTitle">
                  <a href="../admin.php">
                        <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                  </a>
                  <h2 class="btmTitle">User List</h2>
            </div>

            <!-- Error Messages -->

            <?php
                  $type = "warning";
                  if(isset($_GET['error'])){
                        switch($_GET['error']){
                              case "invalidEmail":
                                    $errorMsg = "Please enter a valid email address!";
                                    break;
                              case "emailTaken":
                                    $errorMsg = "This email is already in use";
                                    break;
                              case "stmtfailure":
                                    $type = "danger";
                                    $errorMsg = "Server issue. Please contact site administrator!";
                              case "emptyinput":
                                    $errorMsg = "Please enter a valid email address and a password!";
                                    break;
                              case "emptyinput role":
                                    $errorMsg = "Please select a role for the user!";
                                    break;
                              case "emptyinput customer":
                                    $errorMsg = "Please enter a valid email address for the customer!";
                                    break;
                              case "insufficient permissions":
                                    $type = "primary";
                                    $errorMsg = "You do not have sufficient permissions to view this page!";
                                    break;
                              case "database failure":
                                    $type = "danger";
                                    $errorMsg = "Database issue. Please contact site administrator!";
                                    break;
                              case "data failure":
                                    $type = "danger";
                                    $errorMsg = "The entered data does not fit the allowed criteria! Please validate your data and try again!";
                                    break;
                              case "no input discount":
                                    $errorMsg = "Please check that you have both a discount plan and a set percentage.";
                                    break;
                              case "delete associated":
                                    $errorMsg = "Please delete the users associated elements before deleting the user!";
                                    break;
                              default: 
                                    $errorMsg = "OOPS! Some problem.";
            
                      }
                  echo "
                  <div class='center alert alert-".$type."'>
                        <strong>Error:</strong> ".$errorMsg."
                  </div>
                  ";
                  }
                  if(isset($_GET['status'])){
                        switch($_GET['status']){
                              case "registered":
                                    $type = "success";
                                    $msg = "You have successfully created an account!";
                                    break;
                              case "registered customer":
                                    $type = "success";
                                    $msg = "You have successfully created a customer account!";
                                    break;
                              case "success updated":
                                    $type = "info";
                                    $msg = "You have successfully updated an account!";
                                    break;
                              case "success deleted":
                                    $msg = "You have successfully deleted an account!";
                                    break;
                              case "success veh added":
                                    $type = "success";
                                    $msg = "You have successfully added a vehicle!";
                                    break;
                              case "success veh deleted":
                                    $msg = "You have successfully deleted a vehicle!";
                                    break;
                              case "success db":
                                    $msg = "You have successfully downloaded a database backup!";
                                    break;
                              case "success discount created":
                                    $type = "success";
                                    $msg = "You have successfully created a discount plan for the customer!";
                                    break;
                        }
                        echo "
                        <div class='center alert alert-".$type."'>
                              <strong>Info:</strong> ".$msg."
                        </div>
                        ";
                  }
            ?>

            <!-- User Section -->

            <section class="userSection">
                  <div class="btm admin userlist btmcenter">

                        <!-- User Table -->

                        <table class="btmtable table table-responsive table-striped">
                              <thead class="thead-dark">
                                    <!-- Table Headers -->
                                    <tr>
                                          <th scope="col">#UID</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">E-Mail</th>
                                          <th scope="col">Role</th>
                                          <th scope="col">Action</th>

                                    </tr>
                              </thead>

                              <!-- Table Fields -->

                              <tbody>
                              <?php
                                          $uid = $_GET['sid'];
                                          $rid = $_GET['rid'];
                                          getVehicles($conn,$rid);
                                          getUsers($conn);
                           
                                          for($i = 0; $i < sizeof($users); $i++){
                                                $users[$i]['role'] = checkRole($users,$i);
                                                $users[$i]['notes'] = fillFields($users[$i]['notes'],1);
                                                $users[$i]['vehicles'] = getVehAmount($conn,$users[$i]['id']);            
                                    
                                                echo
                                                "<tr id='uniqueUser".$users[$i]['id']."'>
                                                      <th scope='row'>".$users[$i]['id']."</th>
                                                      <td>".$users[$i]['name_first']." ".$users[$i]['name_last']."</td>
                                                      <td>".$users[$i]['email']."</td>
                                                      <td>".$users[$i]['role']."</td>

                                                      <td>
                                                            <form action='assets/php/uback.php' method='POST'>
                                                                  <input type='id' class='hiddenfields' name='id' value='".$i."'>
                                                                  <input type='id' class='hiddenfields' name='realID' value='".$users[$i]['id']."'>
                                                                  <button type='submit' name='view' class='btn btn-sm btn-info'>View</button>
                                                                  <button type='submit' name='edit' class='btn btn-sm btn-warning'>Edit</button>
                                                                  <button type='submit' name='deleteuser' class='btn btn-sm btn-danger'>Delete</button>
                                                            </form>
                                                      </td>
                                                </tr>";
                                          }

                                    ?>
                              </tbody>
                        </table>

                        <!-- View User / Edit Dropdown -->

                        <button type="button"  onclick="addUser()" class="btmcenter block btn btn-success">Add User</button>

                        <?php
                              if($_GET['f'] == "edit"){
                                    include_once("assets/php/frontend/editUserInfo.php");
                              }
                              else if(isset($_GET['sid'])){
                                    include_once("assets/php/frontend/viewUserInfo.php");
                              }
                              if($_GET["action"] == "register") {
                                    include_once('assets/php/frontend/register.php');
                              }
                        ?>                   
                        
                  </div>
            </section>
      </body>
</html>
