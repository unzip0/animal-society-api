<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Associations;

use App\Http\Requests\Request;

class AssociationsCreateRequest extends Request
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
            'cif' => 'string|required|size:9',
            'name' => 'string|required',
            'city_id' => 'integer|required',
            'email' => 'string|required',
        ];
    }

    public function getId(): string
    {
        return (string) $this->input('id');
    }

    public function getCif(): string
    {
        return (string) $this->input('cif');
    }

    public function getName(): string
    {
        return (string) $this->input('name');
    }

    public function getCityId(): int
    {
        return (int) $this->input('city_id');
    }

    public function getEmail(): string
    {
        return (string) $this->input('email');
    }
}
