<?php 
    session_start();
    if ($_SESSION['role'] != "Dosen") {
        header("Location: ../../index.php");
        exit;
    } else {
        include '../../common/connection.php';
        include '../../common/getImg.php';
        
        $role = $_SESSION['role'];
        $name = $_SESSION['nama'];
        $id = $_GET['id'];
        $classID = $_GET['classID'];
        $nip = $_SESSION['id'];
        $subjectID = $_GET['subjectID'];
        $subject = $_GET['subject'];
        $msg = '';
        if(isset($_POST['edit'])) {
            $nama = mysqli_real_escape_string($conn, $_POST['nama']);
            $deadline = $_POST['deadline'];
            $desc = mysqli_real_escape_string($conn, $_POST['desc']);

            $updateQuery = "UPDATE tugas SET nama='$nama', batas='$deadline', deskripsi='$desc' WHERE id=$id";
                $result = mysqli_query($conn, $updateQuery);
                if(!$result){
                    $msg = 'Gagal mengubah data';
                } else
                    header('Location: task-detail.php?id='.$id.'&classID='.$classID.'&subjectID='.$subjectID.'&subject='.$subject);
}
$taskQuery = "SELECT * FROM tugas WHERE id=$id";
$task = mysqli_query($conn, $taskQuery);
if(!$task){
echo "Error: ".mysqli_query($conn, $taskQuery);
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
                            <span><?= $role.' | '.$name; ?></span>
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
            <h4>Edit Tugas</h4>
        </header>
        <?php if(mysqli_num_rows($task) > 0) : ?>
        <?php foreach($task as $data) : ?>
        <span class="back d-flex justify-content-start">
            <a
                href="task-detail.php?id=<?= $id;?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>">Kembali</a>
            <span class="ms-4 submit">Edit</span>
        </span>
        <?php if($msg != '') : ?>
        <div class="pe-0 alert alert-danger alert-dismissible fade show" role="alert">
            <?= $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
        <div class="mt-4 task-detail d-flex flex-row justify-content-between">
            <div class="row col-3">
                <ul class="d-flex flex-column">
                    <li class="mb-4">
                        <label for="title">
                            <h5>Judul Tugas</h5>
                        </label>
                    </li>
                    <li class="mb-4">
                        <label for="deadline">
                            <h5>Batas Pengumpulan</h5>
                        </label>
                    </li>
                    <li class="mb-4">
                        <label for="desc">
                            <h5>Deksripsi Tugas</h5>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="row col-9 task-content">
                <div class="mb-4 task-create">
                    <form
                        action="task-edit.php?id=<?= $id; ?>&classID=<?= $classID; ?>&subjectID=<?= $subjectID; ?>&subject=<?= $subject; ?>"
                        method="post" class="d-flex flex-column">
                        <input type="text" name="nama" class="mb-4" id="nama" value="<?= $data['nama']; ?>" required />
                        <input type="datetime-local" name="deadline" class="mb-4" id="deadline"
                            value="<?= $data['batas']; ?>" required />
                        <textarea class="mt-4 col-8 px-3 py-2" name="desc" id="desc" cols="30"
                            rows="10"><?= $data['deskripsi']; ?></textarea>
                        <button type="submit" class="submitNote" name="edit" hidden></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4 " crossorigin="anonymous ">
    </script>
    <script src="../../assets/js/submitHandler.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
</body>

</html>