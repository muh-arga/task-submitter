<?php 
    session_start();
    if ($_SESSION['role'] != "Dosen") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getImg.php';
        
        $nip = $_SESSION['id'];
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];
        $query = "SELECT K.id, K.nama, COUNT(*) jumlah FROM  mata_kuliah M, kelas K, user U WHERE M.kelasID=K.id AND M.dosenNIP=U.nrp_nip AND U.role='Dosen' GROUP BY K.nama";
        $result = mysqli_query($conn, $query);
        if(!$result){
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
                        <a class="nav-link active" aria-current="page" href="lecture-home.php">Home</a>
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

    <section class="subject mt-4">
        <header>
            <h4>Pilih Kelas</h4>
        </header>
        <?php if(mysqli_num_rows($result) > 0) : ?>
        <div class="wrapper mt-3">
            <div class="d-flex flex-row flex-wrap">
                <?php foreach($result as $kelas) : ?>
                <a href="class.php?id=<?=  $kelas['id']; ?>" class="me-3 mb-5 card-block clearfix">
                    <div class="card-class d-flex align-items-center justify-content-center"
                        style="background-color: #a7e0eb;">
                        <div class="mt-4 row d-flex flex-row justify-content-between">
                            <ul class="icon col-1">
                                <i class="fas fa-book-reader"></i>
                            </ul>
                            <ul class="text col-9 d-flex flex-column ">
                                <li>
                                    <h2><?= $kelas['nama']; ?></h2>
                                </li>
                                <li>
                                    <h5><?= $kelas['jumlah']; ?> Mata Kuliah</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
            <center>Belum ada Kelas</center>
            <?php endif; ?>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js "
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin=" anonymous " referrerpolicy="no-referrer ">
    </script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>