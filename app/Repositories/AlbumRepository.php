<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use App\Entities\Album;
use PDO;

class AlbumRepository {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function add(Album $album): bool {
        $sql = "INSERT INTO album (nom, description, privacy, nbPhotos, createdAt, updatedAt, id_user)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $album->getName(),
            $album->getDescription(),
            $album->isPublic() ? 'public' : 'prive',
            $album->getPhotoCount(),
            $album->getCreatedAt()->format('Y-m-d H:i:s'),
            $album->getUpdatedAt()?->format('Y-m-d H:i:s'),
            $album->getUserId()
        ]);
    }

    public function findById(int $id): ?Album {
        $stmt = $this->conn->prepare("SELECT * FROM album WHERE id_album=?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        $album = new Album();
        $album->setId((int)$data['id_album']);
        $album->setName($data['nom']);
        $album->setDescription($data['description']);
        $album->setPublic($data['privacy'] === 'public');
        $album->setPhotoCount((int)$data['nbPhotos']);
        $album->setCreatedAt(new \DateTime($data['createdAt']));
        $album->setUpdatedAt($data['updatedAt'] ? new \DateTime($data['updatedAt']) : null);
        $album->setUserId((int)$data['id_user']);
        return $album;
    }

    public function update(Album $album): bool {
        $sql = "UPDATE album SET nom=:nom, description=:description, privacy=:privacy, nbPhotos=:nbPhotos, updatedAt=:updatedAt WHERE id_album=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nom' => $album->getName(),
            ':description' => $album->getDescription(),
            ':privacy' => $album->isPublic() ? 'public' : 'prive',
            ':nbPhotos' => $album->getPhotoCount(),
            ':updatedAt' => $album->getUpdatedAt()?->format('Y-m-d H:i:s'),
            ':id' => $album->getId()
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM album WHERE id_album=?");
        return $stmt->execute([$id]);
    }
}
