<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autorise la requête
    }

    public function rules(): array
    {
        return [
            'idCategorie'        => 'required|exists:categories,idCategorie',
            'designationProduit' => 'required|string|max:255',
            'photoProduit'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prixProduit'        => 'required|numeric|min:0',
            'stockProduit'       => 'required|integer|min:0',
            'descriptionProduit' => 'required|string|max:1000', // Augmenté pour plus de confort
        ];
    }

    public function messages(): array
    {
        return [
            'idCategorie.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'prixProduit.numeric' => 'Le prix doit être une valeur numérique.',
            'photoProduit.image'  => 'Le fichier doit être une image valide.',
        ];
    }
}