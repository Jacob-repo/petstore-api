<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'status' => ['required', 'in:available,pending,sold'],
            'category.name' => ['nullable', 'string'],
            'tags.0.name' => ['nullable', 'string'],
            'photoUrls.0' => ['nullable', 'url'],
        ];
    }


}
