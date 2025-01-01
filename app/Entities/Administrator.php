<?php
namespace App\Entities;

class Administrator extends User {
    private bool $isSuperAdmin;

    public function __construct(string $username, string $email, string $password, bool $isSuperAdmin = false, ?string $bio = null, ?string $photoProfil = null)
    {
        parent::__construct($username, $email, $password, 'Admin', $bio, $photoProfil);
        $this->isSuperAdmin = $isSuperAdmin;
    }

   
}
?>
