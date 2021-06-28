<?php 
    session_start();
    if ($_SESSION['role'] != "Dosen") {
        header("Location: ../../index.php");
        exit;
    }else {
        include '../../common/connection.php';
        include '../../common/getImg.php';
        
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];
        $id = $_GET['id'];
        $classID = $_GET['classID'];
        $subjectID = $_GET['subjectID'];
        $subject = $_GET['subject'];
        $fileID = $_GET['fileID'];
        $nip = $_SESSION['id'];
        $msg = '';

        $query = "SELECT F.nama, F.uploaded_at, F.mahasiswaNRP, F.id, F.saran, F.nilai, F.status, F.note, F.path, T.nama tugas, T.batas, T.deskripsi FROM file F, tugas T WHERE F.tugasID=T.id AND F.id=$fileID";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Error: ".mysqli_connect($conn);
        }

        if(isset($_POST['edit'])){
            $nilai = $_POST['nilai'];
            $saran = $_POST['saran'];
            $editQuery = "UPDATE file SET nilai=$nilai, saran='$saran' WHERE id=$fileID";
            $edit = mysqli_query($conn, $editQuery);
            if(!$edit){
                $msg = "Gagal menilai tugas";
            } else
                header('Location: task-submitted.php?id='.$id.'&classID='.$classID.'&subjectID='.$subjectID.'&subject='.$subject);
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
            <a class="navbar-brand" href="lecture-home.php">TaSter</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="lecture-home.php">Home</a>
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
        <?php if($msg != '') : ?>
        <div class="pe-0 alert alert-danger alert-dismissible fade show" role="alert">
            <?= $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
        <header>
            <?php $tugas = mysqli_fetch_assoc($result) ?>
            <h4><?= $subject.' - '.$tugas['mahasiswaNRP']; ?></h4>
        </header>
        <span class="back d-flex justify-content-start">
            <a
                href="task-submitted.php?id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>">Kembali</a>
            <span class="ms-4 submit">Kirim</span>
        </span>
        <?php if(mysqli_num_rows($result) == 0) : ?>
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
                    <li class="mb-4">
                        <h5>Status</h5>
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
                        <h5>Catatan Siswa</h5>
                    </li>
                </ul>
            </div>
            <div class="row col-9 task-content">
                <?php foreach($result as $data) : ?>
                <form
                    action="task-score.php?fileID=<?= $fileID; ?>&id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>"
                    method="post">
                    <ul class="d-flex flex-column">
                        <li class="mb-4" style="height: 35px;">
                            <h5><?= $data['deskripsi']; ?></h5>
                        </li>
                        <li class="mb-4">
                            <h5><?= $data['batas']; ?></h5>
                        </li>
                        <li class="mb-4">
                            <h5><?= $data['status']; ?></h5>
                        </li>
                        <li class="mb-5" style="height: 25px;">
                            <textarea class="px-3 py-2" name="saran" id="saran" cols="80"
                                rows="1"><?= $data['saran']; ?></textarea>
                        </li>
                        <li class="mb-4" style="height: 25px;">
                            <input class="px-3" type="text" name="nilai" id="nilai" value="<?= $data['nilai']; ?>"
                                style="width: 60px; border-radius:5px; border: 1px solid black;">
                        </li>
                        <li class="mb-4 d-flex flex-row">
                            <h5 class="col-9"><?= $data['nama']; ?></h5>
                            <a href="../../common/download.php?fileID=<?= $data['fileID'];?>" class="col-2 ">
                                <i class="fas fa-file-download"></i>
                            </a>
                        </li>
                        <li class="mb-4">
                            <h5><?= $data['note']; ?></h5>
                        </li>
                        <button class="submitNote" type="submit" name="edit" hidden></button>
                    </ul>
                </form>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </section>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script src="../../assets/js/submitHandler.js"></script>
</body>

</html>