<?php
        // Credentials
        $servername = 'localhost';
        $username = 'byteme';
        $passworddb = '';
        $database = 'byteme';
        // Connection
        $conn = new mysqli($servername,$username,$passworddb,$database);
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: ".$connect_error);
        }
?>
