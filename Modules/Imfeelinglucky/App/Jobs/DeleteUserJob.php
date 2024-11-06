<?php

namespace Modules\Imfeelinglucky\App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use Modules\Imfeelinglucky\App\Models\User;
use Modules\Imfeelinglucky\App\Services\UserService;

class DeleteUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user, public string $hashedString) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!Redis::exists("hash:{$this->hashedString}:user_id")) {
            $userService = app()->make(UserService::class);
            $userService->deleteUser($this->user);
        }
    }
}
