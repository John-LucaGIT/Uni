

<!-- View Invoice -->

<div class="card invoiceCards bg-light" id="invoiceCards">

    <?php
        $jid = $invoiceTable[$sid]["jobID"];

        if(empty($jid) || $jid == ""){
            $uid = findOrderNumUID($conn,$invoiceTable[$sid]["partsOrderNum"]);
            $uinfo = findUserInfo($conn,$uid);
        }else{
            $bid = getBookingID($conn,$jid);
            $vid = findVehID($conn,$bid);
            $vehinfo = findVehInfo($conn,$vid);
            $uid = $vehinfo["userAccountID"];
            $uinfo = findUserInfo($conn,$uid);
            $jinfo = getJobInfo($conn,$jid);
            findOrderNo($conn,$jid);
        }


        if($jid == "" || empty($jid)){
            $hidden = "hiddenfields";
        }
        if($orderNums == 0){
            $hidden = "hiddenfields";
        }
        $rate = getLaborRate($conn,$jinfo["mechanic"]);
        $hours = $jinfo["jobTime"];
        $name = $uinfo["name_first"]." ".$uinfo["name_last"];
    ?>

    <div id="printableArea">
        <div class="card-header">
                Customer: "<?php echo $invoiceTable[$sid]["name"]; ?>"<span id="userListCustomerID">Invoice # : <?php echo $iid; ?></span>
        </div>

        <div class="invoice-card">
            <div class="card-subtitle">
                <h3>Invoice</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="invoice-customer-address">
                        <p class="card-text" id="customer-name-invoice"><?php echo $name; ?></p>
                        <p class="card-text" id="customer-address-invoice"><?php echo $uinfo["address"]; ?></p>
                        <p class="card-text" id="customer-postcode-invoice"><?php echo $uinfo["postCode"]; ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="invoice-seller-address">
                        <p class="card-text" id="seller-name-invoice">Quick Fix Fitters,</p>
                        <p class="card-text" id="seller-address-invoice">19 High St., Ashford, Kent</p>
                        <p class="card-text" id="seller-postcode-invoice">CT16 8YY</p>
                        <p class="card-text invoice-date" id="todaysDate">dd/mm/yy</p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text" id="customer-name-greeting">Dear Mr. / Ms. <?php echo $name ?></p>
            </div>

            <div class="center invoice-no-center">
                <p class="card-text" id="customer-invoice-number">INVOICE NO.:<?php echo $invoiceTable[$sid]["invoiceNo"]?></p>
            </div>

            <?php 
                if($jid != "" || !empty($jid)){
                    echo
                        "<div class='invoice-customer-vehicle'>
                            <p class='card-text bold'>Vehicle Serviced:</p>
                            <p class='card-text' id='customer-veh-reg'>Vehicle Registration No.: ".$vehinfo['vehReg']."</p>
                            <p class='card-text' id='customer-veh-make'>Make: ".$vehinfo['vehMake']."</p>
                            <p class='card-text' id='customer-veh-model'>Model: ".$vehinfo['vehModel']."</p>
                        </div>

                        <div class='invoice-customer-dow'>
                            <p class='card-text bold'>Description of Work</p>
                            <p class='card-text dow'>".$jinfo['dow_co']."</p>
                        </div>
                        "
                    ;

                }

            ?>

            <div class="<?php echo $hidden; ?> btmcenter btmtable partsTable">
                <table class="table table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Part No.</th>
                                <th scope="col">Unit Cost</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Cost (£)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            if($orderNums != 0){
                                for($i = 0; $i < sizeof($orderNums); $i++){
                                    $query[$i] = findPOP($conn,$orderNums[$i]['orderNum']);
                                }
                                $total = 0;

                                for($i = 0; $i < sizeof($query); $i++){
                                    $pinfo[$i] = findPartInfo($conn,$query[$i]["partsCode"]);
                                    $price = $pinfo[$i]["price"];
                                    $quant = $query[$i]["quantity"];
                                    $subtotal = $price * $quant;
                                    $total = $total + $subtotal;
                                    echo 
                                    "
                                    <tr>
                                        <th scope='row'>".$pinfo[$i]["partName"]."</th>
                                        <td>".$query[$i]["partsCode"]."</td>
                                        <td>".$price."</td>
                                        <td>".$quant."</td>
                                        <td>".$subtotal."</td>
                                    </tr>
                                    ";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <?php
                if($hours != 0 || !empty($hours)){
                    $labour = $rate * $hours;
                    echo
                    "
                    <div class='row justify-content-center'>
                        <div class='col-md-auto'>
                            <div class='invoice-labour-hours'>
                                <p class='card-text bold'>Labour</p>
                                <p class='card-text'>Rate: £".$rate."/h</p>
                                <p class='card-text'>Total Hours: ".$hours."h</p>
                                <p class='card-tex'>Labour Price: £".$labour."</p>
                                <p class='card-tex'>VAT: £".$labour*0.2."</p>
                                <p class='card-tex'>Labour Price with VAT: £".$labour + $labour*0.2 ."</p>

                            </div>
                        </div>

                        <div class='col-md-auto'>
                            <div class='invoice-labour-hours'>
                                <p class='card-text bold'>Total</p>
                                <p class='card-text'>Parts Total: £".$total."</p>
                                <p class='card-text'>Parts VAT: £".$total*0.2."</p>
                                <p class='card-tex'>Total Parts Price with VAT: £".$total + $total*0.2."</p>
                                <p class='card-tex'>Grand Total: £".$labour + $labour*0.2 + $total + $total*0.2."</p>
                            </div>
                        </div>
                    </div>
                    ";
                }

            ?>

            <div class="center invoice-thankyou">
                <p class="card-text thankyou">Thank you for your valued custom. We look forward to receiving your payment in due course.</p>
                <p class="card-text thankyou text-align-left">Yours sincerely,</p>
                <p class="card-text thankyou text-align-left"><?php echo $_SESSION["name"]; ?></p>


            </div>
        </div>
    </div>
</div>
<div class="invoice bottom buttons center">
    <button type="button" onclick="printDiv('printableArea')" class="btn btn-warning">Print</button>
    <button type='button' onclick='cardPayment()' class='btn btn btn-info'>Card Payment</button>

</div>