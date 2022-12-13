<!DOCTYPE html>
<html lang = "en" xml:lang = "en">
    <head>
        <title>BTM - GARITS : Invoice</title>
    </head>

    <body id="invoicebody">
        <!-- Page Title -->

        <div class="btm black-link pageTitle">
                <a href="../admin.php">
                    <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                </a>
                <h2 class="btmTitle">Invoice</h2>
        </div>

        <?php
            listInvoices($conn);
            $sid = $_GET["sid"];
            $iid = $_GET["iid"];
            $chkdate = checkLatePayment($conn,$invoiceTable[$sid]["date"]);
            if (isset($_GET["iid"]) && $chkdate >= 1){
                $color = "#ff5656";
                echo "
                <div class='center alert alert-danger'>
                    <strong>Alert:</strong> The payment for InvoiceID#: ".$iid." is at least 30 days late!
                </div>
                ";
            }
        ?>

        <!-- Error Messages -->
        <?php
            $type = "warning";
            if(isset($_GET['error'])){
                switch($_GET['error']){
        
                        case "stmtfailure":
                            $type = "danger";
                            $errorMsg = "Server issue. Please contact site administrator!";
                        case "emptyinput":
                            $errorMsg = "Please enter a valid email address and a password!";
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
                        case "success deleted":
                            $type = "info";
                            $msg = "You have successfully deleted the invoice!";
                            break;
                        case "success paid":
                            $type = "success";
                            $msg = "You have successfully marked the invoice as paid!";
                            break;
                }
                echo "
                <div class='center alert alert-".$type."'>
                        <strong>Info:</strong> ".$msg."
                </div>
                ";
            }
        ?>

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a id="ListInvButton" class="nav-link active" aria-current="true">List of invoices</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a id="NewInvButton" class="nav-link">New Invoice</a>
                    </li> -->
                </ul>
            </div>

            <div class="card-body">
                <!-- elemetns in the tab List of invoices.-->

                <h2> List of Invoices</h2>

                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice ID</th>
                            <!-- <th scope="col">Client Name</th> -->
                            <th scope="col">Type</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            for($i = 0; $i < sizeof($invoiceTable); $i++){
                                $uid = findOrderNumUID($conn,$invoiceTable[$i]["partsOrderNum"]);
                                $uinfo = findUserInfo($conn,$uid);
                                $invoiceTable[$i]["name"] = $uinfo["name_first"]." ".$uinfo["name_last"];
                                if($invoiceTable[$i]["paid"] == 0){
                                    $paid = "Unpaid";
                                }else{
                                    $paid = "Paid";
                                }
                                if($invoiceTable[$i]["jobID"] != 0){
                                    $type = "Repair Job";
                                }else if(!empty($invoiceTable[$i]["partsOrderNum"]) && empty($invoiceTable[$i]["jobID"])){
                                    $type = "Parts Order";
                                }
                                echo
                                "
                                <tr>
                                    <th scope='row'>".$i."</th>
                                    <td>".$invoiceTable[$i]["invoiceNo"]."</td>
                                    <td>".$type."</td>
                                    <td>£ ".$invoiceTable[$i]["totalPrice"]."</td>
                                    <td>".$paid."</td>
                                    <td>".$invoiceTable[$i]["date"]."</td>

                                    <td>
                                        <div class='invoiceTableButtons'>
                                            <form action='assets/php/iback.php' method='POST'>
                                                <input type='id' class='hiddenfields' name='iid' value='".$invoiceTable[$i]["invoiceNo"]."'>
                                                <input type='id' class='hiddenfields' name='sid' value='".$i."'>
                                                <button type='submit' name='viewInvoice' class='btn btn-sm btn-info'>View</button>
                                                <button type='submit' name='isPaid' class='btn btn btn-sm btn-info'>Paid</button>
                                                <button type='submit' name='deleteinvoice' class='btn btn-sm btn-danger'>Delete</button>

                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

     
        <?php
            if($_GET['sid'] != "-1"){
                include_once("assets/php/frontend/viewInvoice.php");
            }
        ?>
            

        <!-- Make Payment -->

        <div class="btm invoice card hiddenfields" id="cardPayment">
        <div class="center card-header">Invoice Number: <?php echo $invoiceTable[$sid]["invoiceNo"];?></div>
        <div class="block center card-body">

            <p class="card-text">Required fields are marked with a red Asterisk <span class='required'>*</span></p>

            <form action="" method="POST">
                <div class="form-row">
                    
                    <div class="col-md-4 mb-3">
                        <label for="validationServer02">Full Name as shown on Card  <span class='required'>*</span></label>
                        <input type="text" class="form-control" id="validationServer02" placeholder="Full Name" value="" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="validationServer01">Card Number  <span class='required'>*</span></label>
                        <input type="text" class="form-control" id="validationServer01" placeholder="16 Digit Card Number" value="" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="validationServerDate">Card Expiry Date  <span class='required'>*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">dd/mm</span>
                            </div>
                            <input type="date" class="form-control " id="validationServerDate" placeholder="dd/mm" aria-describedby="inputGroupPrepend3" required>
                            <div class="invalid-feedback">
                                Please the card expiry date.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-auto btmcenter mb-3">
                        <label for="validationServerDate">Card Security Code  <span class='required'>*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">123(4)</span>
                            </div>
                            <input type="pin" class="form-control " id="validationServerDate" placeholder="123" aria-describedby="inputGroupPrepend3" required>
                            <div class="invalid-feedback">
                                Please the card expiry date.
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-primary" type="submit">Make Payment</button>

            </form>
        </div>
    </div>   

    </body>
</html>

<script>
    getDate();
</script>








