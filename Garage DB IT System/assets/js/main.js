var parts = window.location.search.substr(1).split("&");
var $_GET = {};
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}

state = true;
function hiddenFields(){
      if(state == true){
            state = false;
            for(var i = 0; i<=6; i++){
                  document.getElementById("addfields"+i).style.display = "block";
            }
      }
      else{
            state = true; 
            for(var i = 0; i<=6; i++){
                  document.getElementById("addfields"+i).style.display = "none";
            }
      }
}

mstate = true;
function assignMechanic(){
      if(mstate == true){
            mstate = false;
            document.getElementById("mechanicInputJobs").style.display = "flex";
      }
      else{
            mstate = true;
            document.getElementById("mechanicInputJobs").style.display = "none";
      }
}

bstate = true;
function createBooking(){
      if(bstate == true){
            bstate = false;
            document.getElementById("createBooking").style.display = "flex";
      }
      else{
            bstate = true;
            document.getElementById("createBooking").style.display = "none";
      }
}

bjstate = true;
function createBookingWithJob(){
      if(bjstate == true){
            bjstate = false;
            document.getElementById("bookingWithJob").style.display = "block";
      }
      else{
            bjstate = true;
            document.getElementById("bookingWithJob").style.display = "none";
      }
}

astate = true;
uvstate = true;
function showUserVehicles(toggle){
      if(toggle == 1){
            if(uvstate == true){
                  uvstate = false;
                  document.getElementById("userVehicles").style.display = "block";
            }
            else{
                  uvstate = true;
                  document.getElementById("userVehicles").style.display = "none";
            }
      }
      else if(toggle == 2){
            if(uvstate == true){
                  uvstate = false;
                  document.getElementById("userVehicles2").style.display = "block";
            }
            else{
                  uvstate = true;
                  document.getElementById("userVehicles2").style.display = "none";
            }
      }
      else if(toggle == 3){
            if(astate == true){
                  astate = false;
                  document.getElementById("addvehicles").style.display = "block";
            }
            else{
                  astate = true;
                  document.getElementById("addvehicles").style.display = "none";
            }
      }
}


function getDate(){
      var today = new Date();
      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
      document.getElementById("todaysDate").innerHTML = date;

      return date;
}

function addUser(){
      if($_GET['action'] == "register"){
            location.href="../admin.php?page=users";
      }
      else{
            location.href="../admin.php?page=users&action=register";
      }
}

function printDiv(divName) {
      // https://stackoverflow.com/questions/16894683/how-to-print-html-content-on-click-of-a-button-but-not-the-page
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
 
      document.body.innerHTML = printContents;
 
      window.print();
 
      document.body.innerHTML = originalContents;
 }

plist = true;
function showPartsList(){
      if(plist == true){
            plist = false;
            document.getElementById("partsTableCodes").style.display = "table";
      }
      else{
            plist = true;
            document.getElementById("partsTableCodes").style.display = "none";
      }
}

cpment = true;
function cardPayment(){
      if(cpment == true){
            cpment = false;
            document.getElementById("cardPayment").style.display = "flex";
      }
      else{
            cpment = true;
            document.getElementById("cardPayment").style.display = "none";
      }
}

