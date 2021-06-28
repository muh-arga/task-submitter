<?php 
    function fileExist($nrp, $task){
        include 'connection.php';
        $query = "SELECT mahasiswaNRP FROM file WHERE mahasiswaNRP='$nrp' AND tugasID=$task";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            return true;
        } else
            return false;
    }
?>