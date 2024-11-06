<?php

namespace Modules\Imfeelinglucky\App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Nette\Utils\Random;
use Modules\Imfeelinglucky\App\Models\User;

class HashService
{
    public function getHash(User $user): string
    {
        $hashedString = md5(Hash::make(
            Carbon::now()->format('YmdHisu') .
            $user->username .
            Random::generate() .
            $user->phonenumber
        ));
        $secondsInSevenDays = 7 * 24 * 60 * 60;

        Redis::setex("hash:{$hashedString}:user_id", $secondsInSevenDays, $user->id);

        return $hashedString;
    }

    public function getNewHash(User $user, string $hashedString): string
    {
        Redis::del("hash:{$hashedString}:user_id");

        return $this->getHash($user);
    }

    public function getUserId(string $hashedString): int
    {
        return Redis::get("hash:{$hashedString}:user_id");
    }

    public function cancelDeleteUser(User $user): void
    {
        $batchId = Redis::get("user_id:{$user->id}:batch_id");

        if ($batchId) {
            $batch = Bus::findBatch($batchId);
            $batch?->cancel();
        }
    }

    public function clearCache(User $user, string $hashedString ): void
    {
        Redis::del("hash:{$hashedString}:user_id");
        Redis::del("user_id:{$user->id}:batch_id");
    }
}
