<?php

        // Credentials
        $servername = 'localhost';
        $username = '';
        $passwordsec = '';
        $database = '';
        // Connection
        $conn = new mysqli($servername,$username,$passwordsec,$database);
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: ".$connect_error);
            echo"<h1>Connection Failed please contact Hoster.</h1>";
        }
?>

