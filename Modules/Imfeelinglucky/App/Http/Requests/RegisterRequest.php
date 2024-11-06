<?php

namespace Modules\Imfeelinglucky\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:1|max:255|unique:users,username',
            'phonenumber' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:users,phonenumber',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
