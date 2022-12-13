<html lang = "en" xml:lang = "en">
      <head>
            <title>BTM - GARITS : Bookings</title>
      </head>

      <body>
            <!-- Page Title -->

            <div class="btm black-link pageTitle">
                  <a href="../admin.php">
                        <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                  </a>
                  <h2 class="btmTitle">Bookings</h2>
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
                              case "database failure":
                                    $type = "danger";
                                    $errorMsg = "Booking's database issue. Please contact site administrator!";
                                    break;
                              case "insufficient permissions":
                                    $type = "primary";
                                    $errorMsg = "You do not have sufficient permissions to view this page!";
                                    break;
                              case "job database error":
                                    $type = "danger";
                                    $errorMsg = "Job's database issue. Please contact site administrator!";
                                    break;
                              case "data failure":
                                    $type = "danger";
                                    $errorMsg = "The entered data does not fit the allowed criteria! Please validate your data and try again!";
                                    break;
                              case "no veh":
                                    $errorMsg = "The user does not appear to have a vehicle!";
                                    break;
                              case "no input":
                                    $errorMsg = "Please fill in all the required fields!";
                                    break;
                              case "delete associated":
                                    $errorMsg = "Please delete the associated elements before deleting the booking!";
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
                                    $msg = "You have successfully created a booking!";
                                    break;
                              case "success updated":
                                    $type = "info";
                                    $msg = "You have successfully updated a booking!";
                                    break;
                              case "success deleted":
                                    $msg = "You have successfully deleted a booking!";
                                    break;
                              case "job created":
                                    $type = "success";
                                    $msg = "You have successfully added a job to the booking!";
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

            <!-- Start of Bookings Section -->

            <section class="bookingsSection">
                  <table class="btmtable table bookingsList table-hover table-striped table-responsive">
                        <thead class="thead-dark">
                              <tr>
                                    <th scope="col">Booking #</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                              </tr>
                        </thead>

                        <tbody>
                              <?php
                                    listBookings($conn);
                                    for($i = 0; $i < sizeof($bookingsTable); $i++){
                                          echo
                                          "<tr>
                                                <th scope='row'>".$bookingsTable[$i]['bookingID']."</th>
                                                <td>".$bookingsTable[$i]['type']."</td>
                                                <td>".$bookingsTable[$i]['date']."</td>
                                                <td>
                                                      <form action='assets/php/bback.php' method='POST'>
                                                            <input type='id' class='hiddenfields' name='sid' value='".$i."'>
                                                            <input type='id' class='hiddenfields' name='bookingID' value='".$bookingsTable[$i]['bookingID']."'>
                                                            <button type='submit' name='modify' class='btn btn-sm btn-outline-secondary'>Modify</button>
                                                            <button type='submit' name='deleteBooking' class='btn btn-sm btn-outline-danger'>Delete</button>
                                                      </form>
                                                </td>
                                          </tr>";
                                    }
                                  
                              ?>
                        </tbody>
                  </table>

                  <?php
                        if($_GET['f'] == "modify"){
                              $btn = "Modify";
                              $state = "Modify";
                        }else{
                              $btn = "New";
                              $state = "Create";
                        }


                        $sid = $_GET['sid'];
                        $bid = $_GET['bid'];

                        if(empty($bid)){
                              $bid = "Auto Generated";
                        }
                  
                        echo 
                        "<button type='button' onclick='createBooking()' class='btn btn-success'>".$btn." Booking</button>";

                        if($bid <> "Auto Generated"){
                              echo
                              "<button type='button' name='addJob' onclick='createBookingWithJob()' class='addjobbtn btn btn-outline-primary'>Add Job to Booking</button>";
                        }


                  ?>


                  <!-- Create Booking Section -->

                  <div class="booking card bg-light hiddenfields" id="createBooking">
                        <form action="assets/php/bback.php" method='POST'>
                              <?php
                              echo
                                  " <div class='card-header'>Booking ID: ".$bid."</div>
                                    <p class='card-text'>Required fields are marked with a red Asterisk <span class='required'>*</span></p>
                                    <div class='card-body'>
                                          <div class='form-group'>
                                                <p>Select booking type  <span class='required'>*</span></p>
                                                <div class='form-row'>
                                                      <div class='form-group col-md-6'>
                                                            <select class='custom-select' name='bookingType' id='bookingType'>
                                                                  <option default value='".$bookingsTable[$sid]['type']."'>".$bookingsTable[$sid]['type']."</option>
                                                                  <option value='M.O.T. Service'>M.O.T. Service</option>
                                                                  <option value='Oil Check'>Oil Check</option>
                                                                  <option value='Tire Replacement'>Tire Replacement</option>
                                                                  <option value='Anual Service'>Anual Service</option>
                                                            </select>
                                                      </div>
                                                      <div class='form-group col-md-6'>
                                                            <input class='form-control bookingInputs' name='bookingTypeOther' id='bookingOther' type='text' placeholder='Other'>
                                                      </div>
                                                </div>
                                                
                                                <div class='form-row'>
                                                      <div class='form-group col-md-6'>
                                                            <label class='btm-labeltext' for='bookingDate'>Select booking date <span class='required'>*</span></label>
                                                            <input class='form-control bookingInputs' value='".$bookingsTable[$sid]['date']."' name='bookingDate' id='bookingDate' type='date' placeholder='dd/mm/yyyy' required>
                                                      </div>

                                                      <div class='form-group col-md-6'>
                                                            <label for='inputCustomer'>Input Customer Veh ID <span class='required'>*</span></label>
                                                            <input class='form-control bookingInputs' value='".$bookingsTable[$sid]['vehID']."' name='vehID' id='inputVeh' type='id' placeholder='vehID' required>
                                                      </div>
                                                </div>

                                          </div>
                                          <input type='id' class='hiddenfields' name='bid' value='".$_GET['bid']."'>
                                          <button type='submit' name='createBooking' class='btn btn-sm btn-outline-secondary'>".$state." Booking</button>
                                    </div>";
                              ?>
                        </form>
                  </div>

                  <!-- Create a Job for the Booking -->

                  <?php
                        $bid = $_GET['bid'];
                        $vid = $_GET['vehID'];
                        if($_GET['f'] == "modify"){
                              $vid = $bookingsTable[$sid]['vehID'];
                        }
                        $vehInfo = findVehInfo($conn,$vid);
                        $userAccountID = $vehInfo["userAccountID"];
                        $vehReg = $vehInfo["vehReg"];
                        $vehMake = $vehInfo["vehMake"];
                        $vehModel = $vehInfo["vehModel"];
                        $userInfo = findUserInfo($conn,$userAccountID);
                        
                  ?>

                  <div class="btm card bg-light jobsCard hiddenfields" id="bookingWithJob">
                        <form action="assets/php/bback.php" method='POST'>
                              <div class="card-header">
                                    <span class="jobNumber"><b>Job Number:</b><span id="jobNumber"> Auto Generated</span></span>
                                    <span class="bookingID"><b>Booking ID:</b><span id="bookingID"> <?php echo $bid; ?></span></span>
                                    <input type="id" class="hiddenfields" name="bid" value="'<?php echo $bid; ?>'">
                              </div>
                              <div class="jobCardLeft">
                                    <p class="card-jobtext"><b>Vehicle Registration Number:</b> <?php echo $vehReg; ?></p>
                                    <p class="card-jobtext"><b>Make:</b> <?php echo $vehMake; ?></p>
                                    <p class="card-jobtext"><b>Model:</b> <?php echo $vehModel; ?></p>
                                    <p class="card-jobtext"><b>D.O.W. Required / Completed:</b></p>
                                    <div class="dowReq-form">
                                    <div class="form-group">
                                          <textarea class="form-control" name="dow" rows="5" id="comment"></textarea>
                                    </div> 
                                    </div>
                                    <p class="card-jobtext"><b>Estimated Time:</b></p>
                                    <div class="btm jobtime input-group input-group-sm mb-3" id="estimatedJobTime">
                                          <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">Time</span>
                                          </div>

                                          <input type="float" class="form-control" name="et" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                              </div>
                              <div class="jobCardRight">
                                    <p class="card-jobtext"><b>Mechanic Assigned:</b> Unassigned</p>
                                    <p class="card-jobtext"><b>Date Booked in:</b> <span id="todaysDate">12/03/22</span></p>
                                    <p class="card-jobtext"><b>Customer Name:</b> <?php echo $userInfo["name_first"]." ".$userInfo["name_last"]; ?> </p>
                                    <p class="card-jobtext"><b>Tel:</b> <?php echo $userInfo["tel"]; ?></p>

                                    <div class="btm jobCompleteCheckBox form-check form-check-inline">
                                          <input class="form-check-input" name="isCompleted" type="checkbox" id="jobComCheckBox" value="true" />
                                          <label class="form-check-label" for="jobComCheckBox">Job Completed</label>
                                    </div>

                                    <div class="row mb-3">
                                          <div class="col-auto">
                                                <div class="btm mechanic-assign input-group input-group-sm col-auto mb-2" id="mechanicInputJobs">
                                                      <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Mechanic ID</span>
                                                      </div>
                                                      <input type="text" class="form-control" name="mechanicID" aria-label="Mechanic ID input" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                                <div class="btm mechanic-assign input-group input-group-sm col-auto" id="mechanicInputJobs">
                                                      <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Vehicle Bay</span>
                                                      </div>
                                                      <input type="text" class="form-control" name="vehicleBay" aria-label="Vehicle Bay input" aria-describedby="inputGroup-sizing-sm">
                                                </div>
                                          </div>
                                    
                                    </div>

                                    <button type="button" onclick="location.href='../admin.php?page=bookings'" class="btn btn-outline-secondary">Cancel</button>
                                    <button type="submit" name="bookingwjob" class="btn btn-outline-success">Save</button>

                              </div>
                        </form>
                  </div>
            </section>

            <script>getDate();</script>


            <!-- Footer -->
      </body>
</html>