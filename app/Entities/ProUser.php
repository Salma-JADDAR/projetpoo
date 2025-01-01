<?php
namespace App\Entities;

class ProUser extends User {
    private ?string $abonnementStart;
    private ?string $abonnementEnd;
    private int $uploadCountMensuel;
    
    public function __construct(string $username, string $email,string $password,?string $bio = null, ?string $photoProfil = null,int $uploadCountMensuel = 0,?string $abonnementStart = null, ?string $abonnementEnd = null) {
        parent::__construct($username, $email, $password, 'Pro', $bio, $photoProfil);
        $this->uploadCountMensuel = $uploadCountMensuel;
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
    
    public function getUploadCountMensuel(): int {
        return $this->uploadCountMensuel;
    }

    public function setUploadCountMensuel(int $uploadCountMensuel): void {
        $this->uploadCountMensuel = $uploadCountMensuel;
    }

    public function incrementUpload(): void {
        $this->uploadCountMensuel++;
    }
    
    public function __toString(): string {
        return parent::__toString() . 
               "Uploads: {$this->uploadCountMensuel}\n" .
               "Abonnement Start: {$this->abonnementStart}\n" .
               "Abonnement End: {$this->abonnementEnd}\n";
    }
}
?>