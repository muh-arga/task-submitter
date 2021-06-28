<?php 
    session_start();
    if ($_SESSION['role'] != "Mahasiswa") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getImg.php';

        $id = $_GET['id'];
        $classID = $_SESSION['kelas'];
        $subjectID = $_GET['subjectID'];
        $subject = $_GET['subject'];
        $nrp = $_SESSION['id'];
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];

        $taskQuery = "SELECT T.id, T.nama, T.batas, T.deskripsi, F.path, F.nilai, F.nama tugas, F.note, F.saran, F.tugasID, F.mahasiswaNRP nrp, F.id fileID, F.path FROM tugas T
        join mata_kuliah S on (T.mataKuliahID=S.id)
        LEFT JOIN (SELECT * FROM file
        WHERE tugasID=$id and mahasiswaNRP='$nrp') as F on (T.id=F.tugasID) 
        where kelasID=$classID AND T.id=$id";
        $task = mysqli_query($conn, $taskQuery);
        if(!$task){
            echo "Error: ".mysqli_error($conn);
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
    <link href="../../assets/css/card.css" rel="stylesheet">
    <link href="../../assets/css/student-task.css" rel="stylesheet">

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
            <a class="navbar-brand" href="student-home.php">TaSter</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="student-home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-tasks.php">Tugas</a>
                    </li>
                </ul>
                <div class="profile">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <span><?= $role.' | '.$nama; ?></span>
                        </li>
                        <li class="nav-item ms-4">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <div class="profile-photo" style="background-image: url(<?php echo image($nrp); ?>);">
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
            <?php $tugas = mysqli_fetch_assoc($task) ?>
            <h4><?= $subject.' - '.$tugas['nama']; ?></h4>
        </header>
        <span class="back d-flex justify-content-start">
            <a href="student-task.php?subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>">Kembali</a>
            <a href="task-edit.php?id=<?= $id; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>&taskName=<?= $tugas['nama']; ?>"
                class="ms-4" style="color: #FBC6A4 ;">Edit</a>
        </span>
        <?php if(mysqli_num_rows($task) == 0) : ?>
        <div>
            <center>
                <h3>Belum ada tugas</h3>
            </center>
        </div>
        <?php else : ?>
        <div class="mt-4 task-detail d-flex flex-row justify-content-between">
            <div class="row col-3">
                <ul class="d-flex flex-column">
                    <li class="mb-4">
                        <h5>Deskripsi</h5>
                    </li>
                    <li class="mb-4">
                        <h5>Batas Pengumpulan</h5>
                    </li>
                    <li class="mb-5">
                        <h5>Saran / Koreksi</h5>
                    </li>
                    <li class="mb-4">
                        <h5>Nilai</h5>
                    </li>
                    <li class="mb-4">
                        <h5>File Tugas</h5>
                    </li>
                    <li class="mb-4">
                        <h5>Catatan Anda</h5>
                    </li>
                </ul>
            </div>
            <div class="row col-9 task-content">
                <?php foreach($task as $data) : ?>
                <ul class="d-flex flex-column">
                    <li class="mb-4" style="height: 35px;">
                        <h5><?= $data['deskripsi']; ?></h5>
                    </li>
                    <li class="mb-4">
                        <h5><?= $data['batas']; ?></h5>
                    </li>
                    <li class="mb-5" style="height: 25px;">
                        <h5><?= $data['saran']; ?></h5>
                    </li>
                    <li class="mb-4" style="height: 25px;">
                        <h5><?= $data['nilai']; ?></h5>
                    </li>
                    <li class="mb-4 d-flex flex-row">
                        <h5 class="col-9"><?= $data['tugas']; ?></h5>
                        <a href="<?php if($data['fileID'] == '') echo '#'; else echo '../../common/download.php?fileID='.$data['fileID']; ?>"
                            class="col-2 ">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </li>
                    <li class="mb-4">
                        <h5><?= $data['note']; ?></h5>
                    </li>
                </ul>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </section>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>