<?php
namespace App\Repositories;

use App\Config\Database;
use App\Entities\User;
use App\Entities\BasicUser;
use App\Entities\ProUser;
use App\Entities\Moderator;
use App\Entities\Administrator;
use PDO;

class UserRepository {

    private PDO $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function emailExists(string $email): bool {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }

    public function add($user): bool {
        if ($this->emailExists($user->getEmail())) {
            return false;
        }

        $sql = "INSERT INTO users (username, email, password, role, bio, photoProfil, 
                uploadCountMensuel, abonnementStart, abonnementEnd, niveau, isSuperAdmin)
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

        if ($user instanceof ProUser) {
            $uploadCount = $user->getUploadCountMensuel();
            $abonnementStart = $user->getAbonnementStart();
            $abonnementEnd = $user->getAbonnementEnd();
        }

        if ($user instanceof Moderator) {
            $niveau = $user->getNiveau();
           
        }

        if ($user instanceof Administrator) {
            $niveau = 'lead'; 
            $isSuperAdmin = $user->getIsSuperAdmin() ? 1 : 0;
        }

        return $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole(),
            $user->getBio(),
            $user->getPhotoProfil(),
            $uploadCount,
            $abonnementStart,
            $abonnementEnd,
            $niveau,
            $isSuperAdmin
        ]);
    }

    public function canUpload(BasicUser $user): bool {
        return $user->getUploadCountMensuel() < 10;
    }

    public function incrementUploadCount(int $userId): bool {
        $sql = "UPDATE users SET uploadCountMensuel = uploadCountMensuel + 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId]);
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

        
        if ($user instanceof ProUser) {
            $abonnementStart = $user->getAbonnementStart();
            $abonnementEnd = $user->getAbonnementEnd();
        }

        if ($user instanceof Moderator) {
            $niveau = $user->getNiveau();
        }

        if ($user instanceof Administrator) {
            $niveau = 'lead';
            $isSuperAdmin = $user->getIsSuperAdmin() ? 1 : 0;
        }

        
        if (method_exists($user, 'getUploadCountMensuel')) {
            $uploadCount = $user->getUploadCountMensuel();
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
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }

        return $this->createUserFromData($data);
    }

    
    private function createUserFromData(array $data): User {
    $user = null;
    
    switch ($data['role']) {
        case 'Basic':
            $user = new BasicUser(
                $data['username'],
                $data['email'],
                '', 
                $data['bio'],
                $data['photoProfil'],
                (int)$data['uploadCountMensuel']
            );
            break;
            
        case 'Pro':
            $user = new ProUser(
                $data['username'],
                $data['email'],
                '', 
                $data['bio'],
                $data['photoProfil'],
                (int)$data['uploadCountMensuel'],
                $data['abonnementStart'],
                $data['abonnementEnd']
                
            );
            break;
            
        case 'Moderator':
            $user = new Moderator(
                $data['username'],
                $data['email'],
                '', 
                $data['niveau'],
                $data['bio'],
                $data['photoProfil']
            );
           
           
            break;
            
        case 'Admin':
            $user = new Administrator(
                $data['username'],
                $data['email'],
                '', 
                (bool)$data['isSuperAdmin'],
                $data['bio'],
                $data['photoProfil']
            );
           
            break;
            
        default:
            throw new \Exception("Role inconnu: " . $data['role']);
    }
    
   
    if ($user && isset($data['id'])) {
        $user->setId((int)$data['id']);
    }
    
    
  
    
    return $user;
}
}
?>