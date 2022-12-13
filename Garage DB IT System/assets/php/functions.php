<?php

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
          return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

function fillFields(&$var,$type){
    if(empty($var) || $var == "" || !isset($var)){
        if($type == 1){
            $var = "Empty";
        }
        else{
            $var = 0;
        }
    }
    return $var;
}

function emptyInputSignup($email,$password){
      $result;
      if(empty($email) || empty($password)){
          $result = true;
      }
      else{
          $result = false;
      }
      return $result;
}

function invalidEmail($email){
      $result;
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $result = true;
      }
      else{
          $result = false;
      }
      return $result;
}

function validateString($string){
      $string;
      $string = filter_var($string,FILTER_SANITIZE_STRING);
      return $string;
}

function validateNumber($number){
    $number;
    $number = filter_var($number,FILTER_SANITIZE_NUMBER_INT);
    return $number;
}

function validateFloat($float){
    $float;
    $float = filter_var($float,FILTER_VALIDATE_FLOAT);
    return $float;
}

function unameDupp($conn,$email){
    $sql = "SELECT * FROM userAccounts WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../admin.php?page=users&error=emailTaken");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
  

function createUser($conn,$name_last,$name_first,$email,$password,$tel,$fax,$address,$postcode,$role){
    $getDate = date('d-m-y');
    $name_first = validateString($name_first);
    $name_last = validateString($name_last);
    $tel = validateNumber($tel);
    $fax = validateNumber($fax);
    $role = validateNumber($role);
    $address = validateString($address);
    $postcode = validateString($postcode);


    $sql = "INSERT INTO userAccounts (name_last,name_first,email,password,tel,fax,address,postcode,role) VALUES (?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../?error=stmtfailure");
        exit();
    }

    $hashedPwd = password_hash($password,PASSWORD_BCRYPT);

    mysqli_stmt_bind_param($stmt,"sssssssss",$name_last,$name_first,$email,$hashedPwd,$tel,$fax,$address,$postcode,$role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $sql2 = "UPDATE userAccounts SET date='{$getDate}' WHERE email LIKE '{$email}';";
    mysqli_query($conn,$sql2);
    header("location: ../../admin.php?page=users&status=registered");
    exit();
}

function createCustomer($conn,$name_last,$name_first,$email,$tel,$fax,$address,$postcode){
    $getDate = date('d-m-y');
    $name_first = validateString($name_first);
    $name_last = validateString($name_last);
    $tel = validateNumber($tel);
    $fax = validateNumber($fax);
    $address = validateString($address);
    $postcode = validateString($postcode);


    $sql = "INSERT INTO userAccounts (name_last,name_first,email,tel,fax,address,postcode) VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../?error=stmtfailure");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sssssss",$name_last,$name_first,$email,$tel,$fax,$address,$postcode);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $sql2 = "UPDATE userAccounts SET date='{$getDate}' WHERE email LIKE '{$email}';";
    mysqli_query($conn,$sql2);
    header("location: ../../admin.php?page=users&status=registered+customer");
    exit();
}


function loginUser($conn,$email,$password){
    $unameDupp = unameDupp($conn,$email);
    if($email === false){
        header("location: ../../?error=loginFailure");
        exit();
    }
    $passwordhashed = $unameDupp["password"];
    $checkpwd = password_verify($password,$passwordhashed);

    if($checkpwd === false){
        header("location: ../../?error=loginFailure+password");
        exit();
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["email"] = $unameDupp["email"];
        $sql = "SELECT role FROM userAccounts WHERE email LIKE '{$email}';";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        $uinfo = findUserInfoEmail($conn,$email);
        $name_first  = $uinfo['name_first'];
        $_SESSION["name"] = $name_first;

        if ($resultCheck > 0){
            $_SESSION["role"] = mysqli_fetch_object($result)->role;
        }
        if($_SESSION["role"] > 0){
            header("location: ../../admin.php");
        }
        else{
            header("location: ../../");
        }

        exit();
    }
}

function getUsers($conn){
    GLOBAL $users;
    $sql = "SELECT id,name_last,name_first,email,tel,fax,role,notes,date,address,postCode FROM userAccounts;";
    $result = mysqli_query($conn,$sql);
    $users = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
    }
}

