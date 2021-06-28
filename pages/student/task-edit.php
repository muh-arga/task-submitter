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
        $taskName = $_GET['taskName'];
        $nrp = $_SESSION['id'];
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama'];
        $msg = '';

        $taskQuery = "SELECT T.id, T.nama nama, T.batas, T.deskripsi, F.path, F.nilai, F.nama tugas, F.note, F.saran, F.tugasID, F.mahasiswaNRP nrp, F.id fileID FROM tugas T
        join mata_kuliah S on (T.mataKuliahID=S.id)
        LEFT JOIN (SELECT * FROM file WHERE mahasiswaNRP='$nrp') as F on (T.id=F.tugasID) 
        where kelasID=$classID AND T.id=$id";

        $task = mysqli_query($conn, $taskQuery);
        if(!$task){
            echo "Error: ".mysqli_error($conn);
        }

        if(isset($_POST['edit'])){
            include '../../common/fileExist.php';
            $isi = mysqli_fetch_assoc($task);
                $namaFile = $isi['tugas'];

            $note = mysqli_real_escape_string($conn, $_POST['note']);
            $editQuery = '';
            if($namaFile == ''){
                $msg = 'Belum ada file yang dipilih';
            } else {
                if(fileExist($nrp, $id))
                    $editQuery = "UPDATE file SET note='$note' WHERE tugasID=$id AND mahasiswaNRP='$nrp'";
                else
                    $editQuery = "INSERT INTO file (note) VALUES('$note')";
                $result = mysqli_query($conn, $editQuery);
                    if(!$result){
                        $msg = 'Gagal mengirim tugas';
                    } else
                        header('Location: task-detail.php?id='.$id.'&subjectID='.$subjectID.'&subject='.$subject);
            }
        }

        if(isset($_POST['submit'])){
            date_default_timezone_set("Asia/Makassar");
            include '../../common/fileExist.php';
            include '../../common/compareTime.php';

            $uploadDir = '../../public/upload/';
            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $status = compare($id);
            $filePath = '../public/upload/'.$fileName;
            $path = $uploadDir.$fileName;
            $currentDateTime = date('Y-m-d H:i:s');
            if($_FILES['file']['size'] > 200000*10)
                $msg = 'Ukuran file terlalu besar';
            else{
                $move = move_uploaded_file($tmpName, $path);
                if(!$move){
                    $msg = 'Gagal mengupload file';
                } else {
                    if(fileExist($nrp, $id)){
                        $query = "UPDATE file SET nama='$fileName', size='$fileSize', type='$fileType', path='$filePath', uploaded_at='$currentDateTime', status='$status' WHERE tugasID=$id AND mahasiswaNRP='$nrp'";
                    } else {
                        $query = "INSERT INTO file (nama, size, type, path, uploaded_at, tugasID, mahasiswaNRP, status) VALUES('$fileName', '$fileSize', '$fileType', '$filePath', '$currentDateTime', $id, '$nrp', '$status')";
                    }
                    $result = mysqli_query($conn, $query);
                    if(!$result){
                        $msg = 'Gagal mengupload file';
                    } else
                        header('Location: task-edit.php?id='.$id.'&subjectID='.$subjectID.'&subject='.$subject.'&taskName='.$taskName);
                }
            }
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
        <?php if($msg != '') : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
        <header>
            <?php $tugas = mysqli_fetch_assoc($task) ?>
            <h4><?= $subject.' - '.$taskName; ?></h4>
        </header>
        <span class="back d-flex justify-content-start">
            <a href="task-detail.php?id=<?= $id; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>">Kembali</a>
            <span class="ms-4 submit">Kirim</span>
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
                        <label for="deadline">
                            <h5>Batas Pengumpulan</h5>
                        </label>
                    </li>
                    <li class="mb-4">
                        <label for="file">
                            <h5>File Tugas</h5>
                        </label>
                    </li>
                    <li class="mb-4">
                        <label for="note">
                            <h5>Catatan Anda</h5>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="row col-9 task-content">
                <?php foreach($task as $data) : ?>
                <ul class="d-flex flex-column">
                    <li class="mb-4">
                        <h5><?= $data['batas']; ?></h5>
                    </li>
                    <div class="mb-4 d-flex flex-column justify-content-between">
                        <form
                            action="task-edit.php?id=<?= $id; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>&taskName=<?= $taskName ?>"
                            method="post" enctype="multipart/form-data">
                            <div class="input-file">
                                <div class="wrapper d-flex flex-column">
                                    <div class="drag-area">
                                        <div class="file-area justify-content-center align-items-center"></div>
                                        <div class="icon"> <i class="edit fas fa-file-upload"></i></div>
                                        <header>
                                            Letakkan File Disini
                                        </header>
                                        <span>Atau</span>
                                        <button class="browse">Telusuri File</button>
                                        <input type="file" name="file" hidden>
                                    </div>
                                    <div class="me-4 mt-4 button align-self-end">
                                        <span class="cancel">Kembali</span>
                                        <span class="confirm">Kirim</span>
                                        <span class="choose">Pilih</span>
                                        <button type="submit" name="submit" class="submit" hidden></button>
                                    </div>
                                </div>
                            </div>
                            <div class="task-file d-flex flex-row">
                                <h5 style="width: 600px;"><?= $data['tugas']; ?></h5>
                                <i class="edit fas fa-edit"></i>
                            </div>
                        </form>
                        <form
                            action="task-edit.php?id=<?= $id; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>&taskName=<?= $taskName ?>"
                            method="post" class="d-flex flex-column">
                            <textarea class="mt-4 col-8 px-3 py-3" name="note" id="note" cols="30"
                                rows="10"><?= $data['note']; ?></textarea>
                            <button type="submit" name='edit' class="submitNote" hidden></button>
                        </form>
                    </div>
                    <li class="mb-4">
                        <h5></h5>
                    </li>
                </ul>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif ?>
    </section>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script src="../../assets/js/task-upload.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>