<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private string $host = "localhost";
    private string $db_name = "gestion_photospher";
    private string $username = "root";
    private string $password = "";
    private ?PDO $conn = null; 

    public function getConnection(): PDO {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                echo "Erreur de connexion: " . $exception->getMessage();
                exit;
            }
        }
        return $this->conn;
    }
}
