<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "ofdms";

    if (!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
        die("Connection not established");
    }
?>