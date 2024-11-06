<?php

namespace Modules\Imfeelinglucky\App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $data): Model;
    public function get(int $id): ?Model;

    public function destroy(int $id): bool;
}
