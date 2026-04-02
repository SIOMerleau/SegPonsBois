<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvisRequest extends FormRequest
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
                'idProduit' => 'required|integer',
                'etoilesAvis' => 'required|integer|min:1|max:5',
                'texteAvis' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'etoilesAvis.min' => 'La note minimale est de 1 étoile.',
            'etoilesAvis.max' => 'La note maximale est de 5 étoiles.',
            'idProduit.exists' => 'Le produit sélectionné n\'existe pas.',
        ];
    }
}
