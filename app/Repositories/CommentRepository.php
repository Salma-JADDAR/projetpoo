<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Commentable;
use App\Config\Database;
use PDO;

class CommentRepository implements Commentable {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addComment(string $content, int $userId, int $photoId): int {
        $sql = "INSERT INTO commentaire (contenu, id_user, id_photo) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$content, $userId, $photoId]);
        return (int)$this->conn->lastInsertId();
    }

    public function removeComment(int $commentId): bool {
        $sql = "DELETE FROM commentaire WHERE id_com = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$commentId]);
    }

    public function getComments(int $photoId): array {
        $stmt = $this->conn->prepare("SELECT * FROM commentaire WHERE id_photo = ?");
        $stmt->execute([$photoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentCount(int $photoId): int {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM commentaire WHERE id_photo = ?");
        $stmt->execute([$photoId]);
        return (int)$stmt->fetchColumn();
    }
}
