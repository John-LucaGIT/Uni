<div class="card userinfo useredit bg-light" id="userinfoEditCard">
      <div class="card-header">
            <?php
                  if($_SESSION['role'] == 4){
                  $type = "Customer";
                  $hide = "hiddenfields";
                  $d = "disabled";
                  }else{
                  $type = "User";
                  }
                  echo "
                        User: '".$users[$uid]['name_first']." ".$users[$uid]['name_last']."'<span id='userListCustomerID'>ID: ".$users[$uid]['id']."</span>
                  ";
            ?>
      </div>

      <!-- Card 1 -->
      <form action="assets/php/uback.php" method="POST">

            <div class="row user-cards">
                  <div class="col-sm-4">
                        <div class="card left">
                              <div class="card-body">
                                    <?php
                                          echo"
                                                <input type='id' class='hiddenfields' name='id' value='".$users[$uid]['id']."'>
                                                <p class='card-text'>Name: ".$users[$uid]['name_first']." ".$users[$uid]['name_last']."</p>
      
                                                <div class='form-group'>
                                                      <label for='usersChangeEmail'>Change E-Mail Address</label>
                                                      <input class='form-control' id='usersChangeEmail' name='usersChangeEmail' type='email' value='".$users[$uid]['email']."'>
                                                </div> "
                                          ;
                                    ?>
                              </div>
                        </div>
                  </div>

                  <!-- Card 2 -->

                  <div class="col-sm-4">
                        <div class="card center">
                              <div class="card-body">
                                    <div class="form-group">
                                          <?php
                                                echo"
                                                      <label for='usersChangeTel'>Change Phone Number</label>
                                                      <input class='form-control' name='usersChangeTel' id='usersChangeTel' type='tel' value='".$users[$uid]['tel']."'>

                                                      <label for='usersChangeFax'>Change Fax Number</label>
                                                      <input class='form-control' name='usersChangeFax' id='usersChangeFax' type='tel' value='".$users[$uid]['fax']."'>

                                                      <label for='usersChangeAddress'>Change Address</label>
                                                      <textarea class='center form-control' rows='3' name='usersChangeAddress' id='usersChangeAddress'>".$users[$uid]['address']."</textarea>

                                                      <label for='usersChangePostCode'>Change Post Code</label>
                                                      <input class='form-control' id='usersChangePostCode' name='usersChangePostCode' type='postcode' value='".$users[$uid]['postCode']."'>
                                                ";
                                          ?>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <!-- Card 3 -->

                  <div class="col-sm-4">
                        <div class="card right">
                              <div class="card-body">
                                    <div class="form-group">
                                          <?php
                                                echo "
                                                      <div class='".$hide."'>
                                                            <label for='userChangeRole'>Change Role</label>
                                                            <div class='input-group mb-3'>
                                                                  <div class='input-group-prepend'>
                                                                        <label class='input-group-text' for='inputGroupSelect01'>".$users[$uid]['role']."</label>
                                                                  </div>
                                                                        <select class='custom-select' name='userChangeRole' id='userChangeRole' >
                                                                              <option selected >Choose...</option>
                                                                              <option value='0'>Customer</option>
                                                                              <option value='1'>Receptionist</option>
                                                                              <option value='2'>Mechanic</option>
                                                                              <option value='3'>Foreperson</option>
                                                                              <option value='4'>Franchisee</option>
                                                                              <option value='5'>Administrator</option>
                                                                        </select>
                                                            </div>
                                                      </div>

                                                      <div class=''>
                                                            <label for='userChangeRole'>Change Customer Type</label>
                                                            <small id='userChangeRole' class='block text-muted'>*Only apply to Customers*</small>

                                                            <div class='input-group mb-3'>
                                                                  <select class='custom-select' name='userChangeAccountRole' id='userChangeRole' >
                                                                        <option selected >Choose...</option>
                                                                        <option value='0'>Customer</option>
                                                                        <option value='-1'>Account Holder</option>
                                                                  </select>
                                                            </div>
                                                      </div>

                                                      <div class=''>
                                                            <label for='discountPlan'>Change Discount Type</label>
                                                            <div class='input-group mb-3'>
                                                                  <select class='custom-select' name='discountPlan' id='discountPlan' >
                                                                        <option selected >Choose...</option>
                                                                        <option value='None'>None</option>
                                                                        <option value='Fixed Discount'>Fixed Discount</option>
                                                                        <option value='Variable Discount'>Variable Discount</option>
                                                                        <option value='Flexible Discount'>Flexible Discount</option>
                                                                  </select>
                                                            </div>
                                                      </div>

                                                      <label for='discountPlanNum'>Set discount %</label>
                                                      <input class='form-control' id='discountPlanNum' name='discountPlanNum' placeholder='10%' type='percent' value=''>


                                                      <label for='userChangeNotes'>Change Notes</label>
                                                      <textarea class='form-control' rows='1' name='userChangeNotes' id='userChangeNotes'>".$users[$uid]['notes']."</textarea>
                                                ";
                                          ?>
                                    </div>
                              </div>
                        </div>
                  </div>

            </div>

            <!-- Buttons -->
                        
            <div class="bottom">
                  <?php
                        if(sizeof($vehicles) > 0){
                              echo "<button type='button' onclick='showUserVehicles(2)' class='btn btn-sm btn-outline-warning'>Edit Vehicles</button>";
                        }
                  ?>
                  <button type="button" onclick="location.href='../admin.php?page=users'" class="btn btn-sm btn-outline-secondary">Cancel</button>
                  <button type="submit" name="submitData" class="btn btn-sm btn-success">Save</button>
            </div>

      </form>


      <!-- Edit vehicles menu -->

      <div class="vehicles hiddenfields" id="userVehicles2">
            <table class="table vehiclesUserTable table-responsive">
                  <thead class="thead-dark">
                        <tr>
                              <th scope="col">ID #</th>
                              <th scope="col">Make</th>
                              <th scope="col">Model</th>
                              <th scope="col">Registration</th>
                              <th scope="col">M.O.T. Exp.</th>
                              <th scope="col">Actions</th>
                        </tr>
                  </thead>

                  <tbody>
                        <?php
                              for($i = 0; $i < sizeof($vehicles); $i++){
                                    echo "
                                    <tr id='showVehicles".$vehicles[$i]["vehID"]."'>
                                          <th scope='row'>".$vehicles[$i]["vehID"]."</th>
                                          <td>".$vehicles[$i]["vehMake"]."</td>
                                          <td>".$vehicles[$i]["vehModel"]."</td>
                                          <td>".$vehicles[$i]["vehReg"]."</td>
                                          <td>".$vehicles[$i]["motExp"]."</td>
                                          <td>
                                                <form class='vehDel' action='assets/php/uback.php' method='POST'>
                                                      <input type='vehID' class='hiddenfields' name='vehID' value='".$vehicles[$i]['vehID']."'>
                                                      <button type='submit' name='delVeh' class='btn btn-sm btn-dange'>Delete</button>
                                                </form>
                                          </td>
                                    </tr>
                                    ";
                              }
                        ?>
                  </tbody>
            </table>
      </div>
      <div class="bottom">
            <button type="button" onclick="showUserVehicles(3)" class="btn btn-sm btn-info">Add Vehicle</button>
      </div>

      <!-- Add vehicles input form -->

      <div class="addVehicle hiddenfields" id="addvehicles">
            <div class="card vehs bg-light">
                  <div class="card-header">
                        Add a Vehicle
                        <p class=card-text>Required fields are marked with a red Asterisk <span class="required">*</span></p>
                  </div>
                        <form class="vehicleInput" action="assets/php/uback.php" method="POST">
                              <div class="form-row">
                                    <div class="form-group col-md-6">
                                          <label for="createVehMake">Add Vehicle Make <span class="required">*</span></label>
                                          <input class="form-control" name="createVehMake" id="createVehMake" type="text" placeholder="Make" required>
                                          <?php 
                                                echo "<input type='id' class='hiddenfields' name='realID' value='".$users[$uid]['id']."'>";
                                          ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                          <label for="createVehModel">Add Vehicle Model <span class="required">*</span></label>
                                          <input class="form-control" name="createVehModel" id="createVehModel" type="text" placeholder="Model" required>
                                    </div>
                              </div>

                              <div class="form-row">
                                    <div class="form-group col-md-4">
                                          <label for="createVehChasNum">Add Vehicle Chassis Number <span class="required">*</span></label>
                                          <input class="form-control" name="createVehChasNum" id="createVehChasNum" type="text" placeholder="Chassis Number" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                          <label for="createVehReg">Add Vehicle Registration <span class="required">*</span></label>
                                          <input class="form-control" name="createVehReg" type="text" placeholder="Registration" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                          <label for="createVehSerial">Add Vehicle Serial <span class="required">*</span></label>
                                          <input class="form-control" name="createVehSerial" id="createVehSerial" type="text" placeholder="Serial" required>
                                    </div>
                              </div>

                              <div class="form-row">
                                    <div class="form-group col-md-6">
                                          <label for="createVehColor">Add Vehicle Color <span class="required">*</span></label>
                                          <input class="form-control" name="createVehColor" id="createVehColor" type="text" placeholder="Color" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                          <label for="createMOTEXP">Add M.O.T. expiration date</label>
                                          <input class="form-control" name="createMOTEXP" id="createMOTEXP" type="date" placeholder="dd/mm/yyyy">
                                    </div>
                              </div>
                              

                              <div class="bottom">
                                    <button type="button" onclick="showUserVehicles(3)" class="btn btn-sm btn-outline-secondary">Cancel</button>
                                    <button type="submit" name="addVeh" class="btn btn-sm btn-success">Save</button>
                              </div>
                        </form>
            </div>
      </div>
</div>