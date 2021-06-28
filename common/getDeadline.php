<?php 
    include 'compareTime.php';

    function deadline($taskID, $fileID){
        include 'connection.php';

        $taskQuery = "SELECT * FROM tugas WHERE id=$taskID";
        $task = mysqli_query($conn, $taskQuery);
        if(mysqli_num_rows($task) > 0)
            $data = mysqli_fetch_assoc($task);

        $exist = false;

        $fileQuery = "SELECT * FROM file WHERE id=$fileID";
        $result = mysqli_query($conn, $fileQuery);
        if($result){
            if(mysqli_num_rows($result) > 0){
                $exist = true;
                $file = mysqli_fetch_assoc($result);
            } else
                $exist = false;
        }

        $status  = compare($taskID);

        $show = '';
        $color = '';

        if($status == 'Tepat Waktu')
            $color = '#08c26b';
        else
            $color = '#ce4e4e';

        if(!$exist){
            if($status == "Terlambat") {
                    $show = '<div class="time col-1">
                    <i class="far fa-clock" style="color: '.$color.'"></i>
                </div>
                <div class="col-10 ms-2 time-text d-flex flex-row justify-content-between">
                    <span style="color: '.$color.'">'.$data['batas'].'</span>
                    <i class="fas fa-times-circle" style="color: #ce4e4e;"></i>
                </div>';
            } elseif($status == "Tepat Waktu"){
                    $show = '<div class="time col-1">
                    <i class="far fa-clock" style="color: '.$color.'"></i>
                </div>
                <div class="col-10 ms-2 time-text d-flex flex-row justify-content-between">
                    <span style="color: '.$color.'">'.$data['batas'].'</span>
                    <i class="fas fa-minus-circle" style="color: #ceae4e;"></i>
                </div>';
            }
        } elseif($exist) {
            if($file['status'] == "Tepat Waktu") {
                $show = '<div class="time col-1">
                <i class="far fa-clock" style="color: '.$color.'"></i>
            </div>
            <div class="col-10 ms-2 time-text d-flex flex-row justify-content-between">
                <span style="color: '.$color.'">'.$data['batas'].'</span>
                <i class="fas fa-check-circle" style="color: #08c26b;"></i>
            </div>';
            }   elseif ($file['status'] == "Terlambat")
                    $show = '<div class="time col-1">
                    <i class="far fa-clock" style="color: '.$color.'"></i>
                </div>
                <div class="col-10 ms-2 time-text d-flex flex-row justify-content-between">
                    <span style="color: '.$color.'">'.$data['batas'].'</span>
                    <i class="fas fa-check-circle" style="color: #ce4e4e;"></i>
                </div>';
        }

        return $show;
    }

    function lectureDeadline($taskID, $subjectID, $date){
        include 'connection.php';
        $query = "SELECT * FROM tugas WHERE id=$taskID AND mataKuliahID=$subjectID";
        $task = mysqli_query($conn, $query);

        $status  = compare($taskID);

        $show = '';
        $color = '';

        if($status == 'Tepat Waktu')
            $color = '#08c26b';
        else
            $color = '#ce4e4e';
        $show = '<div class="time col-1">
        <i class="far fa-clock" style="color: '.$color.';"></i>
    </div>
    <div class="col-10 ms-2 time-text d-flex flex-row justify-content-between">
        <span style="color: '.$color.';">'.$date.'</span>
    </div>';

        return $show;

    }

    function getColor($fileID){
        include 'connection.php';
        $query = "SELECT * FROM file WHERE id=$fileID";
        $result = mysqli_query($conn, $query);

        $color = '';

        $data = mysqli_fetch_assoc($result);
        if($data['status'] == "Tepat Waktu")
            $color = '#08c26b';
        else
            $color = '#ce4e4e';
        
        return $color;
    }

?>