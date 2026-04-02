<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PanierRequest extends FormRequest
{
    public function authorize(): bool
    {
        // On autorise uniquement si l'utilisateur est connecté
        return auth()->check();
    }

    
    protected function prepareForValidation()
    {
        $this->merge([
            'idClient'    => auth()->id(), // Récupère l'ID de l'user connecté
            'datePanier'  => now()->toDateTimeString(),
            'total_price' => 0,
            'status'      => 0,
        ]);
    }

    public function rules(): array
    {
        return [
            // Données envoyées par le client (Android/Web)
            'idProduit'   => 'required|exists:produits,id',
            'quantite'    => 'required|integer|min:1',

            // Données injectées par prepareForValidation (on vérifie qu'elles sont là)
            'idClient'    => 'required|integer',
            'datePanier'  => 'required|date',
            'total_price' => 'required|numeric',
            'status'      => 'required|integer',
        ];
    }
}