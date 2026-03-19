<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Autorise la requête. 
     * ATTENTION : Change à 'true' sinon tu auras une erreur 403 (Action non autorisée).
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Définit les règles de validation.
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'username'    => 'required|string|unique:users,username|max:50',
            'telephone'   => 'nullable|string|max:20',
            'code_postal' => 'required|numeric|digits:5',
            'ville'       => 'required|string|max:100',
            'adresse'     => 'required|string|max:255',
        ];
    }

    /**
     * Optionnel : Personnalisation des messages d'erreur.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'Le nom est obligatoire.',
            'code_postal.digits'   => 'Le code postal doit faire exactement 5 chiffres.',
            'username.unique'      => 'Ce nom d\'utilisateur est déjà pris.',
        ];
    }
}