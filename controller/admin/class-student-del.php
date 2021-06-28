<?php 
    include '../../common/connection.php';
    $nrp = $_GET['nrp'];
    $classID = $_GET['classID'];
    $className = $_GET['nama'];
    $query = "DELETE FROM user WHERE nrp_nip='$nrp'";
    if(!mysqli_query($conn, $query)){
        echo "Error: ".mysqli_error($conn);
    } else 
    header('Location: ../../pages/admin/class-student.php?id='.$classID.'&nama='.$className);
?>