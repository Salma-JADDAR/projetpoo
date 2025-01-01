<?php
namespace App\Entities;

abstract class User {
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $role;
    protected ?string $bio;
    protected ?string $photoProfil;
    protected string $createdAt;
    protected ?string $lastLogin;

    public function __construct(string $username, string $email, string $password, string $role, ?string $bio = null, ?string $photoProfil = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
        $this->bio = $bio;
        $this->photoProfil = $photoProfil;
        $this->createdAt = date("Y-m-d H:i:s");
        $this->lastLogin = null;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function setBio(?string $bio): void {
        $this->bio = $bio;
    }

    public function getPhotoProfil(): ?string {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): void {
        $this->photoProfil = $photoProfil;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getLastLogin(): ?string {
        return $this->lastLogin;
    }

    public function setLastLogin(?string $lastLogin): void {
        $this->lastLogin = $lastLogin;
    }

    
    public function checkPassword(string $password): bool {
        return password_verify($password, $this->password);
    }
}
?>