function checkRole(&$users,$i){
    switch($users[$i]['role']){     
        case 0:
            $role = "Customer";
            break;
        case -1:
            $role = "Account Holder";
            break;
        case 1:
            $role = "Receptionist";
            break;
        case 2:
            $role = "Mechanic";
            break;
        case 3:
            $role = "Foreperson";
            break;
        case 4:
            $role = "Franchisee";
            break;
        case 5:
            $role = "Administrator";
            break;
        default: 
            $role = "Customer";
    }
    return $role;
}

function idToRole($role){
    switch($role){
        case 0:
            $role = "Customer";
            break;
        case -1:
            $role = "Account Holder";
            break;
        case 1:
            $role = "Receptionist";
            break;
        case 2: 
            $role = "Mechanic";
            break;
        case 3: 
            $role = "Foreperson";
            break;
        case 4:
            $role = "Franchisee";
            break;
        case 5: 
            $role = "Administrator";
            break;
        default: 
            $role = "Customer";
    }
    return $role;
}

function getVehAmount($conn,$uid){
    GLOBAL $vehAmount;
    $sql = "SELECT * FROM vehicles WHERE userAccountID = '{$uid}';";
    $result = mysqli_query($conn,$sql);
    $vehAmount = mysqli_num_rows($result);
    return $vehAmount;
}

function getVehicles($conn,$uid){
    if($uid != 0){
        GLOBAL $vehicles;
        $sql = "SELECT * FROM vehicles WHERE userAccountID = '{$uid}';";
        $result = mysqli_query($conn,$sql);
        $vehicles = array();
        $vehAmount = mysqli_num_rows($result);
        if($vehAmount > 0){
            while($row = mysqli_fetch_assoc($result)){
                $vehicles[] = $row;
            }
        }
    }
}

function createVehicle($conn,$rid,$vehMake,$vehModel,$vehReg,$vehSerial,$vehChas,$vehColor,$MOT){
    $rid = validateNumber($rid);
    $vehMake = validateString($vehMake);
    $vehModel = validateString($vehModel);
    $vehReg = validateString($vehReg);
    $vehSerial = validateString($vehSerial);
    $vehChas = validateString($vehChas);
    $vehColor = validateString($vehColor);
    $MOT = validateString($MOT);


    $sql = "INSERT INTO vehicles (userAccountID,vehMake,vehModel,vehReg,vehSerial,vehChasNum,vehColor,motExp) VALUES (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../admin.php?page=users&error=stmtfailure");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssssssss",$rid,$vehMake,$vehModel,$vehReg,$vehSerial,$vehChas,$vehColor,$MOT);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location:../../admin.php?page=users&status=success+veh+added");
    exit();
}

function deleteVehicle($conn,$vid){
    $sql = "DELETE FROM vehicles WHERE vehID = '{$vid}';";
    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=users&status=success+veh+deleted");
    }else{
        header("location:../../admin.php?page=users&error=database+failure");
    }
    exit();
}

function updateUser($conn,$uid,$email,$tel,$fax,$address,$postCode,$role,$notes){

    $uid = validateNumber($uid);
    $tel = validateNumber($tel);
    $fax = validateNumber($fax);
    $address = validateString($address);
    $postcode = validateString($postcode);
    $notes = validateString($notes);

    if($role == "Choose..."){
        $sql = "UPDATE userAccounts SET email = '{$email}', tel = '{$tel}', fax = '{$fax}', address = '{$address}', postCode = '{$postCode}', notes = '{$notes}' WHERE id = '{$uid}';";
        mysqli_query($conn,$sql);

        header("location:../../admin.php?page=users&status=success+updated");
        exit();
    }
    else{
        $role = validateNumber($role);
        $sql = "UPDATE userAccounts SET email = '{$email}', tel = '{$tel}', fax = '{$fax}', address = '{$address}', postCode = '{$postCode}', role = '{$role}', notes = '{$notes}' WHERE id = '{$uid}';";
    }

    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=users&status=success+updated");
    }else{
        header("location:../../admin.php?page=users&error=data+failure");
    }
    exit();

}

function getDiscountInfo($conn,$uid){
    $sql = "SELECT * FROM discount WHERE userAccountID = '{$uid}';";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        $result = mysqli_fetch_assoc($result);
    }else{
        $result = 'none';
    }
    return $result; 
}

