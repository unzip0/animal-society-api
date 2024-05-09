<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Users;

use App\Http\Requests\Request;

class UsersRegisterRequest extends Request
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
            'id' => 'string|required',
            'name' => 'string|required',
            'first_last_name' => 'string|required',
            'second_last_name' => 'string|required',
            'email' => 'string|required',
            'password' => 'string|required',
            'role' => 'string|required',
            'association_id' => 'string',
        ];
    }

    public function getId(): string
    {
        return (string) $this->input('id');
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

    public function getEmail(): string
    {
        return (string) $this->input('email');
    }

    public function getPassword(): string
    {
        return (string) $this->input('password');
    }

    public function getRole(): string
    {
        return (string) $this->input('role');
    }

    public function getAssociationId(): ?string
    {
        return $this->input('association_id');
    }
}
