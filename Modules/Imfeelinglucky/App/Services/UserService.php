<?php

namespace Modules\Imfeelinglucky\App\Services;

use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redis;
use Modules\Imfeelinglucky\App\DTO\CreateUserDTO;
use Modules\Imfeelinglucky\App\Jobs\DeleteUserJob;
use Modules\Imfeelinglucky\App\Models\User;
use Modules\Imfeelinglucky\App\Repositories\UserRepository;
use Throwable;

class UserService
{
    public function __construct(public UserRepository $userRepository) {}

    public function createUser(CreateUserDTO $data): User
    {
        return $this->userRepository->create($data->toArray());
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->destroy($user->id);
    }

    public function getUser(int $userId): User
    {
        return $this->userRepository->get($userId);
    }

    public function setExpiredUserJob(User $user, string $hashedString): void
    {
        $secondsInSevenDays = 7 * 24 * 60 * 60;
        $batch = Bus::batch([
            (new DeleteUserJob($user, $hashedString))->delay(Carbon::now()->addDays(10))
        ])->then(function (Batch $batch) {
        })->catch(function (Batch $batch, Throwable $e) {
        })->finally(function (Batch $batch) {
        })->dispatch();

        Redis::setex("user_id:{$user->id}:batch_id", $secondsInSevenDays, $batch->id);
    }
}
