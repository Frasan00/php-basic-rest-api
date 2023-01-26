<?php
function connect(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpbasicrestapi";

    $conn = mysqli_connect($host, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>