<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Likeable;
use App\Config\Database;
use PDO;

class LikeRepository  {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addLikeForPhoto(int $userId, int $photoId): bool {
        $sql = "INSERT IGNORE INTO likes (id_user, id_photo) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId, $photoId]);
    }

    public function removeLikeForPhoto(int $userId, int $photoId): bool {
        $sql = "DELETE FROM likes WHERE id_user = ? AND id_photo = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId, $photoId]);
    }

    public function isLikedByuser(int $userId, int $photoId): bool {
        $stmt = $this->conn->prepare("SELECT 1 FROM likes WHERE id_user = ? AND id_photo = ?");
        $stmt->execute([$userId, $photoId]);
        return (bool)$stmt->fetchColumn();
    }

    public function CountByPhoto(int $photoId): int {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM likes WHERE id_photo = ?");
        $stmt->execute([$photoId]);
        return (int)$stmt->fetchColumn();
    }

   
}
