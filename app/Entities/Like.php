<?php
namespace App\Entities;

class Like{
    private ?int $id = null;
    private \DateTime $createdAt;

    public function __construct(){
        
        $this->createdAt = new \DateTime();
    }


    public function getId(): ?int{
        return $this->id;
    }

    public function getCreatedAt(): \DateTime{
        return $this->createdAt;
    }

   

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function setCreatedAt(\DateTime $createdAt): void{
        $this->createdAt = $createdAt;
    }
}
