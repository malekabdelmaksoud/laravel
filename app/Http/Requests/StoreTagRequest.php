<?php

namespace App\\Http\\Requests;

use Illuminate\\Contracts\\Validation\\ValidationRule;
use Illuminate\\Foundation\\Http\\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-tags') ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
            'slug' => ['required', 'string', 'max:255', 'unique:tags,slug'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Ce slug est déjà utilisé par un autre tag.',
        ];
    }
}
