<?php 
    session_start();
    if ($_SESSION['role'] != "Dosen") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getImg.php';
        
        $id = $_GET['id'];
        $classID = $_GET['classID'];
        $subjectID = $_GET['subjectID'];
        $subject = $_GET['subject'];
        $nip = $_SESSION['id'];
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];
        
        $query = "SELECT * FROM tugas WHERE id=$id";
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
        <?php if(mysqli_num_rows($result) > 0) : ?>
        <?php foreach($result as $task) : ?>
        <header>
            <h4><?= $subject.' - '.$task['nama']; ?></h4>
        </header>
        <span class="back d-flex justify-content-start">
            <a
                href="lecture-task.php?id=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>">Kembali</a>
            <a href="task-submitted.php?id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>"
                class="ms-4" style="color: #A7C5EB ;">Dikumpul</a>
            <a href="task-edit.php?id=<?= $task['id']; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>"
                class="ms-4" style="color: #FBC6A4 ;">Edit</a>
            <a href="../../controller/lecture/task-del.php?id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>"
                class="ms-4" style="color: #eba7a7 ;">Hapus</a>
        </span>
        <div class="mt-4 task-detail d-flex flex-row justify-content-between">
            <div class="row col-3">
                <ul class="d-flex flex-column">
                    <li class="mb-4">
                        <h5>Judul</h5>
                    </li>
                    <li class="mb-4">
                        <h5>Batas Pengumpulan</h5>
                    </li>
                    <li class="mb-5">
                        <h5>Deskripsi</h5>
                    </li>
                </ul>
            </div>
            <div class="row col-9 task-content">
                <ul class="d-flex flex-column">
                    <li class="mb-4">
                        <h5><?= $task['nama']; ?></h5>
                    </li>
                    <li class="mb-4">
                        <h5><?= $task['batas']; ?></h5>
                    </li>
                    <li class="mb-5" style="height: 25px;">
                        <h5><?= $task['deskripsi']; ?></h5>
                    </li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif ?>
    </section>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>