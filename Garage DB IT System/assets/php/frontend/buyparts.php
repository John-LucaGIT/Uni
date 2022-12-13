
<html lang = "en" xml:lang = "en">
      <head>
            <title>BTM - GARITS : Buy Parts</title>
      </head>

      <body>
            <!-- Page Title -->

            <div class="btm black-link pageTitle">
                  <a href="../admin.php">
                        <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                  </a>
                  <h2 class="btmTitle">Buy Parts</h2>
            </div>

            <!-- Error Messages -->

            <?php
                  listAllParts($conn);
                  $type = "warning";
                  if(isset($_GET['error'])){
                        switch($_GET['error']){
                              case "stmtfailure":
                                    $type = "danger";
                                    $errorMsg = "Server issue. Please contact site administrator!";
                                    break;
                              case "stmtfailure pop":
                                    $type = "danger";
                                    $errorMsg = "Server issue when updating pratsOrder_parts. Please contact site administrator!";
                                    break;
                              case "database failure":
                                    $type = "danger";
                                    $errorMsg = "Database issue. Please contact site administrator!";
                                    break;
                              case "insufficient+permissions":
                                    $type = "primary";
                                    $errorMsg = "You do not have sufficient permissions to view this page!";
                                    break;
                              case "data failure":
                                    $type = "danger";
                                    $errorMsg = "The entered data does not fit the allowed criteria! Please validate your data and try again!";
                                    break;
                              case "no input":
                                    $errorMsg = "Please fill in all the required fields!";
                                    break;
                              case "invalid email":
                                    $errorMsg = "The email you entered is not valid! Please enter the correct email!";
                                    break;
                              case "parts no stock":
                                    $errorMsg = "This item is not in stock with the quantity you entered!";
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
                                    $msg = "You have successfully submitted a parts order!";
                                    break;
                              case "parts ordered pop":
                                    $type = "info";
                                    $msg = "You have successfully ordered a part!";
                                    break;
                              case "parts ordered job pop":
                                    $type = "info";
                                    $msg = "You have successfully ordered a part, it will be added to the invoice of the job!";
                                    break;
                              case "parts ordered invoice":
                                    $type = "success";
                                    $msg = "You have successfully ordered a part, an invoice has been created!";
                                    break;
                              case "parts queued":
                                    $type = "info";
                                    $msg = "You have successfully added a part to the order queue, please standby for further confirmation!";
                                    break;
                              case "success deleted":
                                    $msg = "You have successfully deleted an order!";
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

            <section class="btmcenter btmtable partsTable hiddenfields" id="partsTableCodes">
                  <table class="table table-hover table-responsive">
                        <thead class="thead-dark">
                              <tr>
                                    <th scope="col">Part Code</th>
                                    <th scope="col">Part Name</th>
                              </tr>
                        </thead>

                        <tbody>
                              <?php
                                    for($i = 0; $i < sizeof($allPartsTable); $i++){
                                          echo
                                          "
                                                <tr>
                                                      <th scope='row'>".$allPartsTable[$i]["partCode"]."</th>
                                                      <th>".$allPartsTable[$i]["partName"]."</th>
                                                </tr>
                                          ";
                                    }
                              ?>
                        </tbody>
                  </table>
            </section>

            <!-- Start of Buy Parts Section -->

            <div class="btm partsCard card">
                  <div class="center card-header">Order Number: Auto Generated</div>
                  <div class="block center card-body">

                        <p class="card-text">Required fields are marked with a red Asterisk <span class='required'>*</span></p>

                        <form action="assets/php/poback.php" method="POST">
                              <div class="form-row idhelp" id="idhelp">
                                    <div class="form-group col-md-auto">
                                          <label for="email">Customer Email:</label>
                                          <input class="btmcenter block" type="email" id="email" name="email" placeholder="customer@provider.com">
                                    </div>

                                    <div class="form-group col-md-auto">
                                          <label for="id">Customer ID:</label>
                                          <input class="btmcenter block" type="id" id="id" name="id" placeholder="ID">
                                    </div>
                              </div>

                              <small id="idhelp" class="form-text text-muted">Leave blank when ordering for Garage, only one field required.</small>

                              <div class="form-row parts quant">
                                    <div class="form-group col-md-auto">
                                          <label for="desc">Parts Code: <span class='required'>*</span></label>
                                          <input class="btmcenter block" type="text" id="desc" name="partsCode" placeholder="F22493J">
                                    </div>

                                    <div class="form-group col-md-auto">
                                          <label for="quantity">Quantity: <span class='required'>*</span></label>
                                          <input class="btmcenter block" type="number" id="quantity" name="quantity" placeholder="Number">
                                    </div>
                              </div>

                              <label for="desc">Job ID:</label>
                              <input class="col-md-auto btmcenter block" type="number" id="jobIDField" name="jobID" placeholder="jobID">
                              <small id="jobIDFieldHelp" class="form-text text-muted">Optional</small>

                              <button type="submit" name="submit" class="btn btn-sm btn-outline-warning block btmcenter" value="">Order Parts</button>
                        </form>
                  </div>
            </div>   

            <div class="btm buyparts bottom">
                  <button type="button" id="showpartsbutton" onclick="showPartsList()" class="btn btn-sm btn-outline-info block btmcenter" value="">Show Parts</button>
                  <small id="showpartsbutton" class="form-text text-muted">Click to see all Part Codes with their Part Names.</small>
            </div>
      </body>
</html>