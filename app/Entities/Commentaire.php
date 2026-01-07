<?php
namespace App\Entities;

class Commentaire{
    private int $id;
    private string $content;
    private bool $isArchive;
    private \DateTime $createdAt;
    private ?\DateTime $updatedAt;

    public function __construct(string $content, bool $isArchive = false){
        $this->content = $content;
        $this->isArchive = $isArchive;
        $this->createdAt = new \DateTime();
        $this->updatedAt = null;
    }


    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

 
    public function getContent(): string{
        return $this->content;
    }

    public function setContent(string $content): void{
        $this->content = $content;
        $this->updatedAt = new \DateTime();
    }

   
    public function isArchive(): bool{
        return $this->isArchive;
    }

    public function setIsArchive(bool $isArchive): void{
        $this->isArchive = $isArchive;
        $this->updatedAt = new \DateTime();
    }

   
    public function getCreatedAt(): \DateTime{
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime{
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
