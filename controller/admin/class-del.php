<?php 
    include '../../common/connection.php';
    $id = $_GET['id'];
    $query = "DELETE FROM kelas WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Error: ".mysqli_error($conn);
    } else
        header('Location: ../../pages/admin/class-list.php');
?>