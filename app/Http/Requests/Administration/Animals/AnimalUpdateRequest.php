<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Animals;

use App\Http\Requests\BasicAuthRequest;
use Illuminate\Http\UploadedFile;

class AnimalUpdateRequest extends BasicAuthRequest
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
        return array_merge(parent::rules(), [
            'name' => 'string|required',
            'species_id' => 'string|required',
            'race_id' => 'string|required',
            'age' => 'integer|required',
            'photo' => 'file',
        ]);
    }

    public function getName(): string
    {
        return (string) $this->input('name');
    }

    public function getSpeciesId(): string
    {
        return (string) $this->input('species_id');
    }

    public function getRaceId(): string
    {
        return (string) $this->input('race_id');
    }

    public function getAge(): int
    {
        return (int) $this->input('age');
    }

    public function getPhoto(): ?UploadedFile
    {
        return $this->file('photo'); // @phpstan-ignore-line
    }
}
