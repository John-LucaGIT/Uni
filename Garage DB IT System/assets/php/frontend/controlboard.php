
<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
      <head>
            <title>BTM - GARITS : Control Board</title>
      </head>

      <body>
            <!-- Page Title -->

            <div class="btm black-link pageTitle">
                  <h2 class="btmTitle">Control Board</h2>
            </div>

            <?php
                  $role = idToRole($_SESSION['role']);
            ?>

            <!-- Start of control board here -->
            <section class="adminControlBoardSection">
                  <div class="welcomTitle">
                        <h4 class="center">Hello <?php echo $_SESSION["name"]; ?></h4>
                        <h3 class="center">Welcome to GARITS <?php echo $role; ?></h3>
                  </div>
            
                  <div class="controlboard container">
                        <div class="row">
                              <?php
                                    if($_SESSION['role'] == 5){
                                          $a = "hiddenfields";
                                    }
                                    if($_SESSION['role'] < 4){
                                          $m = "hiddenfields";
                                    }
                              ?>

                              <div class="<?php echo $m; ?> col">
                                    <div class="card text-center">
                                          <a href="admin.php?page=users">
                                                <div class="card-body">
                                                      <h5 class="card-title">Customer List</h5> 
                                                      <i class="fa-solid fa-4x fa-address-card"></i> 
                                                </div>
                                          </a>
                                    </div>
                              </div>
                              
                              <?php 
                                    if($_SESSION['role'] == 5){
                                          echo 
                                          "
                                                <div class='col'>
                                                      <div class='card text-center'>
                                                            <a href='admin.php?page=database'>
                                                                  <div class='card-body'>
                                                                        <h5 class='card-title'>Database</h5> 
                                                                        <i class='fa-solid fa-4x fa-file-code'></i>
                                                                  </div>
                                                            </a>
                                                      </div>
                                                </div>
                                          ";

                                    }
                              ?>

                              <div class="<?php echo $a;?> col">
                                    <div class="card text-center">
                                          <a href="admin.php?page=jobs">
                                                <div class="card-body">
                                                      <h5 class="card-title">Modify Work</h5> 
                                                      <i class="fa-solid fa-4x fa-car"></i>
                                                </div>
                                          </a>
                                    </div>
                              </div>

                              <div class="<?php echo $a; ?> col">
                                    <div class="card text-center">
                                          <a href="admin.php?page=bookings">
                                                <div class="card-body">
                                                      <h5 class="card-title">New Worksheet</h5> 
                                                      <i class="fa-solid fa-4x fa-folder-plus"></i>
                                                </div>
                                          </a>
                                    </div>
                              </div>
                        </div>

                        <div class="row">
                              <div class="<?php echo $a; echo $m; ?> col">
                                    <div class="card text-center">
                                          <a href="admin.php?page=stockreport">
                                                <div class="card-body">
                                                      <h5 class="card-title">Stock Level</h5> 
                                                      <i class="fa-solid fa-4x fa-chart-column"></i>
                                                </div>
                                          </a>
                                    </div>
                              </div>
                              <?php
                                    if($_SESSION['role'] == 4 || $_SESSION['role'] == 1){
                                          echo 
                                          "
                                          <div class='".$a." ".$m."col'>
                                                <div class='card text-center'>
                                                      <a href='admin.php?page=invoice'>
                                                            <div class='card-body'>
                                                                  <h5 class='card-title'>Invoice</h5> 
                                                                  <i class='fa-solid fa-4x fa-credit-card'></i> 
                                                            </div>
                                                      </a>
                                                </div>
                                          </div>";
                                    }
                                    
                              ?>
                        </div>
                        <div class="row">
                              <div class="<?php echo $a; echo $m; ?> col">
                                    <div class="card text-center">
                                          <a href="admin.php?page=buyparts">
                                                <div class="card-body">
                                                      <h5 class="card-title">Buy Parts</h5> 
                                                      <i class="fa-solid fa-4x fa-cart-shopping"></i>
                                                </div>
                                          </a>
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
      </body>
</html>