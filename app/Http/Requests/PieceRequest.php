<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PieceRequest extends FormRequest
{
    public function authorize(): bool
    {
        // On autorise la requête (indispensable)
        return true; 
    }

    /**
     * Préparation des données avant validation
     */
    protected function prepareForValidation()
    {
        $this->merge([
            // Si exportablePiece n'est pas envoyé, on met 0 par défaut
            'exportablePiece' => $this->exportablePiece ?? 0,
            // On peut aussi forcer la mise en majuscule de la référence
            'referencePiece' => strtoupper($this->referencePiece),
        ]);
    }

    public function rules(): array
    {
        return [
            'idEssence'       => 'required|exists:essences,idEssence',
            'typePiece'       => 'required|string|max:15',
            'photoPiece'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prixHTPiece'     => 'required|numeric|min:0',
            'stockPiece'      => 'required|integer|min:0',
            'commentaire'     => 'nullable|string|max:255',
            'referencePiece'  => 'required|string|max:255|unique:pieces,referencePiece,' . $this->route('id'),
            'exportablePiece' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'idEssence.exists'      => 'L\'essence sélectionnée n\'existe pas.',
            'referencePiece.unique' => 'Cette référence est déjà utilisée.',
            'photoPiece.image'      => 'Le fichier doit être une image.',
        ];
    }
}