function updateDiscount($conn,$uid,$discount,$discountNum){
    $discountNum = validateNumber($discountNum);
    $discount = validateString($discount);
    $dp = getDiscountInfo($conn,$uid);

    if($dp != "none"){
        if($discount == "Choose..." && !empty($discountNum)){
            $sql = "UPDATE discount SET discountNum = '{$discountNum}' WHERE userAccountID = '{$uid}';";
            mysqli_query($conn,$sql);
        }else if($discount != "Choose..."){
            $sql = "UPDATE discount SET discountType = '{$discount}' WHERE userAccountID = '{$uid}';";
            mysqli_query($conn,$sql);
        }
        if($discount != "Choose..." && !empty($discountNum)){
            $sql = "UPDATE discount SET discountType = '{$discount}', discountNum = '{$discountNum}' WHERE userAccountID = '{$uid}';";
            mysqli_query($conn,$sql);
        }
        if(mysqli_affected_rows($conn) > 0){
            header("location:../../admin.php?page=users&status=success+updated");
        }else{
            header("location:../../admin.php?page=users&error=data+failure");
        }
    }else{
        if($discount == "" || $discountNum == "" || empty($discountNum)){
            header("location:../../admin.php?page=users&error=no+input+discount");
            exit();
        }
        $sql = "INSERT INTO discount (userAccountID,discountType,discountNum) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=users&error=stmtfailure");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sss",$uid,$discount,$discountNum);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $error = mysqli_error($conn);
        if(!empty($error)){
            header("location:../../admin.php?page=users&error=database+failure");
            exit();
        }
        header("location:../../admin.php?page=users&status=success+discount+created");
    }

    exit();
}

function deleteUser($conn,$uid){
    try{
        $sql = "DELETE FROM userAccounts WHERE id = '{$uid}';";
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            header("location:../../admin.php?page=users&status=success+deleted");
        }else{
            header("location:../../admin.php?page=users&error=database+failure");
        }
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=users&error=delete+associated");
        exit();
    }
}
function allVehIDs($conn){
    GLOBAL $vehIDs;
    $sql = "SELECT vehID FROM vehicles;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $vehIDs[] = $row;
        }
    }
}

function lastBooking($conn){
    $sql = "SELECT bookingID FROM bookings ORDER BY bookingID DESC LIMIT 1;";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->bookingID;
    return $result;
}

function findVehInfo($conn,$vehID){
    $sql = "SELECT * FROM vehicles WHERE vehID = '{$vehID}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    return $result;
}

function findUserInfo($conn,$uid){
    $sql = "SELECT * FROM userAccounts WHERE id = '{$uid}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    return $result;
}

function findUserInfoEmail($conn,$email){
    $sql = "SELECT * FROM userAccounts WHERE email = '{$email}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    return $result;
}

function findVehID($conn,$bookingID){
    $sql = "SELECT vehID FROM bookings WHERE bookingID = '{$bookingID}' ;";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->vehID;
    return $result;
}

function getBookingID($conn,$jobID){
    $sql = "SELECT bookingsID FROM jobs WHERE jobID = '{$jobID}' ;";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->bookingsID;
    return $result;
}

function getInvoiceDate($conn,$iid){
    $sql = "SELECT date FROM invoice WHERE invoiceNo = '{$iid}' ;";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->invoiceNo;
    return $result;
}




function createBooking($conn,$vehID,$bookingType,$bookingDate){
    $vehID = validateNumber($vehID);
    $bookingType = validateString($bookingType);
    $bookingDate = validateString($bookingDate);

    $sql = "INSERT INTO bookings (vehID,type,date) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../admin.php?page=bookings&error=stmtfailure");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sss",$vehID,$bookingType,$bookingDate);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $error = mysqli_error($conn);
    if(!empty($error)){
        header("location:../../admin.php?page=bookings&error=database+failure");
        echo "<h1>".$error."</h1>";
        exit();
    }

    $bid = lastBooking($conn);
    header("location:../../admin.php?page=bookings&vehID=".$vehID."&bid=".$bid."&status=success");
    exit();

}

function changeBooking($conn,$bookingID,$vehID,$bookingType,$bookingDate){
    $bookingID = validateNumber($bookingID);
    $vehID = validateNumber($vehID);
    $bookingType = validateString($bookingType);
    $bookingDate = validateString($bookingDate);

    $sql = "UPDATE bookings SET vehID = '{$vehID}', type = '{$bookingType}', date = '{$bookingDate}' WHERE bookingID = '{$bookingID}';";
    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=bookings&status=success+updated");
    }else{
        header("location:../../admin.php?page=bookings&status=data+failure");
    }
    exit();
}

