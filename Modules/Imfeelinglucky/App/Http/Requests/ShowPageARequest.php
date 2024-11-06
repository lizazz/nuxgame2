<?php

namespace Modules\Imfeelinglucky\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Imfeelinglucky\App\Rules\CheckHashRule;

class ShowPageARequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'hash' => ['required', 'string', new CheckHashRule()]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    function prepareForValidation(): void
    {
        $this->merge(['hash' => (string) $this->route('hash')]);
    }
}
