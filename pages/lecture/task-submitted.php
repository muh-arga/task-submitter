<?php 
    session_start();
    if ($_SESSION['role'] != "Dosen") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getDeadline.php';
        include '../../common/getImg.php';
        
        $id = $_GET['id'];
        $classID = $_GET['classID'];
        $subjectID = $_GET['subjectID'];
        $subject = $_GET['subject'];
        $nip = $_SESSION['id'];
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];

        $query = "SELECT F.id, F.nama, F.path, F.nilai, F.uploaded_at waktu, F.mahasiswaNRP nrp, F.status, U.nama mahasiswa FROM file F, user U WHERE F.mahasiswaNRP=U.nrp_nip AND tugasID=$id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Error: ".mysqli_connect($conn);
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="../../assets/css/home.css" rel="stylesheet">
    <link href="../../assets/css/main.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="lecture-home.php">TaSter</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="lecture-home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-tasks.html">Tugas</a>
                    </li>
                </ul>
                <div class="profile">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <span><?= $role.' | '.$nama; ?></span>
                        </li>
                        <li class="nav-item ms-4">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <div class="profile-photo" style="background-image: url(<?php echo image($nip); ?>);">
                                </div>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <a href="../../common/logout.php" tabindex="0" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section class="task mt-4">
        <header>
            <h4><?= $subject; ?></h4>
        </header>
        <span class="back d-flex justify-content-start">
            <a
                href="task-detail.php?id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>">Kembali</a>
        </span>
        <div class="mt-4 app-main__outer">
            <div class="app-main__inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">
                                Daftar tugas
                            </div>
                            <?php if(mysqli_num_rows($result) == 0) : ?>
                            <center>Belum ada Data</center>
                            <?php else : ?>
                            <div class="table-responsive">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">NRP</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Waktu</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php foreach($result as $file) : ?>
                                        <tr>
                                            <td class="text-center text-muted">#<?= $i; ?></td>
                                            <td class="text-center"><?= $file['nrp']; ?></td>
                                            <td class="text-center">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img width="40" class="rounded-circle"
                                                                    src="assets/images/avatars/4.jpg" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div><?= $file['mahasiswa']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><?= $file['waktu']; ?></td>
                                            <td class="text-center"
                                                style="color: <?php $color = getColor($file['id']); echo $color; ?>">
                                                <?= $file['status']; ?></td>
                                            <td class="text-center"><?= $file['nilai']; ?></td>
                                            <td class="text-center">
                                                <a
                                                    href="task-score.php?fileID=<?= $file['id']; ?>&id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>"><button
                                                        type="button" id="PopoverCustomT-1"
                                                        class="btn btn-outline-success btn-sm">nilai</button></a>
                                                <a href="../../common/download.php?fileID=<?= $file['id']; ?>"><button
                                                        type="button" id="PopoverCustomT-1"
                                                        class="btn btn-outline-primary btn-sm">Download</button></a>
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
    </section>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>