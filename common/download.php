<?php 
    include 'connection.php';
    $id = $_GET['fileID'];
    $query = "SELECT nama, type, size, note, path FROM file WHERE id=$id";
    $result = mysqli_query($conn, $query) or die('Error, query failed');
    list($name, $type, $size, $content, $path) = mysqli_fetch_array($result);
    header("Content-Disposition: attachment; filename=$name");
    header("Content-length: $size");
    header("Content-type: $type");
    readfile($path);
    echo $content;
?>