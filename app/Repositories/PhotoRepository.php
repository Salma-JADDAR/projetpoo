<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use App\Entities\Photo;
use PDO;

class PhotoRepository implements PhotoRepositoryInterface {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function add(Photo $photo): Photo {
        $sql = "INSERT INTO photo 
            (titre, description, filename, taille, mimeType, dimensions, status, viewsCount, 
             createdAt, updatedAt, publishedAt, id_user)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $photo->getTitle(),
            $photo->getDescription(),
            $photo->getImageLink(),
            $photo->getFileSize(),
            $photo->getMimeType(),
            $photo->getDimensions(),
            $photo->getStatus(),
            $photo->getViewsCount(),
            $photo->getCreatedAt()->format('Y-m-d H:i:s'),
            $photo->getUpdatedAt() ? $photo->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            $photo->getPublishedAt() ? $photo->getPublishedAt()->format('Y-m-d H:i:s') : null,
            $photo->getUserId()
        ]);

        $photo->setId((int)$this->conn->lastInsertId());
        return $photo;
    }

    public function findById(int $id): ?Photo {
        $sql = "SELECT * FROM photo WHERE id_photo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $photo = new Photo(
            $row['titre'],
            $row['description'],
            $row['filename'],
            (int)$row['taille'],
            $row['mimeType'],
            $row['dimensions'],
            (int)$row['id_user'],
            $row['status'],
            (int)$row['viewsCount'],
            !empty($row['publishedAt']) ? new \DateTime($row['publishedAt']) : null,
            !empty($row['createdAt']) ? new \DateTime($row['createdAt']) : null,
            !empty($row['updatedAt']) ? new \DateTime($row['updatedAt']) : null
        );

        $photo->setId((int)$row['id_photo']);
        return $photo;
    }

    public function update(Photo $photo): bool {
        $sql = "UPDATE photo SET
            titre = ?, 
            description = ?, 
            filename = ?, 
            taille = ?, 
            mimeType = ?, 
            dimensions = ?, 
            status = ?, 
            viewsCount = ?, 
            updatedAt = ?, 
            publishedAt = ?, 
            id_user = ?
            WHERE id_photo = ?";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $photo->getTitle(),
            $photo->getDescription(),
            $photo->getImageLink(),
            $photo->getFileSize(),
            $photo->getMimeType(),
            $photo->getDimensions(),
            $photo->getStatus(),
            $photo->getViewsCount(),
            (new \DateTime())->format('Y-m-d H:i:s'),
            $photo->getPublishedAt() ? $photo->getPublishedAt()->format('Y-m-d H:i:s') : null,
            $photo->getUserId(),
            $photo->getId()
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM photo WHERE id_photo = ?");
        return $stmt->execute([$id]);
    }

    public function findAll(): array {
        $sql = "SELECT * FROM photo ORDER BY createdAt DESC";
        $stmt = $this->conn->query($sql);
        $rows = $stmt->fetchAll();
        
        $photos = [];
        foreach ($rows as $row) {
            $photo = new Photo(
                $row['titre'],
                $row['description'],
                $row['filename'],
                (int)$row['taille'],
                $row['mimeType'],
                $row['dimensions'],
                (int)$row['id_user'],
                $row['status'],
                (int)$row['viewsCount'],
                !empty($row['publishedAt']) ? new \DateTime($row['publishedAt']) : null,
                !empty($row['createdAt']) ? new \DateTime($row['createdAt']) : null,
                !empty($row['updatedAt']) ? new \DateTime($row['updatedAt']) : null
            );
            $photo->setId((int)$row['id_photo']);
            $photos[] = $photo;
        }
        
        return $photos;
    }

    public function findByUser(int $userId): array {
        $sql = "SELECT * FROM photo WHERE id_user = ? ORDER BY createdAt DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll();
        
        $photos = [];
        foreach ($rows as $row) {
            $photo = new Photo(
                $row['titre'],
                $row['description'],
                $row['filename'],
                (int)$row['taille'],
                $row['mimeType'],
                $row['dimensions'],
                (int)$row['id_user'],
                $row['status'],
                (int)$row['viewsCount'],
                !empty($row['publishedAt']) ? new \DateTime($row['publishedAt']) : null,
                !empty($row['createdAt']) ? new \DateTime($row['createdAt']) : null,
                !empty($row['updatedAt']) ? new \DateTime($row['updatedAt']) : null
            );
            $photo->setId((int)$row['id_photo']);
            $photos[] = $photo;
        }
        
        return $photos;
    }

    public function findByStatus(string $status): array {
        $sql = "SELECT * FROM photo WHERE status = ? ORDER BY createdAt DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$status]);
        $rows = $stmt->fetchAll();
        
        $photos = [];
        foreach ($rows as $row) {
            $photo = new Photo(
                $row['titre'],
                $row['description'],
                $row['filename'],
                (int)$row['taille'],
                $row['mimeType'],
                $row['dimensions'],
                (int)$row['id_user'],
                $row['status'],
                (int)$row['viewsCount'],
                !empty($row['publishedAt']) ? new \DateTime($row['publishedAt']) : null,
                !empty($row['createdAt']) ? new \DateTime($row['createdAt']) : null,
                !empty($row['updatedAt']) ? new \DateTime($row['updatedAt']) : null
            );
            $photo->setId((int)$row['id_photo']);
            $photos[] = $photo;
        }
        
        return $photos;
    }

    public function incrementViewCount(int $id): bool {
        $sql = "UPDATE photo SET viewsCount = viewsCount + 1 WHERE id_photo = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}