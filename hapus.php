<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

$id = $_GET["id"];

$db = new Database();

if (!$id) {
    echo "<script>
    alert('ID tidak valid');
    document.location.href = 'index.php';
    </script>";
    exit;
}

if (isset($_POST["delete"])) {
    if ($db->delete($id) > 0) {
        echo "<script> 
        alert('data berhasil dihapus');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script> 
        alert('data gagal dihapus');
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
    <title>Percobaan</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        width: 400px;
        height: 200px;
        padding: 20px 20px;
        border-radius: 5px;
        margin: 200px auto;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.86);
    }

    .container p {
        text-align: center;
    }

    .flex-button {
        display: flex;
        justify-content: space-between;
        width: 260px;
        margin: 50px auto;
        padding: 5px 10px;
        font-size: 16.7px;
    }

    .flex-button .delete {
        cursor: pointer;
        width: 200px;
        padding: 15px 5px;
        margin-right: 10px;
        outline: none;
        border: none;
        border-radius: 5px;
        background-color: red;
    }

    .flex-button .cancel {
        cursor: pointer;
        width: 200px;
        padding: 5px 5px;
        outline: none;
        border: none;
        border-radius: 5px;
        background-color: grey;
    }

    .flex-button .cancel a {
        color: white;
        text-decoration: none;
    }
</style>

<body>

    <div class="container">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <p>Apakah data ini ingin dihapus?</p>
            <div class="flex-button">
                <button type="submit" class="delete" name="delete" onclick="return confirm('Konfirmasi hapus!')"
                    style="color: white;">Hapus</button>
                <button type="button" class="cancel"><a href="index.php">Batal</a></button>
            </div>
        </form>
    </div>

</body>

</html>