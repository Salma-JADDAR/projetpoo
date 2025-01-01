<?php
namespace App\Entities;

class ProUser extends User {
    private ?string $abonnementStart;
    private ?string $abonnementEnd;

    public function __construct(string $username, string $email, string $password, ?string $bio = null, ?string $photoProfil = null, ?string $abonnementStart = null, ?string $abonnementEnd = null)
    {
        parent::__construct($username, $email, $password, 'Pro', $bio, $photoProfil);
        $this->abonnementStart = $abonnementStart;
        $this->abonnementEnd = $abonnementEnd;
    }

}
?>
