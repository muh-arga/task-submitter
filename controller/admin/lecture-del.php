<?php 
    include '../../common/connection.php';
    $nip = $_GET['nip'];
    $query = "DELETE FROM user WHERE nrp_nip='$nip'";
    if(!mysqli_query($conn, $query)){
        echo "Error: ".mysqli_error($conn);
    } else 
    header('Location: ../../pages/admin/lecture.php');
?>