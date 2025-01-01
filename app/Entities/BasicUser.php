<?php
namespace App\Entities;

class BasicUser extends User {
    private static int $uploadCountMensuel = 0;

    public function __construct(string $username, string $email, string $password, ?string $bio = null, ?string $photoProfil = null)
    {
        parent::__construct($username, $email, $password, 'Basic', $bio, $photoProfil);
    }

   

    public function incrementUpload() {
        $this->uploadCountMensuel++;
    }
}
?>
