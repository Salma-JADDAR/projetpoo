<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Photo;

interface PhotoRepositoryInterface
{
    public function add(Photo $photo): Photo;
    public function update(Photo $photo): bool;
    public function findById(int $id): ?Photo;
    public function delete(int $id): bool;
}
