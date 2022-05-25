<?php
    require_once("database-function.php");
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-commerce";
    
    $conn = mysqli_connect($hostname,$username,$password,$dbname);
    $index = "http://localhost/hanna-store/";
    $admin = "http://localhost/hanna-store/admin/";
?>