<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     => ['required','string','min:3','max:255'],
            'author_id' => 'required|exists:authors,id',
        ];
    }

    public function messages(): array 
    {
        return [
            'title.required' => "Le titre est obligatoire",
            'title.min' => "Le titre doit contenir au moins 3 caractères",
            'author_id.required' => "Veuillez choisir un auteur",
        ];
    }

    public function attributes(): array 
    {
        return [
            "title" => "titre",
            "author_id" => "auteur"
        ];
    }
}
