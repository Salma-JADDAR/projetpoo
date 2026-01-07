<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use PDO;

class CommentRepository {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function add(string $contenu, int $id_user, int $id_photo): int {
        $sql = "INSERT INTO commentaire (contenu, id_user, id_photo) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$contenu, $id_user, $id_photo]);
        return (int)$this->conn->lastInsertId();
    }

    public function remove(int $id_com): bool {
        $stmt = $this->conn->prepare("DELETE FROM commentaire WHERE id_com = ?");
        return $stmt->execute([$id_com]);
    }

    public function findByPhoto(int $id_photo): array {
        $sql = "SELECT c.*, u.username FROM commentaire c 
                JOIN users u ON c.id_user = u.id 
                WHERE c.id_photo = ? 
                ORDER BY c.createdAt DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_photo]);
        return $stmt->fetchAll();
    }

    public function countByPhoto(int $id_photo): int {
        $sql = "SELECT COUNT(*) as count FROM commentaire WHERE id_photo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_photo]);
        $result = $stmt->fetch();
        return (int)$result['count'];
    }
}