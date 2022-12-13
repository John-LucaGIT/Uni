<html lang = "en" xml:lang = "en">
      <head>
            <title>BTM - GARITS : Stock Report</title>
      </head>

      <body>
            <!-- Page Title -->

            <div class="btm black-link pageTitle">
                  <a href="../admin.php">
                        <i class="btm backButton fa-2x fa-solid fa-circle-left"></i>
                  </a>
                  <h2 class="btmTitle">Stock Report</h2>
            </div>

            <!-- Start of Stock Report Section -->

<!-- 
            <div class="mt-2 stockreport search">
                  <p>Report Criteria</p>
                  <label for="FirstDate ">From: </label>
                  <input type="date" id="FirstDate " name="FirstDate">
                  <label for="EndDate ">To: </label>
                  <input type="date" id="EndDate " name="EndDate ">

                  <label for="SerchPart ">Search part</label>
                  <input type="text" id="SerchPart " name="SerchPart"/>

                  <button type="submit" class="btn btn-sm btn-info">Generate report</button>
            </div> -->
			<div id="printableArea">


				<div class="card stockreport">
					<!-- <h3 center>Stock Report</h3> -->
					<table class="btmtable table stockreport table-hover table-striped table-responsive">
							<thead class="thead-dark ">
								<tr>
										<th scope="col ">Part Code</th>
										<th scope="col ">Stock Level</th>
										<th scope="col ">Unit Cost</th>
										<th scope="col ">Used</th>
										<th scope="col ">Delivery</th>
										<th scope="col ">Low Level Threeshold</th>
								</tr>
							</thead>
								<tbody>
							<?php
								listInventory($conn);
								for($i = 0; $i < sizeof($inventory); $i++){
									echo "
									<tr>
										<th>".$inventory[$i]["partsCode"]."</th>
										<th>".$inventory[$i]["stock"]."</th>
										<th>".$inventory[$i]["cost"]."</th>
										<th>".$inventory[$i]["used"]."</th>
										<th>".$inventory[$i]["delivery"]."</th>
										<th>".$inventory[$i]["LLT"]."</th>
									</tr>
									";
								}


							?>


							</tbody>
					</table>
				</div>
			</div>

            <div class="bottom">
                  <button type="button"  onclick="printDiv('printableArea')" class="btmcenter block btn btn-warning">Print Report</button>
            </div>
      </body>
</html>
