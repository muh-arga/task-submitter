<?php 
    function getUser($role){
        include 'connection.php';
        $query = "SELECT * FROM user WHERE role='$role'";
        $user = mysqli_query($conn, $query);
        if(!$user){
            echo "Error: ".mysqli_error($conn);
        } else 
            return $user;
    }

?>