function listBookings($conn){
    GLOBAL $bookingsTable;
    $sql = "SELECT * FROM bookings;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $bookingsTable[] = $row;
        }
    }
}

function deleteBooking($conn,$bid){
    try{
        $sql = "DELETE FROM bookings WHERE bookingID = '{$bid}';";
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            header("location:../../admin.php?page=bookings&status=success+deleted");
        }else{
            header("location:../../admin.php?page=bookings&status=database+failure");
        }
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=bookings&error=delete+associated");
        exit();
    }
}

function deleteJob($conn,$jid){
    try{
        $sql = "DELETE FROM jobs WHERE jobID = '{$jid}';";
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            header("location:../../admin.php?page=jobs&status=success+deleted");
        }else{
            header("location:../../admin.php?page=jobs&error=database+failure");
        }
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=jobs&error=delete+associated");
        exit();
    }
}

function createJob($conn,$bookingID,$dow,$jobTime,$rbay,$mechanic){
    try{
        $bookingID = validateNumber($bookingID);
        $dow = validateString($dow);
        $jobTime = validateFloat($jobTime);
        $rbay = validateNumber($rbay);
        $mechanic = validateNumber($mechanic);
        $jobDate = date('d-m-y');
    
        $sql = "INSERT INTO jobs (bookingsID,jobDate,dow,jobTimeE,repairBay,mechanic) VALUES (?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=bookings&error=stmtfailure");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ssssss",$bookingID,$jobDate,$dow,$jobTime,$rbay,$mechanic);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location:../../admin.php?page=bookings&status=job+created");   
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=bookings&error=database+error");
        $error = mysqli_error($conn);
        if(!empty($error)){
            header("location:../../admin.php?page=bookings&error=job+database+error");
            echo "<h1>".$error."</h1>";
            exit();
        }
    }
}

function createJobCompleted($conn,$bookingID,$dow,$jobTime,$rbay,$mechanic){
    try{
        $bookingID = validateNumber($bookingID);
        $dow = validateString($dow);
        $jobTime = validateFloat($jobTime);
        $rbay = validateNumber($rbay);
        $mechanic = validateNumber($mechanic);
        $jobDate = date('d-m-y');

        $sql = "INSERT INTO jobs (bookingsID,jobDate,dow,dow_co,jobTimeE,jobTime,repairBay,mechanic) VALUES (?,?,?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=bookings&error=stmtfailure");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ssssssss",$bookingID,$jobDate,$dow,$dow,$jobTime,$jobTime,$rbay,$mechanic);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location:../../admin.php?page=bookings&status=job+created");
        exit();   
    }catch(Exception $ex){
        header("location:../../admin.php?page=bookings&error=database+error");
        $error = mysqli_error($conn);
        if(!empty($error)){
            header("location:../../admin.php?page=bookings&error=some+error");
            echo "<h1>".$error."</h1>";
            exit();
        }
    }
}

function listJobs($conn){
    GLOBAL $jobsTable;
    $sql = "SELECT * FROM jobs;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $jobsTable[] = $row;
        }
    }
}

function getJobInfo($conn,$jobID){
    $sql = "SELECT * FROM jobs WHERE jobID = '{$jobID}';";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        $result = mysqli_fetch_assoc($result);
    }else{
        $result = 'ERROR';
    }
    return $result; 
}

function editJob($conn,$jobID,$dow,$et,$vehBay,$mechanicID,$completed){
    try{
        $jobID = validateNumber($jobID);
        $vehBay = validateNumber($vehBay);
        $mechanicID = validateNumber($mechanicID);
        $dow = validateString($dow);
        $et = validateFloat($et);
        $jobDate = date('d-m-y');
    
        if(!$completed){    
            $sql = "UPDATE jobs SET dow = '{$dow}', jobTimeE = '{$et}', jobTime = '', repairBay = '{$vehBay}', mechanic = '{$mechanicID}' WHERE jobID = '{$jobID}';";
        }else{
            $sql = "UPDATE jobs SET jobDate = '{$jobDate}', dow_co = '{$dow}', jobTime = '{$et}', repairBay = '{$vehBay}', mechanic = '{$mechanicID}' WHERE jobID = '{$jobID}';";
        }
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            header("location:../../admin.php?page=jobs&status=success+updated");
        }else{
            header("location:../../admin.php?page=jobs&error=data+failure");
        }
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=jobs&status=job+database+error");
        exit();

    }
   
}

