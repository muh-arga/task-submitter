<?php 
    session_start();
    if ($_SESSION['role'] != "Admin") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getImg.php';
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];
        $userID = $_SESSION['id'];
        
        $query = "SELECT nrp_nip, U.nama nama, email, jenisKelamin, agama, kota, kelasID, K.id, K.nama kelas FROM user U, kelas K WHERE U.kelasID=K.id AND role='Mahasiswa'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Error: ".mysqli_error($conn); 
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
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group d-flex align-items-center justify-content-between">
                                <span class="col-10"
                                    style="width: 300px;text-align: right;"><?= $role.' | '.$nama; ?></span>
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="p-0 btn col-2">
                                    <img width="42" class="rounded-circle" src="<?php echo image($userID); ?>" alt="">
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">
                                    <a href="../../common/logout.php" tabindex="0" class="dropdown-item">Logout</a>
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
                                <a href="student.php" class="mm-active">
                                    <i class="las la-graduation-cap"></i> Mahasiswa
                                </a>
                                <a href="class.php" class="">
                                    <i class="las la-university"></i> Kelas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <header>
                        <h3>Daftar Mahasiswa</h3>
                    </header>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <div class="btn-actions-pane-right">
                                        <div role="group" class="btn-group-sm btn-group">
                                            <a href="student-add.php"><button
                                                    class="active btn btn-outline-success">Tambah</button></a>
                                        </div>
                                    </div>
                                </div>
                                <?php if(mysqli_num_rows($result) == 0) : ?>
                                <center>Belum ada Data</center>
                                <?php else : ?>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">NRP</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Kelas</th>
                                                <th class="text-center">Jenis Kelamin</th>
                                                <th class="text-center">Agama</th>
                                                <th class="text-center">Kota</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            <?php foreach($result as $user) : ?>
                                            <tr>
                                                <td class="text-center text-muted">#<?= $i; ?></td>
                                                <td class="text-center"><?= $user['nrp_nip']; ?></td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="25" class="rounded-circle"
                                                                        src="<?php echo image($user['nrp_nip']); ?>"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div><?= $user['nama']; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $user['email']; ?></td>
                                                <td class="text-center"><?= $user['kelas']; ?></td>
                                                <td class="text-center"><?= $user['jenisKelamin']; ?></td>
                                                <td class="text-center"><?= $user['agama']; ?></td>
                                                <td class="text-center"><?= $user['kota']; ?></td>
                                                <td class="text-center">
                                                    <a href="student-edit.php?nrp=<?= $user['nrp_nip']; ?>"><button
                                                            type="button" id="PopoverCustomT-1"
                                                            class="btn btn-outline-warning btn-sm">ubah</button></a>
                                                    <a
                                                        href="../../controller/admin/student-del.php?nrp=<?= $user['nrp_nip']; ?>"><button
                                                            type="button" id="PopoverCustomT-1"
                                                            class="btn btn-outline-danger btn-sm">hapus</button></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endif; ?>
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