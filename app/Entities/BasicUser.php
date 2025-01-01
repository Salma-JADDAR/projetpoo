<?php
namespace App\Entities;

class BasicUser extends User {
    protected int $uploadCountMensuel = 0;

    public function __construct(string $username, string $email, string $password, ?string $bio = null, ?string $photoProfil = null)
    {
        parent::__construct($username, $email, $password, 'Basic', $bio, $photoProfil);
    }

    public function incrementUpload(): void {
        $this->uploadCountMensuel++;
    }

    public function getUploadCountMensuel(): int {
        return $this->uploadCountMensuel;
    }

    public function resetUploadCount(): void {
        $this->uploadCountMensuel = 0;
    }

    public function __toString(): string {
        return parent::__toString() . "Uploads this month: {$this->uploadCountMensuel}";
    }
}
?>
