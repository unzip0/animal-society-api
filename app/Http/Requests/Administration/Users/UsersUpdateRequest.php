<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Users;

use App\Http\Requests\Request;

class UsersUpdateRequest extends Request
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
            'name' => 'string|required',
            'first_last_name' => 'string|required',
            'second_last_name' => 'string|required',
        ];
    }

    public function getName(): string
    {
        return (string) $this->input('name');
    }

    public function getFirstLastName(): string
    {
        return (string) $this->input('first_last_name');
    }

    public function getSecondLastName(): string
    {
        return (string) $this->input('second_last_name');
    }
}
