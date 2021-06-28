<?php 
    include '../../common/connection.php';
    $id = $_GET['id'];
    $classID = $_GET['classID'];
    $query = "DELETE FROM mata_kuliah WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Error: ".mysqli_error($conn);
    } else
        header('Location: ../../pages/admin/class-subject.php?id='.$classID);
?>