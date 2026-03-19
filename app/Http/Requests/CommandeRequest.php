<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends FormRequest
{
    /**
     * Change à true pour autoriser la création de commande.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Définition des règles de validation pour le formulaire de commande.
     */
    public function rules(): array
    {
        return [
            // Validation de la commande principale
            'reference'     => 'required|string|unique:commandes,reference',
            'date_commande' => 'required|date',
            'client_id'     => 'required|exists:clients,id',

            // Validation des listes associées (Tableaux)
            'produits'      => 'required|array|min:1',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.qte'=> 'required|integer|min:1',

            'pieces'        => 'nullable|array',
            'pieces.*.id'   => 'required_with:pieces|exists:pieces,id',

            'offres'        => 'nullable|array',
        ];
    }

    /**
     * Messages d'erreur personnalisés (Optionnel mais recommandé)
     */
    public function messages(): array
    {
        return [
            'produits.required' => 'Une commande doit contenir au moins un produit.',
            'produits.*.id.exists' => 'Un des produits sélectionnés n\'existe pas.',
            'client_id.exists' => 'Le client sélectionné est invalide.',
        ];
    }
}