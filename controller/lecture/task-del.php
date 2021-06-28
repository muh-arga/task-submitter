<?php 
    include '../../common/connection.php';
    $id = $_GET['id'];
    $classID = $_GET['classID'];
    $subjectID = $_GET['subjectID'];
    $subject = $_GET['subject'];
    $query = "DELETE FROM tugas WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Error: ".mysqli_error($conn);
    } else
        header('Location: ../../pages/lecture/lecture-task.php?id='.$classID.'&subjectID='.$subjectID.'&subject='.$subject);
?>