<?php
namespace App\Entities;

class Moderator extends User {
    private string $niveau; 

    public function __construct(string $username,string $email,string $password,string $niveau,?string $bio = null,?string $photoProfil = null) {
        parent::__construct($username, $email, $password, 'Moderator', $bio, $photoProfil);
        $this->niveau = $niveau;
    }

    public function getNiveau(): string {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): void {
        $this->niveau = $niveau;
    }
}
?>
