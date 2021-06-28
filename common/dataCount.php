<?php 
    function countStudent($id){
        include 'connection.php';
        $query = "SELECT COUNT(*) jmlh FROM user WHERE kelasID=$id AND role='Mahasiswa' GROUP BY kelasID";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        
        return $data['jmlh'];
    }

    function countSubject($id){
        include 'connection.php';
        $query = "SELECT COUNT(*) jmlh FROM mata_kuliah WHERE kelasID=$id";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        
        return $data['jmlh'];
    }

?>