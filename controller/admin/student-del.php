<?php 
    include '../../common/connection.php';
    $nrp = $_GET['nrp'];
    $query = "DELETE FROM user WHERE nrp_nip='$nrp'";
    if(!mysqli_query($conn, $query)){
        echo "Error: ".mysqli_error($conn);
    } else 
    header('Location: ../../pages/admin/student.php');
?>