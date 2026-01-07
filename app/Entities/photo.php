<?php
declare(strict_types=1);

namespace App\Entities;

use App\Interfaces\Likeable;
use App\Interfaces\Commentable;
use App\Interfaces\Taggable;
use App\Repositories\LikeRepository;
use App\Repositories\CommentRepository;
use App\Repositories\TagRepository;

class Photo implements Likeable, Commentable, Taggable {
    private int $id;
    private string $title;
    private string $description;
    private string $filename;
    private int $taille;
    private string $mimeType;
    private string $dimensions;
    private string $status;
    private int $viewsCount;
    private \DateTime $createdAt;
    private ?\DateTime $updatedAt;
    private ?\DateTime $publishedAt;
    private int $id_user;

    public function __construct(string $title,string $description,string $filename,int $taille,string $mimeType,string $dimensions,
        int $id_user,
        string $status = 'brouillon',
        int $viewsCount = 0,
        ?\DateTime $publishedAt = null,
        ?\DateTime $createdAt = null,
        ?\DateTime $updatedAt = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->filename = $filename;
        $this->taille = $taille;
        $this->mimeType = $mimeType;
        $this->dimensions = $dimensions;
        $this->id_user = $id_user;
        $this->status = $status;
        $this->viewsCount = $viewsCount;
        $this->publishedAt = $publishedAt;
        $this->createdAt = $createdAt ?? new \DateTime();
        $this->updatedAt = $updatedAt;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getImageLink(): string {
        return $this->filename;
    }

    public function getFileSize(): int {
        return $this->taille;
    }

    public function getDimensions(): string {
        return $this->dimensions;
    }

    public function getState(): string {
        return $this->status;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getViewCount(): int {
        return $this->viewsCount;
    }

    public function getViewsCount(): int {
        return $this->viewsCount;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime {
        return $this->updatedAt;
    }

    public function getPublishedAt(): ?\DateTime {
        return $this->publishedAt;
    }

    public function getMimeType(): string {
        return $this->mimeType;
    }

    public function getUserId(): int {
        return $this->id_user;
    }

    // Setters
    public function setUserId(int $id_user): void {
        $this->id_user = $id_user;
    }

    public function setMimeType(string $mimeType): void {
        $this->mimeType = $mimeType;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setImageLink(string $filename): void {
        $this->filename = $filename;
    }

    public function setFileSize(int $taille): void {
        $this->taille = $taille;
    }

    public function setDimensions(string $dimensions): void {
        $this->dimensions = $dimensions;
    }

    public function setState(string $status): void {
        $this->status = $status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function incrementViewCount(): void {
        $this->viewsCount++;
    }

    public function setPublishedAt(?\DateTime $publishedAt): void {
        $this->publishedAt = $publishedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Méthodes Likeable
    public function addLike(int $userId): bool {
        $repo = new LikeRepository();
        return $repo->addLikeForPhoto($userId, $this->id);
    }

    public function removeLike(int $userId): bool {
        $repo = new LikeRepository();
        return $repo->removeLikeForPhoto($userId, $this->id);
    }

    public function isLikedBy(int $userId): bool {
        $repo = new LikeRepository();
        return $repo->isLikedByuser($userId, $this->id);
    }

    public function getLikeCount(): int {
        $repo = new LikeRepository();
        return $repo->CountByPhoto($this->id);
    }

    // Méthodes Commentable
    public function addComment(string $content, int $userId): int {
        $repo = new CommentRepository();
        return $repo->add($content, $userId, $this->id);
    }

    public function removeComment(int $commentId): bool {
        $repo = new CommentRepository();
        return $repo->remove($commentId);
    }

    public function getComments(): array {
        $repo = new CommentRepository();
        return $repo->findByPhoto($this->id);
    }

    public function getCommentCount(): int {
        $repo = new CommentRepository();
        return $repo->countByPhoto($this->id);
    }

    // Méthodes Taggable
    public function addTag(string $tag): void {
        $repo = new TagRepository();
        $repo->addTag($tag, $this->id);
    }

    public function removeTag(string $tag): void {
        $repo = new TagRepository();
        $repo->removeTag($tag, $this->id);
    }

    public function getTags(): array {
        $repo = new TagRepository();
        return $repo->getTags($this->id);
    }

    public function hasTag(string $tag): bool {
        $repo = new TagRepository();
        return $repo->hasTag($tag, $this->id);
    }

    public function clearTags(): void {
        $repo = new TagRepository();
        $repo->clearTags($this->id);
    }
}