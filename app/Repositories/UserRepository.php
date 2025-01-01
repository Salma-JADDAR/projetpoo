<?php
namespace App\Repositories;

use App\Config\Database;
use App\Entities\User;
use App\Entities\BasicUser;
use App\Entities\ProUser;
use App\Entities\Moderator;
use App\Entities\Administrator;
use App\Services\UserFactory;
use PDO;

class UserRepository implements RepositoryInterface {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

 
    public function emailExists(string $email): bool {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }

    
    public function add(User $user): bool {
        if ($this->emailExists($user->getEmail())) {
            return false;
        }

        $sql = "INSERT INTO users 
            (username, email, password, role, bio, photoProfil, uploadCountMensuel, abonnementStart, abonnementEnd, niveau, isSuperAdmin)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $uploadCount = 0;
        $abonnementStart = null;
        $abonnementEnd = null;
        $niveau = null;
        $isSuperAdmin = null;

       
        if ($user instanceof BasicUser) {
            $uploadCount = $user->getUploadCountMensuel();
        } 
        elseif ($user instanceof ProUser) {
            $uploadCount = $user->getUploadCountMensuel();
            $abonnementStart = $user->getAbonnementStart();
            $abonnementEnd   = $user->getAbonnementEnd();
        } 
        elseif ($user instanceof Moderator) {
            $niveau = $user->getNiveau();
        } 
        elseif ($user instanceof Administrator) {
            $niveau = 'lead';
            $isSuperAdmin = $user->getIsSuperAdmin() ? 1 : 0;
        }

        return $stmt->execute([$user->getUsername(),$user->getEmail(),$user->getPassword(),$user->getRole(),$user->getBio(),$user->getPhotoProfil(),$uploadCount,$abonnementStart,$abonnementEnd,$niveau, $isSuperAdmin
        ]);
    }

   
    public function update(User $user): bool {
        $sql = "UPDATE users SET
            username = :username,
            email = :email,
            password = :password,
            role = :role,
            bio = :bio,
            photoProfil = :photoProfil,
            uploadCountMensuel = :uploadCountMensuel,
            abonnementStart = :abonnementStart,
            abonnementEnd = :abonnementEnd,
            niveau = :niveau,
            isSuperAdmin = :isSuperAdmin
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $uploadCount = 0;
        $abonnementStart = null;
        $abonnementEnd = null;
        $niveau = null;
        $isSuperAdmin = null;

        if ($user instanceof BasicUser) {
            $uploadCount = $user->getUploadCountMensuel();
        } 
        elseif ($user instanceof ProUser) {
            $uploadCount = $user->getUploadCountMensuel();
            $abonnementStart = $user->getAbonnementStart();
            $abonnementEnd   = $user->getAbonnementEnd();
        } 
        elseif ($user instanceof Moderator) {
            $niveau = $user->getNiveau();
        } 
        elseif ($user instanceof Administrator) {
            $niveau = 'lead';
            $isSuperAdmin = $user->getIsSuperAdmin() ? 1 : 0;
        }

        return $stmt->execute([
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':role' => $user->getRole(),
            ':bio' => $user->getBio(),
            ':photoProfil' => $user->getPhotoProfil(),
            ':uploadCountMensuel' => $uploadCount,
            ':abonnementStart' => $abonnementStart,
            ':abonnementEnd' => $abonnementEnd,
            ':niveau' => $niveau,
            ':isSuperAdmin' => $isSuperAdmin,
            ':id' => $user->getId()
        ]);
    }

    
    public function findById(int $id): ?User {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        return UserFactory::createFromArray($data);
    }

    
    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
