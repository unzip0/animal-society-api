<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Users;

use App\Http\Requests\Request;

class UserLoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'string|required',
            'password' => 'string|required',
        ];
    }

    public function getEmail(): string
    {
        return (string) $this->input('email');
    }

    public function getPassword(): string
    {
        return (string) $this->input('password');
    }
}
