<?php
namespace App\Entities;

use DateTime;

class Album{
    private int $id;
    private string $name;
    private bool $public;
    private string $cover;
    private int $photoCount;
    private ?DateTime $publishedAt;
    private ?DateTime $updatedAt;

    public function __construct(int $id,string $name,bool $public = true,string $cover = "",int $photoCount = 0,?DateTime $publishedAt = null) {
        $this->id = $id;
        $this->name = $name;
        $this->public = $public;
        $this->cover = $cover;
        $this->photoCount = $photoCount;
        $this->publishedAt = $publishedAt;
        $this->updatedAt = null;
    }

  

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function isPublic(): bool {
        return $this->public;
    }

    public function getCover(): string {
        return $this->cover;
    }

    public function getPhotoCount(): int {
        return $this->photoCount;
    }

    public function getPublishedAt(): ?DateTime {
        return $this->publishedAt;
    }

    public function getUpdatedAt(): ?DateTime {
        return $this->updatedAt;
    }

    

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
        $this->touch();
    }

    public function setPublic(bool $public): void {
        $this->public = $public;
        $this->touch();
    }

    public function setCover(string $cover): void {
        $this->cover = $cover;
        $this->touch();
    }

    public function setPhotoCount(int $photoCount): void {
        $this->photoCount = $photoCount;
        $this->touch();
    }

    public function setPublishedAt(?DateTime $publishedAt): void {
        $this->publishedAt = $publishedAt;
        $this->touch();
    }

    public function setUpdatedAt(?DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    

    public function incrementPhotoCount(): void {
        $this->photoCount++;
        $this->touch();
    }

    public function decrementPhotoCount(): void {
        if ($this->photoCount > 0) {
            $this->photoCount--;
            $this->touch();
        }
    }

    private function touch(): void {
        $this->updatedAt = new DateTime();
    }
}
