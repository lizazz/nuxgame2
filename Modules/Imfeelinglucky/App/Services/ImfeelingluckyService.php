<?php

namespace Modules\Imfeelinglucky\App\Services;

use Modules\Imfeelinglucky\App\Repositories\ResultHistoryRepository;

class ImfeelingluckyService
{
    public function __construct(public ResultHistoryRepository $resultHistoryRepository) {}

    public function getResults(): array
    {
        $value = rand(1, 1000);

        return [
            'value' => $value,
            'result' => ($value % 2 == 0) ? 'Win' : 'Lose',
            'sum' => ($value % 2 == 0) ? $this->calculateSum($value) : 0,
        ];
    }

    public function saveResults(int $userId, array $results): void
    {
        $results['user_id'] = $userId;
        $this->resultHistoryRepository->create($results);
    }

    private function calculateSum(int $value): float
    {
        $winPercentage = match (true) {
            $value > 900 => 0.7,
            $value > 600 => 0.5,
            $value > 300 => 0.3,
            default => 0.1,
        };

        return number_format($value * $winPercentage, 2);
    }

    public function getHistory($userId): array
    {
        return $this->resultHistoryRepository->getLastFive($userId)->toArray();
    }
}
