<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Animals\AnimalsSpecies;

use App\Http\Requests\Request;

class AnimalsSpeciesCreateRequest extends Request
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
}