function assignMechanic($conn,$jid,$mid){
    $sql = "UPDATE jobs SET mechanic = '{$mid}' WHERE jobID = '{$jid}';";
    mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=jobs&status=mechanic+assigned");
    }else{
        header("location:../../admin.php?page=jobs&error=data+failure");
    }
    exit();
}

function setJobCompleted($conn,$jobID){
    $sql = "SELECT dow, jobTimeE FROM jobs WHERE jobID = '{$jobID}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    $dow = $result["dow"];
    $jobTime = $result["jobTimeE"];

    $sql = "UPDATE jobs SET dow_co = '{$dow}', jobTime = '{$jobTime}' WHERE jobID = '{$jobID}';";
    mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=jobs&status=success+completed");
    }else{
        header("location:../../admin.php?page=jobs&error=job+database+failure");
    }
    
    exit();
}

function orderPart($conn,$id,$partsCode,$quant){
    try{
        $orderDate = date('d-m-y');
        $partsCode = validateString($partsCode);

        if(!is_numeric($id)){
            $uinfo = findUserInfoEmail($conn,$id);
            $id = $uinfo['id'];
        }

        $sql = "INSERT INTO partsOrder (userAccountsID,date) VALUES (?,?);";
        $stmt = mysqli_stmt_init($conn);
       
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=buyparts&error=stmtfailure");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$id,$orderDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        partsOrderParts($conn,$partsCode,$quant);
        header("location:../../admin.php?page=buyparts&status=parts+queued");
    }catch(Exception $ex){
        header("location:../../admin.php?page=buyparts&error=data+failure");

        if(!empty($error || !empty($stmterror))){
            header("location:../../admin.php?page=buyparts&error=some+error");
            $_COOKIE["stmterror"] = "Error: %s.\n".$stmt->error;
            exit();
        }
        if(!$stmt->execute()) {
            $_COOKIE["stmterror2"] = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $error = mysqli_error($conn);
        $stmterror = $stmt->error;
        $mysqlerr = $conn->error;
        $_COOKIE["mysqlerr"] = "Execute failed: ".$mysqlerr;
        exit();
    }
}

function orderPartJob($conn,$id,$jobID,$partsCode,$quant){
    try{
        $orderDate = date('d-m-y');
        $partsCode = validateString($partsCode);
    
        if(!is_numeric($id)){
            $uinfo = findUserInfoEmail($conn,$id);
            $id = $uinfo['id'];
        }
    
        $sql = "INSERT INTO partsOrder (userAccountsID,date,jobID) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=buyparts&error=stmtfailure+job");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"sss",$id,$orderDate,$jobID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        partsOrderParts($conn,$partsCode,$quant);
        header("location:../../admin.php?page=buyparts&status=parts+ordered+job");
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=buyparts&error=data+failure");

        if(!empty($error || !empty($stmterror))){
            header("location:../../admin.php?page=buyparts&error=some+error+job");
            $_COOKIE["stmterror"] = "Error: %s.\n".$stmt->error;
            exit();
        }
        if(!$stmt->execute()) {
            $_COOKIE["stmterror2"] = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $error = mysqli_error($conn);
        $stmterror = $stmt->error;
        $mysqlerr = $conn->error;
        $_COOKIE["mysqlerr"] = "Execute failed: ".$mysqlerr;
        exit();
    }
}

function getOrderNo($conn){
    $sql = "SELECT orderNum FROM partsOrder ORDER BY orderNum DESC LIMIT 1;";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->orderNum;
    return $result; 
}

function getStock($conn,$partsCode){
    $sql = "SELECT stock FROM inventory WHERE partsCode = '{$partsCode}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->stock;
    return $result; 
}

function updateStock($conn,$newstock,$partsCode){
    $sql = "UPDATE inventory SET stock = '{$newstock}' WHERE partsCode = '{$partsCode}';";
    $result = mysqli_query($conn,$sql);
}

function setUsed($conn,$partsCode,$used){
    $sql = "UPDATE inventory SET used = used + '{$used}' WHERE partsCode = '{$partsCode}';";
    $result = mysqli_query($conn,$sql);
}

function partsOrderParts($conn,$partsCode,$quant){
    try{
        $orderNo = getOrderNo($conn);
        $quant = validateNumber($quant);


        $stock = getStock($conn,$partsCode);
        if($stock >= $quant){
            $newstock = $stock - $quant;
            setUsed($conn,$partsCode,$quant);
            updateStock($conn,$newstock,$partsCode);
        }
        else if($stock < $quant){
            header("location:../../admin.php?page=buyparts&error=parts+no+stock");
            exit();
        }
    
        $sql = "INSERT INTO partsOrder_parts (orderNum,partsCode,quantity) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=buyparts&error=stmtfailure+pop");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"sss",$orderNo,$partsCode,$quant);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        createCustomerPartInvoice($conn,$orderNo);

        header("location:../../admin.php?page=buyparts&status=parts+ordered+pop");
    }catch(Exception $ex){
        header("location:../../admin.php?page=buyparts&error=data+failure");

        $error = mysqli_error($conn);
        $stmterror = $stmt->error;
        if(!empty($error || !empty($stmterror))){
            header("location:../../admin.php?page=buyparts&error=some+error+pop");
            $_COOKIE["stmterror"] = "Error: %s.\n".$stmt->error;
            exit();
        }
    }
}

