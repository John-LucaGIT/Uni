<div class="btm card bg-light jobsCard">
    <form action="assets/php/jback.php" method="POST">
        <div class="card-header">
            <span class="jobNumber"><b>Job Number:</b><span id="jobNumber"> <?php echo $jobsTable[$uid]['jobID'];?></span></span>
            <span class="bookingID"><b>Booking ID:</b><span id="bookingID"> <?php echo $jobsTable[$uid]['bookingsID'];?></span></span>
        </div>

            <div class="jobCardLeft">
                <?php
                echo
                " 
                    <input type='id' class='hiddenfields' name='jid' value='".$jobsTable[$uid]['jobID']."'>
                    <p class='card-jobtext'><b>Vehicle Registration Number:</b> ".$vehReg."</p>
                    <p class='card-jobtext'><b>Make:</b> ".$vehMake."</p>
                    <p class='card-jobtext'><b>Model:</b> ".$vehModel."</p>
                    <p class='card-jobtext'><b>".$dow."</b></p>
                    
                    <div class='dowReq-form'>
                        <div class='form-group'>
                            <textarea class='form-control' name='dow' rows='5' id='comment'>".$jobsTable[$uid]['dow']."</textarea>
                        </div> 
                    </div>

                    <p class='card-jobtext'><b>".$time." (hh:mm):</b></p>

                    <div class='btm jobtime input-group input-group-sm mb-3' id='estimatedJobTime'>
                        <div class='input-group-prepend'>
                                <span class='input-group-text' id='inputGroup-sizing-sm'>Time</span>
                        </div>
                        <input type='float' class='form-control' name='et' aria-label='Sizing example input' value='".$timeValue."' aria-describedby='inputGroup-sizing-sm'>
                    </div>";
                ?>
            </div>

            <div class="jobCardRight">
                <?php
                    echo
                    "
                        <p class='card-jobtext'><b>Mechanic Assigned:</b> ".$mInfo["name_first"]." ".$mInfo["name_last"]."</p>
                        <p class='card-jobtext'><b>Date Booked in:</b> ".$jobsTable[$uid]['jobDate']."</p>
                        <p class='card-jobtext'><b>Customer Name:</b> ".$userInfo["name_first"]." ".$userInfo["name_last"]."</p>
                        <p class='card-jobtext'><b>Tel:</b> ".$userInfo["tel"]."</p>

                        <div class='btm jobCompleteCheckBox form-check form-check-inline'>
                            <input class='form-check-input' name='isCompleted' type='checkbox' id='jobComCheckBox' value='true' ".$checked." />
                            <label class='form-check-label' for='jobComCheckBox'>Job Completed</label>
                        </div>

                        <div class='btm mechanic-assign input-group input-group-sm mb-3 mt-3' id='mechanicInputJobs'>
                            <div class='input-group-prepend'>
                                <span class='input-group-text' id='inputGroup-sizing-sm'>Vehicle Bay</span>
                            </div>
                            <input type='text' class='form-control' name='vehicleBay' aria-label='Vehicle Bay Input' value='".$jobsTable[$uid]['repairBay']."' aria-describedby='inputGroup-sizing-sm'>
                        </div>

                        <div class='btm mechanic-assign input-group input-group-sm mb-5' id='mechanicInputJobs'>
                            <div class='input-group-prepend'>
                                    <span class='input-group-text' id='inputGroup-sizing-sm'>Mechanic ID</span>
                            </div>
                            <input type='text' class='form-control' name='mechanicID' aria-label='Mechanic ID Input' value='".$jobsTable[$uid]['mechanic']."' aria-describedby='inputGroup-sizing-sm'>
                        </div>"
                    ;
                ?>
                <button type="button" onclick="location.href='../admin.php?page=jobs'" class="btn btn-outline-secondary">Cancel</button>
                <button type="submit" name="deletejob" class="btn btn-outline-danger">Delete</button>
                <button type="submit" name="editJob" class="btn btn-outline-success">Save</button>
            </div>
    </form>
</div>