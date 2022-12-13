<div class="row btm card bg-light jobsCard">

    <div class="card-header">
        Booking ID: <?php echo $jobsTable[$uid]['bookingsID'];?><span id="jobID">Job ID: <?php echo $jobsTable[$uid]['jobID']; ?></span>
    </div>
    <div id="printableArea">
            <div class="col-md-auto jobCardLeft">
                <?php
                    echo
                    "  <p class='card-jobtext'><b>Vehicle Registration Number:</b> ".$vehReg."</p>
                        <p class='card-jobtext'><b>Make:</b> ".$vehMake."</p>
                        <p class='card-jobtext'><b>Model:</b> ".$vehModel."</p>
                        <p class='card-jobtext'><b>Repair Bay:</b> ".$jobsTable[$uid]['repairBay']."</p>
                        <p class='card-jobtext'><b>Description of Work Required:</b></p>
                        <div class='dowReq'>
                                <ol class='card-dow'>
                                    <li>".$jobsTable[$uid]['dow']."</li>
                                </ol>
                        </div>
                        <p class='card-jobtext'><b>Estimated Time:</b> ".$jobsTable[$uid]['jobTimeE']."</p>";
                ?>
            </div>

            <div class="col-md-auto jobCardRight">
                <?php
                    echo 
                    "   <p class='card-jobtext'><b>Mechanic Assigned:</b> ".$mInfo["name_first"]." ".$mInfo["name_last"]."</p>
                        <p class='card-jobtext'><b>Date Booked in:</b> ".$jobsTable[$uid]['jobDate']."</p>
                        <p class='card-jobtext'><b>Customer Name:</b> ".$userInfo["name_first"]." ".$userInfo["name_last"]."</p>
                        <p class='card-jobtext'><b>Tel:</b> ".$userInfo["tel"]."</p>

                        <div class='jobSheetCompleted' id='jobSheetCompleted'>
                                <p class='card-jobtext'><b>Description of Work Carried Out:</b></p>
                                <div class='dowCo'>
                                    <ol class='card-dow'>
                                            <li>".$jobsTable[$uid]['dow_co']."</li>
                                    </ol>
                                </div>
                                <p class='card-jobtext'><b>Time taken:</b> ".$jobsTable[$uid]['jobTime']."</p>
                        </div>";
                ?>
            </div>
    </div>

    <div class="btmcenter jobbuttons">
            <button type="button" onclick="assignMechanic()" class="btn btn-outline-info">Assign</button>
            <button type="button" onclick="location.href='../admin.php?page=jobs&jid=<?php echo $jobsTable[$uid]['jobID'].'&sid='.$uid;?>&f=modify'" class="btn btn-outline-secondary">Modify</button>
            <button type="button" onclick="printDiv('printableArea')" class="btn btn-outline-warning">Print</button>
            <?php
                if(empty($jobsTable[$uid]['jobTime']) || $jobsTable[$uid]['jobTime'] == ""){
                    echo 
                        "
                        <form action='assets/php/jback.php' method='POST'>
                            <input type='id' class='hiddenfields' name='jid' value='".$jobsTable[$uid]['jobID']."'>
                            <button type='submit' name='setCompleted' class='btn btn-outline-success'>Completed</button>
                        </form>
                        "
                    ;
                }else{
                    echo
                    "
                        <form action='assets/php/jback.php' method='POST'>
                            <input type='id' class='hiddenfields' name='jid' value='".$jobsTable[$uid]['jobID']."'>
                            <button type='submit' name='createInvoice' class='btn btn-outline-success'>Create Invoice</button>
                        </form>

                    ";
                }
            ?>
    </div>

    <div class="btm mechanic-assign hiddenfields input-group input-group-sm mb-3" id="mechanicInputJobs">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Mechanic ID</span>
        </div>
        <form action="assets/php/jback.php" class="assignMechanicForm" method="POST">
            <input type='submit' class='hiddenfields' name='jid' value='<?php echo $jobsTable[$uid]['jobID'];?>'>
            <input type="text" class="form-control" name="assignMechanic" id="assignmechanicID" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </form>
    </div>

    <!-- Items used for Job -->
    <?php
        findOrderNo($conn,$jobsTable[$uid]['jobID']);
        if(sizeof($orderNums) == 0){
            $hidden = "hiddenfields";
        }
    ?>

    <div class="<?php echo $hidden; ?>jobCardBottom">
        <div id="jobPartsList">
            <h6 class="jobPartTableTitle">Parts Used</h6>
            <table class=" table jobPartsTable table-responsive">
                <thead class="thead-dark">
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Part #</th>
                            <th scope="col">Quantity</th>

                        </tr>
                </thead>

                <tbody>
                    <?php
                        for($i = 0; $i < sizeof($orderNums); $i++){
                            $query[$i] = findPOP($conn,$orderNums[$i]['orderNum']);
                        }

                        for($i = 0; $i < sizeof($query); $i++){
                            $pinfo[$i] = findPartInfo($conn,$query[$i]["partsCode"]);
                            echo 
                            "
                            <tr>
                                <th scope='row'>".$pinfo[$i]["partName"]."</th>
                                <td>".$query[$i]["partsCode"]."</td>
                                <td>".$query[$i]["quantity"]."</td>
                            </tr>
                            ";
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
