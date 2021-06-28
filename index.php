<?php 
    session_start();
    
    if(isset($_SESSION['user_is_logged_in']) == true) {
        if($_SESSION['role'] === 'Admin')
            header('Location: pages/admin');
        elseif($_SESSION['role'] === 'Dosen')
            header('Location: pages/lecture/lecture-home.php');
        elseif($_SESSION['role'] == 'Mahasiswa')
            header('Location: pages/student/student-home.php');
    }
    
    $error = '';
    if(isset($_POST['email']) && isset($_POST['password'])){
        include "common/connection.php";
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            if(password_verify($password, $data['password'])){
                $_SESSION['user_is_logged_in'] = true;
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['role'] = $data['role'];
                $_SESSION['id'] = $data['nrp_nip'];
                if($_SESSION['role'] === 'Admin')
                    header('Location: pages/admin');
                elseif($_SESSION['role'] === 'Dosen')
                    header('Location: pages/lecture/lecture-home.php');
                elseif($_SESSION['role'] === 'Mahasiswa'){
                    $_SESSION['kelas'] = $data['kelasID'];
                    header('Location: pages/student/student-home.php');
                }
                exit;
            } else {
                $error = 'wrong username/password';
            }
        } else {
            $error = 'wrong username/password';
        }
        mysqli_close($conn);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>TasTer</title>

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center" style="color: #fff;">
                            <i class="las la-user"></i>
                        </div>
                        <h3 class="text-center mb-4 font-weight-bold" style="color: #a7e0eb;">TasTer</h3>
                        <?php if ($error != '') {?>
                        <p align="center" style="color: red;">
                            <i class="mt-2 las la-exclamation-circle"></i><?= $error; ?>
                        </p>
                        <?php } ?>
                        <form action="" method="post" class="login-form">
                            <div class="form-group">
                                <input type="email" class="form-control rounded-left" name="email" placeholder="Email"
                                    required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn form-control rounded submit px-3"
                                    name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
    (function($) {

        "use strict";


    })(jQuery);
    </script>

</body>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="/__/firebase/8.6.8/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="/__/firebase/8.6.8/firebase-analytics.js"></script>

<!-- Initialize Firebase -->
<script src="/__/firebase/init.js"></script>

</html>