function findOrderNo($conn,$jobID){
    GLOBAL $orderNums;
    $sql = "SELECT orderNum FROM partsOrder WHERE jobID = '{$jobID}';";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $orderNums[] = $row;
        }
    }
}

function findOrderNumUID($conn,$orderNum){
    $sql = "SELECT userAccountsID FROM partsOrder WHERE orderNum = '{$orderNum}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->userAccountsID;
    return $result; 
}

function findPOP($conn,$cond){
    $sql = "SELECT * FROM partsOrder_parts WHERE orderNum = '{$cond}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    return $result;
}


function findPartInfo($conn,$partCode){
    $sql = "SELECT * FROM parts WHERE partCode = '{$partCode}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    return $result;
}

function findDiscountPlan($conn,$uid){
    $sql = "SELECT * FROM discount WHERE userAccountID = '{$uid}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    return $result;  
}

function listAllParts($conn){
    GLOBAL $allPartsTable;
    $sql = "SELECT * FROM parts;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $allPartsTable[] = $row;
        }
    }
}

function listInvoices($conn){
    GLOBAL $invoiceTable;
    $sql = "SELECT * FROM invoice;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $invoiceTable[] = $row;
        }
    }
}

function calculateTotalPartsPrice($conn,$orderNo){
    $pop = findPOP($conn,$orderNo);
    $partsCode = $pop["partsCode"];
    $quantity = $pop["quantity"];
    $findparts = findPartInfo($conn,$partsCode);
    $price = $findparts["price"];
    $totalPrice = $quantity * $price;
    $gmarkup = $totalPrice * 0.3; // garage markup
    $vat = $totalPrice * 0.2; // vat
    $totalPrice = $totalPrice + $vat + $gmarkup;
    return $totalPrice;
}

function getLaborRate($conn,$mechanic){
    $sql = "SELECT wage FROM salary WHERE userAccountID = '{$mechanic}';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_object($result)->wage;
    return $result;
}

function calculateLabor($conn,$jobID){
    $jd = getJobInfo($conn,$jobID);
    $m = $jd["mechanic"];
    $t = $jd["jobTime"];
    $wage = getLaborRate($conn,$m);
    $rate = $t * $wage;
    $vat = $rate * 0.2; // vat
    $rate = $rate + $vat;
    return $rate;
}

function checkLatePayment($conn,$date){

    $currdate = date('d-m-y');
    list($d, $m, $y) = explode('-', $date);
    list($d2, $m2, $y2) = explode('-', $currdate);

    return $m2 - $m;
}

