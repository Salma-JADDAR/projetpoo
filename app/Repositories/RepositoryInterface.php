<?php
namespace App\Repositories;
use App\Entities\User;
interface RepositoryInterface{
    public function add(User $user): bool;
    public function findById(int $id): ?User;
    public function update(User $user): bool;
    public function delete(int $id): bool;
}
