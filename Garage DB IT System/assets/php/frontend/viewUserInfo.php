<div class="card userinfo bg-light" id="userinfocard">
      <div class="card-header">
            User: "<?php echo $users[$uid]['name_first']." ".$users[$uid]['name_last']; ?>"<span id="userListCustomerID"><?php echo $users[$uid]['id']; ?></span>
      </div>
            <div class="row user-cards">
                  <div class="col-sm-4">
                        <div class="card left">
                              <div class="card-body">
                                    <?php echo "
                                          <p class='card-text'>Name: ".$users[$uid]['name_first']." ".$users[$uid]['name_last']."</p> 
                                          <p class='card-text'>E-Mail: ".$users[$uid]['email']."</p>
                                          <p class='card-text'>Vehicles: ".$users[$uid]['vehicles']."</p> ";
                                    ?>
                              </div>
                        </div>
                  </div>

                  <div class="col-sm-4">
                        <div class="card center">
                              <div class="card-body">
                                    <?php echo "
                                          <p class='card-text'>Tel: ".$users[$uid]['tel']."</p>
                                          <p class='card-text'>Fax: ".$users[$uid]['fax']."</p>
                                          <p class='card-text'>Address:<br>".$users[$uid]['address']."<br>".$users[$uid]['postCode']."</p> ";     
                                    ?>         
                              </div>
                        </div>
                  </div>

                  <div class="col-sm-4">
                        <div class="card right">
                              <div class="card-body">
                                    <?php echo "
                                          <p class='card-text'>Role: ".$users[$uid]['role']."</p>    
                                          <p class='card-text'>Customer Since: ".$users[$uid]['date']."</p>        
                                          <p class='card-text'>Notes: ".$users[$uid]['notes']."</p> ";    
                                    ?>                
                              </div>
                        </div>
                  </div>
            </div>
            
            <!-- Show Vehicles for the selected User Button -->
            <div class='bottom'>
                  <button type="button" onclick="location.href='../admin.php?page=users'" class='btn btn-sm btn-outline-secondary'>Cancel</button>
                  <button type="button" onclick="location.href='../admin.php?page=users&sid=<?php echo $uid; ?>&rid=<?php echo $users[$uid]['id']; ?>&f=edit'" class='btn btn-sm btn-warning'>Edit</button>
                  <?php
                        if(sizeof($vehicles) != 0){
                              echo"
                                    <button type='button' onclick='showUserVehicles(1)' class='btn btn-sm btn-info'>View Vehicles</button>
                              ";
                        }
                  ?>
            </div>

            <!-- Vehicle List -->

            <div class="vehicles hiddenfields" id="userVehicles">
                  <table class="table vehiclesUserTable table-responsive">
                        <thead class="thead-dark">
                              <tr>
                                    <th scope="col">ID #</th>
                                    <th scope="col">Make</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Registration</th>
                                    <th scope="col">M.O.T. Exp.</th>
                              </tr>
                        </thead>

                        <tbody>
                              <?php
                                    for($i = 0; $i <= sizeof($vehicles); $i++){
                                          echo "
                                          <tr id='showVehicles".$vehicles[$i]["vehID"]."'>
                                                <th scope='row'>".$vehicles[$i]["vehID"]."</th>
                                                <td>".$vehicles[$i]["vehMake"]."</td>
                                                <td>".$vehicles[$i]["vehModel"]."</td>
                                                <td>".$vehicles[$i]["vehReg"]."</td>
                                                <td>".$vehicles[$i]["motExp"]."</td>
                                          </tr>
                                          ";
                                    }
                              ?>
                        </tbody>
                  </table>
            </div>
</div>