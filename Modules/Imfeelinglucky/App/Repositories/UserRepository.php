<?php

namespace Modules\Imfeelinglucky\App\Repositories;

use Modules\Imfeelinglucky\App\Models\User;
use Modules\Imfeelinglucky\App\Repositories\Interfaces\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    public function __construct(public User $model) {}

    public function create(array $data): User
    {
        return $this->model::create($data);
    }

    public function get(int $id): ?User
    {
        return $this->model::find($id);
    }

    public function destroy(int $id): bool
    {
        return $this->model->destroy($id);
    }
}
