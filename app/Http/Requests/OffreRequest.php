<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nomOffre'       => 'required|string|max:255',
            'date_debut'     => 'required|date',
            'date_fin'       => 'required|date|after:date_debut',
            'idProd_Produit' => 'required|exists:produit,idProd',
            'prixOffre'      => 'required|numeric|min:0',
            'quantiteOf'     => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'date_fin.after'        => 'La date de fin doit être après la date de début.',
            'idProd_Produit.exists' => 'Le produit sélectionné n\'existe pas.',
            'prixOffre.min'         => 'Le prix ne peut pas être négatif.',
        ];
    }
}