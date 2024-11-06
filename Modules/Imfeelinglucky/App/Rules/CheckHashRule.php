<?php

namespace Modules\Imfeelinglucky\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckHashRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Redis::exists("hash:{$value}:user_id")) {
            throw new HttpException(404, 'The requested resource was not found.');
        }
    }
}
