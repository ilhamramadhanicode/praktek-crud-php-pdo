<?php

class Database
{
    private string $host = "localhost";
    private string $dbname = "belajar_pdo";
    private string $username = "root";
    private string $password = "";
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Koneksi error : " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error : " . $e->getMessage());
        }
    }

    public function insert($data)
    {

        $nama = htmlspecialchars($data["nama"]);
        $jurusan = htmlspecialchars($data["jurusan"]);

        $sql = "INSERT INTO mahasiswa(nama, jurusan) VALUES(?, ?)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $nama);
        $stmt->bindParam(2, $jurusan);
        return $stmt->execute();
    }

    public function update($data)
    {
        $id = htmlspecialchars($data["id"]);
        $nama = htmlspecialchars($data["nama"]);
        $jurusan = htmlspecialchars($data["jurusan"]);

        $sql = "UPDATE mahasiswa SET nama = ?, jurusan = ? WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1, $nama);
        $stmt->bindParam(2, $jurusan);
        $stmt->bindParam(3, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM mahasiswa WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function register($data)
    {
        $username = strtolower(htmlspecialchars($data["username"]));
        $password = stripslashes(htmlspecialchars($data["password"]));
        $password2 = stripslashes(htmlspecialchars($data["password2"]));

        // jika password nya tidak sama
        if ($password !== $password2) {
            echo "<script>
            alert('Password tidak sama!');
            </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // usernam dan password masuk ke database, password akan di acak karna di enkripsi terlebih dahulu
        $sql = "INSERT INTO user(username, password) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $result = $stmt->execute();
        return $result;
    }
}
