<?php
    function image($nrp){
        include 'connection.php';
        $query = "SELECT * FROM user WHERE nrp_nip='$nrp'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        $foto = '';

        if($user['role'] == "Admin")
            $foto = '../../public/img/profileAdmin.svg';
        else{
            if($user['foto'] == ''){
                if($user['jenisKelamin'] == "Perempuan")
                    $foto = '../../public/img/profileWoman.svg';
                else
                    $foto = '../../public/img/profileMan.svg';
            } else 
                $foto = '../../public/img/'.$user['foto'];
        }

        return $foto;
    }
    
?>