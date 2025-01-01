<?php
namespace App\Entities;

class ProUser extends BasicUser {
    private ?string $abonnementStart;
    private ?string $abonnementEnd;

    public function __construct(string $username,string $email,string $password,?string $bio = null,?string $photoProfil = null,?string $abonnementStart = null,?string $abonnementEnd = null){
        parent::__construct($username, $email, $password, 'Pro', $bio, $photoProfil);
        $this->abonnementStart = $abonnementStart;
        $this->abonnementEnd = $abonnementEnd;
    }

    public function getAbonnementStart(): ?string {
        return $this->abonnementStart;
    }

    public function setAbonnementStart(?string $date): void {
        $this->abonnementStart = $date;
    }

    public function getAbonnementEnd(): ?string {
        return $this->abonnementEnd;
    }

    public function setAbonnementEnd(?string $date): void {
        $this->abonnementEnd = $date;
    }
    public function __toString(): string {
        return parent::__toString() . "Abonnement Start: {$this->abonnementStart}\nAbonnement End: {$this->abonnementEnd}\n";
    }
}
?>
