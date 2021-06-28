<?php 
    include 'connection.php';

    $kelasQuery = "SELECT * FROM kelas";
    $kelasResult = mysqli_query($conn, $kelasQuery);
    if(!$kelasResult){
        echo "Error: ".mysqli_error($conn);
    }
?>