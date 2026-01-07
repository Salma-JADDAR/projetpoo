<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Taggable;
use App\Config\Database;
use PDO;

class TagRepository implements Taggable {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addTag(string $tag, int $photoId): void {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO tag (nom) VALUES (?)");
        $stmt->execute([$tag]);

        $stmt2 = $this->conn->prepare("INSERT INTO photo_tag (id_photo, id_tag) 
                                       SELECT ?, id_tag FROM tag WHERE nom = ?");
        $stmt2->execute([$photoId, $tag]);
    }

    public function removeTag(string $tag, int $photoId): void {
        $stmt = $this->conn->prepare("DELETE pt FROM photo_tag pt
                                      JOIN tag t ON pt.id_tag = t.id_tag
                                      WHERE pt.id_photo = ? AND t.nom = ?");
        $stmt->execute([$photoId, $tag]);
    }

    public function getTags(int $photoId): array {
        $stmt = $this->conn->prepare("SELECT t.nom FROM tag t 
                                      JOIN photo_tag pt ON t.id_tag = pt.id_tag
                                      WHERE pt.id_photo = ?");
        $stmt->execute([$photoId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function hasTag(string $tag, int $photoId): bool {
        $stmt = $this->conn->prepare("SELECT 1 FROM tag t 
                                      JOIN photo_tag pt ON t.id_tag = pt.id_tag
                                      WHERE pt.id_photo = ? AND t.nom = ?");
        $stmt->execute([$photoId, $tag]);
        return (bool)$stmt->fetchColumn();
    }

    public function clearTags(int $photoId): void {
        $stmt = $this->conn->prepare("DELETE FROM photo_tag WHERE id_photo = ?");
        $stmt->execute([$photoId]);
    }
}
