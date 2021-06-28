<?php 
    session_start();
    if ($_SESSION['role'] != "Dosen") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getDeadline.php';
        include '../../common/getImg.php';
        
        $classID = $_GET['id'];
        $nip = $_SESSION['id'];
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];

        $taskQuery = "SELECT T.id, T.nama, T.batas, S.nama subject, S.id subjectID FROM tugas T, mata_kuliah S WHERE T.mataKuliahID=S.id AND kelasID=$classID AND dosenNIP='$nip' ORDER BY batas DESC";
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
        <header>
            <h4>Daftar Tugas</h4>
        </header>
        <span class="back d-flex justify-content-start">
            <a href="class.php?id=<?= $classID; ?>">Kembali</a>
        </span>
        <?php if(mysqli_num_rows($task) == 0) : ?>
        <div>
            <center>
                <h3>Belum ada tugas</h3>
            </center>
        </div>
        <?php else : ?>
        <div class="mt-4 d-flex flex-wrap">
            <?php foreach($task as $data) : ?>
            <a href="task-detail.php?id=<?= $data['id']; ?>&classID=<?= $classID; ?>&subjectID=<?= $data['subjectID']; ?>&subject=<?= $data['subject']; ?>"
                class="me-3 mb-5">
                <div class="card-task px-3 py-3" style="background-color: #a7e0eb;">
                    <div class="row">
                        <ul>
                            <li>
                                <h6>
                                    <?= $data['subject']; ?>
                                </h6>
                            </li>
                            <li class="mt-3">
                                <h5>
                                    <?= $data['nama']; ?>
                                </h5>
                            </li>
                            <div class="mt-3 deadline d-flex flex-row">
                                <?php $deadline = lectureDeadline($data['id'], $data['subjectID'], $data['batas']); 
                                        echo $deadline;
                                    ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>