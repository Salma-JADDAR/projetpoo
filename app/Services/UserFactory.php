<?php
namespace App\Services;

use App\Entities\User;
use App\Entities\BasicUser;
use App\Entities\ProUser;
use App\Entities\Moderator;
use App\Entities\Administrator;

class UserFactory{
    public static function createFromArray(array $data): User{
        switch ($data['role']) {

            case 'Basic':
                $user = new BasicUser(
                    $data['username'],
                    $data['email'],
                    '',
                    $data['bio'] ?? null,
                    $data['photoProfil'] ?? null,
                    (int)($data['uploadCountMensuel'] ?? 0)
                );
                break;

            case 'Pro':
                $user = new ProUser(
                    $data['username'],
                    $data['email'],
                    '',
                    $data['bio'] ?? null,
                    $data['photoProfil'] ?? null,
                    (int)($data['uploadCountMensuel'] ?? 0),
                    $data['abonnementStart'] ?? null,
                    $data['abonnementEnd'] ?? null
                );
                break;

            case 'Moderator':
                $user = new Moderator(
                    $data['username'],
                    $data['email'],
                    '',
                    (int)$data['niveau'],
                    $data['bio'] ?? null,
                    $data['photoProfil'] ?? null
                );
                break;

            case 'Admin':
                $user = new Administrator(
                    $data['username'],
                    $data['email'],
                    '',
                    (bool)$data['isSuperAdmin'],
                    $data['bio'] ?? null,
                    $data['photoProfil'] ?? null
                );
                break;

            default:
                throw new \Exception("Role inconnu : " . $data['role']);
        }

      
        if (isset($data['id'])) {
            $user->setId((int)$data['id']);
        }

        return $user;
    }
}
