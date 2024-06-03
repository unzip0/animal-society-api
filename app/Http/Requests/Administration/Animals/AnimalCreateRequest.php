<?php

declare(strict_types=1);

namespace App\Http\Requests\Administration\Animals;

use App\Http\Requests\Request;
use Illuminate\Http\UploadedFile;

class AnimalCreateRequest extends Request
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
            'association_id' => 'string|required',
            'name' => 'string|required',
            'species_id' => 'string|required',
            'race_id' => 'string|required',
            'age' => 'integer|required',
            'photo' => 'file|required',
        ];
    }

    public function getId(): string
    {
        return (string) $this->input('id');
    }

    public function getAssociationId(): string
    {
        return (string) $this->input('association_id');
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

    public function getPhoto(): UploadedFile
    {
        return $this->file('photo'); // @phpstan-ignore-line
    }
}
