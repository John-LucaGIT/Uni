<?php
// this specific method of validation was inspired from https://www.youtube.com/watch?v=gCo6JqGMi30 ;

function emptyInputSignup($name_first,$name_last,$userName,$email,$phone,$password,$cpassword){
    $result;
    if(empty($name_first) || empty($name_last) || empty($userName) || empty($email) || empty($phone) || empty($password) || empty($cpassword)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidUname($userName){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){
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

function pwdMatch($password,$cpassword){
    $result;
    if($password !== $cpassword){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function unameDupp($conn,$userName,$email){
    $sql = "SELECT * FROM users WHERE userName = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../register?error=unameTaken");
        exit();

    }
    mysqli_stmt_bind_param($stmt,"ss",$userName,$email);
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

function createUser($conn,$name_last,$name_first,$userName,$email,$password,$phone,$newsletter){
    $sql = "INSERT INTO users (lastName,firstName,userName,email,password,phone,newsletter) VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../index?error=stmtfailure");
        exit();
    }

    $hashedPwd = password_hash($password,PASSWORD_BCRYPT);

    mysqli_stmt_bind_param($stmt,"sssssss",$name_last,$name_first,$userName,$email,$hashedPwd,$phone,$newsletter);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../register?error=none");
    exit();
}

function emptyInputLogin($userName,$password){
    $result;
    if (empty($userName) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn,$userName,$password){
    $unameDupp = unameDupp($conn,$userName,$userName);
    if($unameDupp === false){
        header("location: ../../login?error=loginFailure");
        exit();
    }
    $passwordhashed = $unameDupp["password"];
    $checkpwd = password_verify($password,$passwordhashed);

    if($checkpwd === false){
        header("location: ../../login?error=loginFailure");
        exit();
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["userName"] = $unameDupp["userName"];
        $_SESSION["email"] = $unameDupp["email"];
        header("location: ../../index");
        exit();
    }
}

function duppContact($conn,$time,$date){
    $result;
    $sql = mysqli_query("SELECT * FROM bookings WHERE time LIKE '{$time}' AND date LIKE '{$date}';");
    if(mysqli_num_rows($sql) !== 0){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emptyInputContact($name_last,$name_first,$email,$title,$date,$time){
    $result;
    if(empty($name_first) || empty($name_last) || empty($email) || empty($title) || empty($date) || empty($time)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function createContact($conn,$name_last,$name_first,$email,$title,$date,$time){
    $sql = "INSERT INTO bookings (lastName,firstName,email,title,date,time) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../../index?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ssssss",$name_last,$name_first,$email,$title,$date,$time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../contact?error=none");
    exit();
}
