<?php 
    
    function compare($taskID){
        date_default_timezone_set("Asia/Makassar");
        include 'connection.php';
        $query = "SELECT batas FROM tugas WHERE id=$taskID";
        $result = mysqli_query($conn, $query);
        $status = 'belum diubah';
        $currentDateTime = date('Y-m-d H:i:s');
        if(mysqli_num_rows($result) > 0){
            $batas = mysqli_fetch_assoc($result);
                if($currentDateTime <= $batas['batas'])
                    $status = 'Tepat Waktu';
                else
                    $status = "Terlambat";
            }
        return $status;
    }

?>