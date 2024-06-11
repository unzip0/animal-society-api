<?php

declare(strict_types=1);

namespace App\Http\Requests;

class BasicAuthRequest extends Request
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
            'association_id' => 'string',
        ];
    }

    public function getAssociationId(): string
    {
        return (string) $this->input('association_id');
    }
}
