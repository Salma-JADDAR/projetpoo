<?php
namespace App\Entities;

class Tag{
    private int $id;
    private string $slug;
    private int $photoCount;

    public function __construct(string $slug, int $photoCount = 0){
        $this->slug = $slug;
        $this->photoCount = $photoCount;
    }

   
    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

  
    public function getSlug(): string{
        return $this->slug;
    }

    public function setSlug(string $slug): void{
        $this->slug = $slug;
    }

   
    public function getPhotoCount(): int{
        return $this->photoCount;
    }

    public function setPhotoCount(int $photoCount): void{
        $this->photoCount = $photoCount;
    }

    public function incrementPhotoCount(): void{
        $this->photoCount++;
    }

    public function decrementPhotoCount(): void{
        if ($this->photoCount > 0) {
            $this->photoCount--;
        }
    }
}
