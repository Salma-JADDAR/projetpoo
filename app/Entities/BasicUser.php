<?php
namespace App\Entities;

class BasicUser extends User {
   private int $uploadCountMensuel;

    public function __construct(string $username, string $email, string $password, ?string $bio = null, ?string $photoProfil = null, int $uploadCountMensuel = 0) {
        parent::__construct($username, $email, $password, 'Basic', $bio, $photoProfil);
        $this->uploadCountMensuel = $uploadCountMensuel;
    }

    public function incrementUpload(): bool {
        if ($this->uploadCountMensuel < 10) {
            $this->uploadCountMensuel++;
            return true; 
        }
        return false;
    }


    public function getUploadCountMensuel(): int {
        return $this->uploadCountMensuel;
    }

    public function setUploadCountMensuel($uploadCountMensuel): void {
         $this->uploadCountMensuel=$uploadCountMensuel;
    }

    public function getRemainingUploads(): int {
        return 10 - $this->uploadCountMensuel;
    }

    public function resetUploadCount(): void {
        $this->uploadCountMensuel = 0;
    }

    public function __toString(): string {
        return parent::__toString() . "Uploads this month: {$this->uploadCountMensuel}/10\n";
    }
}
?>