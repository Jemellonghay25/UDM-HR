<?php
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "hris";
    $db = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbname);
    mysqli_set_charset($db,"utf8"); // charset change
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>