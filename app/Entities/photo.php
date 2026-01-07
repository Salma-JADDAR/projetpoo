<?php
declare(strict_types=1);

namespace App\Entities;

use App\Interfaces\Likeable;
use App\Interfaces\Commentable;
use App\Interfaces\Taggable;
use App\Repositories\LikeRepository;
use App\Repositories\CommentRepository;
use App\Repositories\TagRepository;



class Photo implements Likeable, Commentable, Taggable{
    private int $id;
    private string $title;
    private string $description;
    private string $imageLink;
    private int $fileSize;
    private string $mimeType;
    private string $dimensions;
    private string $state;
    private int $viewCount;
    private \DateTime $createdAt;
    private ?\DateTime $updatedAt;
    private ?\DateTime $publishedAt;
    private int $userId;

  public function __construct(string $title,
    string $description,
    string $imageLink,
    int $fileSize,
    string $mimeType,
    string $dimensions,
    int $userId,
    string $state = 'brouillon',
    int $viewCount = 0,
    ?\DateTime $publishedAt = null,
    ?\DateTime $createdAt = null,
    ?\DateTime $updatedAt = null
){

    $this->title = $title;
    $this->description = $description;
    $this->imageLink = $imageLink;
    $this->fileSize = $fileSize;
    $this->mimeType = $mimeType;
    $this->dimensions = $dimensions;
    $this->userId = $userId;
    $this->state = $state;
    $this->viewCount = $viewCount;
    $this->publishedAt = $publishedAt;
    $this->createdAt = $createdAt ?? new \DateTime();
    $this->updatedAt = $updatedAt;
}


 

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImageLink(): string
    {
        return $this->imageLink;
    }

    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    public function getDimensions(): string
    {
        return $this->dimensions;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }
    public function getMimeType(): string {
       return $this->mimeType;
   }
    public function getUserId(): int {
    return $this->userId;
    }

       public function setUserId(int $userId): void {
    $this->userId = $userId;
        }

    public function setMimeType(string $mimeType): void {
       $this->mimeType = $mimeType;
    }
  

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImageLink(string $imageLink): void
    {
        $this->imageLink = $imageLink;
    }

    public function setFileSize(int $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    public function setDimensions(string $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function incrementViewCount(): void
    {
        $this->viewCount++;
    }

    public function setPublishedAt(?\DateTime $publishedAt): void{
        $this->publishedAt = $publishedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void{
        $this->updatedAt = $updatedAt;
    }
   
    public function setId(int $id): void{
        $this->id = $id;
    }
    public function addLike(int $userId): bool
    {
        $repo = new LikeRepository();
        return $repo->addLikeForPhoto($userId, $this->id);
    }

    public function removeLike(int $userId): bool
    {
        $repo = new LikeRepository();
        return $repo->removeLikeForPhoto($userId, $this->id);
    }

    public function isLikedBy(int $userId): bool
    {
        $repo = new LikeRepository();
        return $repo->isLikedByuser($userId, $this->id);
    }

    public function getLikeCount(): int
    {
        $repo = new LikeRepository();
        return $repo->CountByPhoto($this->id);
    }

   

    public function addComment(string $content, int $userId): int
    {
        $repo = new CommentRepository();
        return $repo->add($content, $userId, $this->id);
    }

    public function removeComment(int $commentId): bool
    {
        $repo = new CommentRepository();
        return $repo->remove($commentId);
    }

    public function getComments(): array
    {
        $repo = new CommentRepository();
        return $repo->findByPhoto($this->id);
    }

    public function getCommentCount(): int
    {
        $repo = new CommentRepository();
        return $repo->countByPhoto($this->id);
    }

   

    public function addTag(string $tag): void{
        $repo = new TagRepository();
        $repo->addTag($tag, $this->id);
    }

    public function removeTag(string $tag): void
    {
        $repo = new TagRepository();
        $repo->removeTag($tag, $this->id);
    }

    public function getTags(): array
    {
        $repo = new TagRepository();
        return $repo->getTags($this->id);
    }

    public function hasTag(string $tag): bool
    {
        $repo = new TagRepository();
        return $repo->hasTag($tag, $this->id);
    }

    public function clearTags(): void
    {
        $repo = new TagRepository();
        $repo->cclearTags($this->id);
    }
}
