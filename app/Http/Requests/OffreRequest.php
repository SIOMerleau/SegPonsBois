<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class OffreRequest extends FormRequest
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
            'designationOffre' => 'required|string|max:255',
            'descriptionOffre' => 'nullable|string|max:255',
            'prixOffre' => 'required|numeric|min:0',
            'dateDebutOffre' => 'required|date',
            'dateFinOffre' => 'required|date|after_or_equal:dateDebutOffre',
        ];
    }
}