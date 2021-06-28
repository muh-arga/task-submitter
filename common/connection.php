<?php 
    $username = 'root';
    $pass = 'Maxikola12881';
    $servername = 'localhost';
    $dbname = 'taster';
    $conn = mysqli_connect($servername, $username, $pass, $dbname);
    if(!$conn){
        die("Connection error".mysqli_connect_error($conn));
    }
?>