<?php 
    function isExist($nrp){
        include 'connection.php';
        $query = "SELECT nrp_nip FROM user WHERE nrp_nip='$nrp'";
        $result = mysqli_query($conn, $query);
        if($result) 
            return true;
        else 
            return false;
    }

    function emailExist($email){
        include 'connection.php';
        $emailQuery = "SELECT email FROM user WHERE email='$email'";
        $emailResult = mysqli_query($conn, $emailQuery);
        if($emailResult) 
            return true;
        else
            return false;
    }
?>