<?php

namespace Modules\Imfeelinglucky\App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Imfeelinglucky\App\Models\ResultHistory;
use Modules\Imfeelinglucky\App\Repositories\Interfaces\RepositoryInterface;

class ResultHistoryRepository implements RepositoryInterface
{
    public function __construct(public ResultHistory $model) {}

    public function create(array $data): ResultHistory
    {
        return $this->model::create($data);
    }

    public function get(int $id): ?ResultHistory
    {
        return $this->model->find($id);
    }

    public function destroy(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function getLastFive(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->orderBy('created_at', 'desc')->take(5)->get();
    }
}
