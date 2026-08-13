<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // Seuls admins ou staff, on profite des roles Spatie
       return $this->user()->hasAnyRole(['admin', 'staff']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name'  => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'email'      => 'required|email|max:255|unique:authors,email',
            'phone'      => 'nullable|string|max:20',
        ];
    }

    public function messages():array
    {
        return [
            "email.unique" => "Cette adresse email est déjà enregistrée"
        ];
    }
}
