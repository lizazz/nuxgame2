<?php

namespace Modules\Imfeelinglucky\App\DTO;

use Spatie\LaravelData\Data;

class CreateUserDTO extends Data
{
    public function __construct(
        public string $username,
        public string $phonenumber,
    ) {}
}
