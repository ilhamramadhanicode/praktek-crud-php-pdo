<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

if (isset($_POST["kirim"])) {
    $db = new Database();
    if ($db->insert($_POST) > 0) {
        echo "<script> 
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script> 
        alert('data gagal ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tambah Data</title>
</head>

<body>

    <form action="" method="post" class="w-25 m-auto mt-5">
        <div class="mb-3 text-center">
            <h1>Tambah Data</h1>
        </div>
        <div class="mb-3">
            <input type="text" name="nama" class="form-control" autocomplete="off" placeholder="Nama" required>
        </div>
        <div class="mb-3">
            <input type="text" name="jurusan" class="form-control" autocomplete="off" placeholder="Jurusan" required>
        </div>
        <div class="mb-3">
            <button type="submit" name="kirim" class="btn btn-primary w-100">Tambah</button>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-secondary w-100"><a href="index.php" style="text-decoration: none; color: white;">Batal</a></button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>