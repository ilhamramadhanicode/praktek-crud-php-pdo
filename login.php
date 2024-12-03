<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

require_once "database.php";

$db = new Database();

if (isset($_POST["login"])) {

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $pdo = $db->getConnection();

    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;

            header("Location: index.php");
            exit();
        }
    }
    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <title>Login</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
    }

    ::placeholder {
        font-size: 15px;
    }

    body {
        font-family: "Ubuntu", sans-serif;
    }

    h1 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 15px;
    }

    ul .container {
        width: 350px;
        height: 340px;
        padding: 25px;
        position: relative;
        margin: 100px auto;
        border-radius: 10px;
        box-shadow: -1px 5px 20px 4px rgba(0, 0, 0, 0.16);
    }

    input[type=text] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        outline: none;
        border: 2px solid #807979;
        border-radius: 5px;
    }

    input[type=password] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        outline: none;
        border: 2px solid #807979;
        border-radius: 5px;
    }

    ul .container .input-box li i {
        position: absolute;
        top: 147px;
        right: 38px;
        cursor: pointer;
    }

    input[type=checkbox] {
        margin-bottom: 18px;
        cursor: pointer;
    }

    button {
        width: 100%;
        padding: 10px;
        outline: none;
        border-radius: 5px;
        border: none;
        background-color: rgb(75, 75, 185);
        color: #fff;
        font-weight: 500;
        cursor: pointer;
    }

    ul .container .input-box li p {
        margin-top: 15px;
        text-align: center;
        font-size: 13px;
    }

    @media screen and (max-width: 576px) {
        ul .container {
            width: 270px;
            height: 310px;
            padding: 25px;
            position: relative;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: -1px 5px 20px 4px rgba(0, 0, 0, 0.16);
        }
    }
</style>

<body>

    <form action="" method="post">
        <ul>
            <div class="container">
                <div class="input-box">
                    <li>
                        <h1>Login</h1>
                    </li>
                    <!-- pesan error -->
                    <?php if (isset($error)) { ?>
                        <li>
                            <p style="color: red; font-style: italic; margin-bottom: 8px;">Username / Password salah</p>
                        </li>
                    <?php } ?>
                    <li><input type="text" name="username" placeholder="Username" autocomplete="off" required></li>
                    <li><input type="password" name="password" placeholder="Password" required></li>
                    <li>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" style="font-size: 14.8px;">Ingat saya</label>
                    </li>
                    <li><button type="submit" name="login">Login</button></li>
                    <li>
                        <p style="margin-top: 20px;">Belum punya akun? <a href="register.php">Registrasi</a></p>
                    </li>
                </div>
            </div>
        </ul>
    </form>

</body>

</html>