function createCustomerPartInvoice($conn,$partsOrderNum){
    try{
        $date = date('d-m-y');
        $totalPrice = calculateTotalPartsPrice($conn,$partsOrderNum);

        $uid = findOrderNumUID($conn,$partsOrderNum);
        $dp = findDiscountPlan($conn,$uid);

        if($dp["discountType"] == "Fixed Discount"){
            $discount = $dp["discountNum"];
            $discount = $discount/100;
            $discount = $totalPrice * $discount;
            $totalPrice = $totalPrice - $discount;
        }
    
        $sql = "INSERT INTO invoice (partsOrderNum,totalPrice,date) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=buyparts&error=stmtfailure+invoice");
            exit();
        }
    

        mysqli_stmt_bind_param($stmt,"sss",$partsOrderNum,$totalPrice,$date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        header("location:../../admin.php?page=buyparts&status=parts+ordered+invoice");
        exit();

    }catch(Exception $ex){
        header("location:../../admin.php?page=buyparts&error=data+failure+invoice");

        $error = mysqli_error($conn);
        $stmterror = $stmt->error;
        if(!empty($error || !empty($stmterror))){
            header("location:../../admin.php?page=buyparts&error=some+error+invoice");
            $_COOKIE["stmterror"] = "Error: %s.\n".$stmt->error;
            exit();
        }
    }
}

function createJobInvoice($conn,$jobID,$sum){
    try{
        $date = date('d-m-y');
        $rate = calculateLabor($conn,$jobID);
        $totalPrice = $sum + $rate;

        $uid = findOrderNumUID($conn,$partsOrderNum);
        $dp = findDiscountPlan($conn,$uid);

        if($dp["discountType"] == "Fixed Discount"){
            $discount = $dp["discountNum"];
            $discount = $discount/100;
            $discount = $totalPrice * $discount;
            $totalPrice = $totalPrice - $discount;
        }
    
        $sql = "INSERT INTO invoice (jobID,totalPrice,date) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../../admin.php?page=jobs&error=stmtfailure+invoice");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt,"sss",$jobID,$totalPrice,$date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        header("location:../../admin.php?page=jobs&status=parts+ordered+job+invoice");
        exit();
    }catch(Exception $ex){
        header("location:../../admin.php?page=jobs&error=data+failure+job+invoice");

        $error = mysqli_error($conn);
        $stmterror = $stmt->error;
        if(!empty($error || !empty($stmterror))){
            header("location:../../admin.php?page=jobs&error=some+error+job+invoice");
            $_COOKIE["stmterror"] = "Error: %s.\n".$stmt->error;
            exit();
        }
    }
}

function payInvoice($conn,$iid){
    $sql = "UPDATE invoice SET paid = 1 WHERE invoiceNo = '{$iid}';";
    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=invoice&status=success+paid");
    }else{
        header("location:../../admin.php?page=invoice&error=database+failure");
    }
    exit();
}

function deleteInvoice($conn,$iid){
    $sql = "DELETE FROM invoice WHERE invoiceNo = '{$iid}';";
    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn) > 0){
        header("location:../../admin.php?page=invoice&status=success+deleted");
    }else{
        header("location:../../admin.php?page=invoice&error=database+failure");
    }
    exit();
}


function listInventory($conn){
    GLOBAL $inventory;
    $sql = "SELECT * FROM inventory;";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $inventory[] = $row;
        }
    }
}


function createDBBackup(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $database = 'byteme';
    $user = 'byteme';
    $pass = 'J2OoPHaujGvLvUIGUfQjsmqYrEq3NzF';
    $host = 'localhost';
    $DBdate = date('d-m-y');
    $dir = '/webspace/dump.sql';


    echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

    exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

    var_dump($output);

    $filename = 'bytemeGaritsBackup'.$DBdate.'.sql';

    //Check the file exists or not
    if(file_exists($dir)) {
        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($dir));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($dir);
        header("location:../../admin.php?page=users&status=success+db");


        //Terminate from the script
        die();
    }else{
        echo "File does not exist.";
        exit();
    }
}

/**
 * @function    restoreDatabaseTables
 * @author      CodexWorld
 * @link        http://www.codexworld.com
 * @usage       Restore database tables from a SQL file
**/

function restoreDatabaseTables($conn, $filePath){
    // Connect & select the database
    $conn;

    // Temporary variable, used to store current query
    $templine = '';
    
    // Read in entire file
    $lines = file($filePath);
    
    $error = '';
    
    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }
        
        // Add this line to the current segment
        $templine .= $line;
        
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$conn->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $conn->error . '<br /><br />';
            }
            
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}
