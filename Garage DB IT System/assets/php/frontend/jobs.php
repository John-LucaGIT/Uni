<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
      <head>
            <title>BTM - GARITS : Jobs</title>
      </head>

      <body>

            <!-- Page Title -->

            <div class="btm black-link pageTitle">
                  <a href="../admin.php">
                        <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                  </a>
                  <h2 class="btmTitle">Modify Work</h2><br>
                  <small id="jobtabledescription" class="block text-muted">Red = No mechanic assigned, Green = mechanic assigned.</small>
            </div>

            <!-- Error Messages -->

            <?php
                  $type = "warning";
                  if(isset($_GET['error'])){
                        switch($_GET['error']){
                              case "stmtfailure":
                                    $type = "danger";
                                    $errorMsg = "Server issue. Please contact site administrator!";
                                    break;
                              case "stmtfailure invoice":
                                    $type = "danger";
                                    $errorMsg = "Server issue when creating Invoice. Please contact site administrator!";
                                    break;
                              case "database failure":
                                    $type = "danger";
                                    $errorMsg = "Database issue. Please contact site administrator!";
                                    break;
                              case "insufficientPermissions":
                                    $type = "primary";
                                    $errorMsg = "You do not have sufficient permissions to view this page!";
                                    break;
                              case "job database error":
                                    $type = "danger";
                                    $errorMsg = "Job's database issue. Please contact site administrator!";
                                    break;
                              case "job data failure job invoice":
                                    $type = "danger";
                                    $errorMsg = "The data you entered has caused a database error. Please validate your data and try again!";
                                    break;
                              case "data failure":
                                    $type = "danger";
                                    $errorMsg = "The entered data does not fit the allowed criteria! Please validate your data and try again!";
                                    break;
                              case "delete associated":
                                    $errorMsg = "Please delete the associated elements before deleting the job!";
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
                              case "success":
                                    $type = "success";
                                    $msg = "You have successfully created a job!";
                                    break;
                              case "success updated":
                                    $type = "info";
                                    $msg = "You have successfully updated a job!";
                                    break;
                              case "mechanic assigned":
                                    $type = "info";
                                    $msg = "You have successfully assigned a mechanic to the job!";
                                    break;
                              case "success completed":
                                    $type = "info";
                                    $msg = "You have successfully marked a job as completed!";
                                    break;
                              case "success deleted":
                                    $msg = "You have successfully deleted a job!";
                                    break;
                              case "parts ordered job invoice":
                                    $type = "success";
                                    $msg = "You have successfully created an invoice for the Job and all associated parts!";
                                    break;
                              default:
                                    $msg = "Something happened...";
                        }
                        echo "
                        <div class='center alert alert-".$type."'>
                              <strong>Info:</strong> ".$msg."
                        </div>
                        ";
                  }
            ?>

            <?php
                  listJobs($conn);
            ?>

            <!-- Start of Jobs Section -->
            

            <section class="jobsSeciton">
                  <!-- List of Jobs with Status -->
                  <table id="jobStatusTable" class="table joblist table-hover table-responsive">
                        <thead class="thead-dark">
                              <tr>
                                    <th scope="col">Job</th>
                                    <th scope="col">Status</th>
                              </tr>
                        </thead>

                        <tbody>
                              <?php
                                    for($i = 0; $i < sizeof($jobsTable); $i++){
                                          if($jobsTable[$i]["mechanic"] == "" || empty($jobsTable[$i]["mechanic"])){
                                                $color = "#ff7c7c";
                                          }else{
                                                $color = "#22990985";
                                          }
                                          if($jobsTable[$i]["jobTime"] != null || $jobsTable[$i]["jobTime"] != ""){
                                                $status = "Completed";
                                          }else{
                                                $status = "Available";
                                          }
                                          echo
                                                "
                                                <form class='jobsTable' id='jback' action='assets/php/jback.php' method='POST'>
                                                            <tr>
                                                                  <input type='id' class='hiddenfields' name='sid' value='".$i."'>
                                                                  <input type='id' class='hiddenfields' name='jid' value='".$jobsTable[$i]['jobID']."'>
                                                                  <th scope='row' style='background-color:".$color."' colspan='2'><button type='submit' name='jobs'>".$jobsTable[$i]["jobID"]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$status."</button></th>
                                                            </tr>
                                                </form>"
                                          ;
                                    }
                              ?>
                        </tbody>
                  </table>

                  <!-- Job Information -->

                  <?php
                        $jid = $_GET['jid'];
                        $uid = $_GET['sid'];

                        // Vehicle Information
                        $bookingID = $jobsTable[$uid]["bookingsID"];
                        $vid = findVehID($conn,$bookingID);
                        $vehInfo = findVehInfo($conn,$vid);
                        $userAccountID = $vehInfo["userAccountID"];
                        $vehReg = $vehInfo["vehReg"];
                        $vehMake = $vehInfo["vehMake"];
                        $vehModel = $vehInfo["vehModel"];
                        $userInfo = findUserInfo($conn,$userAccountID);
                        $mechanicID = $jobsTable[$uid]["mechanic"];
                        $mInfo = findUserInfo($conn,$mechanicID);
              

                        if(!empty($jobsTable[$uid]['jobTime']) || $jobsTable[$uid]['jobTime'] != ""){
                              $checked = "checked";
                              $time = "Time Taken";
                              $timeValue = $jobsTable[$uid]['jobTime'];
                              $dow = "D.O.W. Completed:";
                        }
                        else{
                              $time = "Estimated Time";
                              $timeValue = $jobsTable[$uid]['jobTimeE'];
                              $dow = "D.O.W. Required:";
                        }


                        if($_GET['f'] == "modify"){
                              include_once("assets/php/frontend/editJobInfo.php");
                        }
                        else if(isset($_GET['sid'])){
                              include_once("assets/php/frontend/viewJobInfo.php");
                        }
                  ?>
                  <!-- Modify Job Details -->

            </section>
      </body>
</html>