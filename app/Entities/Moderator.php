<?php
namespace App\Entities;

class Moderator extends User {
    private string $niveau;

    public function __construct(string $username, string $email, string $password, string $niveau, ?string $bio = null, ?string $photoProfil = null)
    {
        parent::__construct($username, $email, $password, 'Moderator', $bio, $photoProfil);
        $this->niveau = $niveau;
    }

  
}
?>
