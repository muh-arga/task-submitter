<?php 
    $username = 'root';
    $pass = '';
    $servername = 'localhost';
    $dbname = 'taster';
    $conn = mysqli_connect($servername, $username, $pass, $dbname);
    if(!$conn){
        die("Connection error".mysqli_connect_error($conn));
    }
?>