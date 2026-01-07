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

   public function add(Photo $photo): Photo{
    $sql = "INSERT INTO photos 
        (title, description, image_link, file_size, mime_type, dimensions, state, view_count, created_at, published_at, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        $photo->getTitle(),
        $photo->getDescription(),
        $photo->getImageLink(),
        $photo->getFileSize(),
        $photo->getMimeType(),
        $photo->getDimensions(),
        $photo->getState(),
        $photo->getViewCount(),
        $photo->getCreatedAt()->format('Y-m-d H:i:s'),
        $photo->getPublishedAt()?->format('Y-m-d H:i:s'),
        $photo->getUserId()
    ]);

     $photo->setId((int)$this->conn->lastInsertId());
    return $photo;
    
}

public function findById(int $id): ?Photo
{
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
        !empty($row['createdAt']) ? new \DateTime($row['createdAt']) : new \DateTime(),
        !empty($row['updatedAt']) ? new \DateTime($row['updatedAt']) : null
    );

    // ⭐⭐⭐ السطر المهم بزاف ⭐⭐⭐
    $photo->setId((int)$row['id_photo']);

    return $photo;
}




    public function update(Photo $photo): bool {
        $sql = "UPDATE photo SET
            titre = ?, description = ?, filename = ?, taille = ?, dimensions = ?, status = ?, viewsCount = ?, 
            createdAt = ?, updatedAt = ?, publishedAt = ?, id_user = ?
            WHERE id_photo = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $photo->getTitle(),
            $photo->getDescription(),
            $photo->getImageLink(),
            $photo->getFileSize(),
            $photo->getDimensions(),
            $photo->getState(),
            $photo->getViewCount(),
            $photo->getCreatedAt()->format('Y-m-d H:i:s'),
            $photo->getUpdatedAt() ? $photo->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            $photo->getPublishedAt() ? $photo->getPublishedAt()->format('Y-m-d H:i:s') : null,
            $photo->getUserId(),
            $photo->getId()
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM photo WHERE id_photo = ?");
        return $stmt->execute([$id]);
    }
}
