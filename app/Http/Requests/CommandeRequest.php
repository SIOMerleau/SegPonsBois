<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends FormRequest
{
    /**
     * On autorise la requête.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Les règles de validation.
     */
    public function rules(): array
    {
        return [
            // 1. Validation de la table Commande
            'reference'     => 'required|string|unique:commandes,reference,' . $this->route('id'),
            'date_commande' => 'required|date',
            'client_id'     => 'required|exists:clients,id',

            // 2. Validation du tableau de produits (Crucial !)
            'produits'      => 'required|array|min:1', 
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.qte'=> 'required|integer|min:1',

            // 3. Validation optionnelle (Pièces ou Offres)
            'pieces'        => 'nullable|array',
            'pieces.*.id'   => 'required_with:pieces|exists:pieces,id',
            'offres'        => 'nullable|array',
        ];
    }

    /**
     * Messages d'erreur en français pour ton API.
     */
    public function messages(): array
    {
        return [
            'reference.unique'     => 'Cette référence de commande existe déjà.',
            'client_id.exists'     => 'Le client sélectionné n\'existe pas.',
            'produits.required'    => 'Vous devez ajouter au moins un produit à la commande.',
            'produits.*.id.exists' => 'Un des produits sélectionnés est invalide.',
            'produits.*.qte.min'   => 'La quantité d\'un produit ne peut pas être inférieure à 1.',
        ];
    }
}