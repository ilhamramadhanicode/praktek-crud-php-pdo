<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

$db = new Database();
$mhs = $db->query("SELECT * FROM mahasiswa");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    nav {
        width: 100%;
        background-color: rgb(13, 110, 253);
        height: 50px;
    }

    nav svg {
        margin-left: 1297px;
        margin-top: 8.7px;
    }

    nav a {
        text-decoration: none;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        width: 300px;
        height: 200px;
        padding: 20px 20px;
        border-radius: 6px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.86);
        margin: 50px auto;
    }

    .flex-button {
        display: flex;
        /* border: 1px solid black; */
        justify-content: space-around;
        margin: 50px auto;
    }

    .flex-button .edit {
        width: 97px;
        outline: none;
        border: none;
        border-radius: 6px;
        background-color: rgba(191, 199, 34, 0.8);
        cursor: pointer;
    }

    .flex-button .hapus {
        width: 97px;
        outline: none;
        border: none;
        border-radius: 6px;
        background-color: red;
        cursor: pointer;
        padding: 10px;
    }

    .container p {
        font-size: 15.7px;
        text-align: center;
        margin-top: 7px;
    }

    .container a {
        text-decoration: none;
        color: white;
    }
</style>

<body>

    <nav>
        <a href="tambah.php">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px; fill: white;" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
            </svg>
        </a>
    </nav>

    <a href="logout.php">Logout</a>

    <?php foreach ($mhs as $row) { ?>
        <div class="container">
            <p>Nama : <?= $row["nama"]; ?></p>
            <p>Jurusan : <?= $row["jurusan"]; ?></p>
            <div class="flex-button">
                <button type="button" class="edit"><a href="ubah.php?id=<?= $row["id"]; ?>">Edit</a></button>
                <button type="button" class="hapus"><a href="hapus.php?id=<?= $row["id"]; ?>">Hapus</a></button>
            </div>
        </div>
    <?php } ?>


</body>

</html>