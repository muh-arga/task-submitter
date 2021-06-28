<?php
    session_start();
    if ($_SESSION['role'] != "Admin") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/user_exist.php';
        include '../../common/getImg.php';

        $classID = $_GET['classID'];
        $className = $_GET['nama'];
        $tipe = $_SESSION['role'];
        $nama = $_SESSION['nama'];
        $userID = $_SESSION['id'];
        
        $msg = '';
        $nrpAlert = '';
        $emailAlert = '';

        if (isset($_POST['add'])) {

            $name = mysqli_real_escape_string($conn, $_POST['nama']);
            $role = $_POST['role'];
            $nrp = $_POST['nrp'];
            $email = $_POST['email'];
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $jenis = $_POST['jenis'];
            $agama = $_POST['agama'];
            $kota = $_POST['kota'];
            $foto = $_FILES['foto']['name'];
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            if($_FILES['foto']['name'] != ''){
                $uploadDir = '../../public/img/';
                $tmpName = $_FILES['foto']['tmp_name'];
                $foto = $_FILES['foto']['name'];
                $type = $_FILES['foto']['type'];
                $path = $uploadDir.$foto;
                if($type != "image/jpg" && $type != "image/png" && $type != "image/jpeg")
                    $msg = 'Format file tidak didukung';
                elseif($_FILES['foto']['size'] > 200000*10)
                    $msg = 'Ukuran file terlalu besar';
                else{
                    $move = move_uploaded_file($tmpName, $path);
                    if(!$move)
                        $msg = 'Gagal mengupload gambar';
                }
            }

            if(isExist($nrp)){
                $nrpAlert = 'NRP sudah terpakai';
            } elseif (emailExist($email)){
                $emailAlert = 'Email sudah terdaftar';
            }

            if($msg == ''){
                $query = "INSERT INTO user (nrp_nip, nama, email, password, kelasID, jenisKelamin, agama, kota, role, foto) VALUES('$nrp', '$name', '$email', '$hashPassword', $classID, '$jenis', '$agama', '$kota', '$role', '$foto')";
                $user = mysqli_query($conn, $query);
                if (!$user)
                    $msg = 'Gagal menambah data';
                else
                    header('Location: class-student.php?id='.$classID.'&nama='.$className);
            }
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Huge selection of charts created with the React ChartJS Plugin" />
    <meta name="msapplication-tap-highlight" content="no" />
    <!--
        =========================================================
        * ArchitectUI HTML Theme Dashboard - v1.0.0
        =========================================================
        * Product Page: https://dashboardpack.com
        * Copyright 2019 DashboardPack (https://dashboardpack.com)
        * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
        =========================================================
        * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
        -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link href="../../assets/css/main.css" rel="stylesheet" />
    <link href="../../assets/css/admin-card.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"><a href="index.php">TaSter</a></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group d-flex align-items-center justify-content-between">
                                        <span class="col-10"
                                            style="width: 300px;text-align: right;"><?= $tipe.' | '.$nama; ?></span>
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn col-2">
                                            <img width="42" class="rounded-circle" src="<?php echo image($userID); ?>"
                                                alt="">
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu dropdown-menu-right">
                                            <a href="../../common/logout.php" tabindex="0"
                                                class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboard</li>
                            <li>
                                <a href="lecture.php" class="">
                                    <i class="las la-user-tie"></i> Dosen
                                </a>
                                <a href="student.php" class="">
                                    <i class="las la-graduation-cap"></i> Mahasiswa
                                </a>
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <div class="profile-photo"
                                        style="background-image: url(../../assets/image/bersin.png);"></div>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">
                                    <a href="../../common/logout.php" tabindex="0" class="dropdown-item">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?php if($msg != '') : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $msg; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif ?>
                    <header>
                        <h3>Tambah Mahasiswa</h3>
                    </header>
                    <span class="mb-4 back d-flex justify-content-start">
                        <a href="class-student.php?id=<?= $classID; ?>&nama=<?= $className; ?>">Kembali</a>
                    </span>
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpane">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="position-relative row form-group">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input name="nama" id="nama" type="text" class="form-control" required />
                                            <input name="role" id="role" type="text" class="form-control"
                                                value="Mahasiswa" hidden />
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                                        <div class="col-sm-10" style="color: red;">
                                            <input name="nrp" id="nrp" type="text" class="form-control" required />
                                            <?php if($nrpAlert != '') : ?>
                                            <i class="mt-2 las la-exclamation-circle"></i><?= $nrpAlert; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10" style="color: red;">
                                            <input name="email" id="email" type="email" class="form-control" required />
                                            <?php if($emailAlert != '') : ?>
                                            <i class="mt-2 las la-exclamation-circle"></i><?= $emailAlert; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input name="password" id="password" type="password" class="form-control"
                                                required />
                                        </div>
                                    </div>
                                    <fieldset class="position-relative row form-group">
                                        <label for="jenis" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <div class="position-relative form-check">
                                                <input name="jenis" id="jenis" type="radio" class="form-check-input"
                                                    value="Laki - Laki" /> Laki - Laki
                                            </div>
                                            <div class="position-relative form-check">
                                                <input name="jenis" id="jenis" type="radio" class="form-check-input"
                                                    value="Perempuan" /> Perempuan
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="position-relative row form-group">
                                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                        <div class="col-sm-10">
                                            <select name="agama" id="agama" class="form-control">
                                                <option value="" disabled>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Katholik">Katholik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="kota" class="col-sm-2 col-form-label">kota</label>
                                        <div class="col-sm-10">
                                            <input name="kota" id="kota" type="text" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input name="foto" id="foto" type="file" class="form-control-file">
                                            <small class="form-text text-muted">Upload gambar dengan format jpg, jpeg,
                                                atau png dan ukuran kecil dari 2Mb.</small>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <button class="btn btn-outline-primary" name="add">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>