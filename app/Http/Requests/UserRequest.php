<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        // On récupère l'ID de l'utilisateur en cours de modification (si applicable)
        $userId = $this->route('id'); 

        return [
            'name'        => 'required|string|max:255',
            // On ignore l'ID actuel pour la règle unique lors de l'update
            'username'    => 'required|string|max:50|unique:users,username,' . $userId,
            'telephone'   => 'nullable|string|max:20',
            'code_postal' => 'required|numeric|digits:5',
            'ville'       => 'required|string|max:100',
            'adresse'     => 'required|string|max:255',
            // On ajoute le mot de passe seulement à la création (store)
            'password'    => $this->isMethod('post') ? 'required|string|min:8' : 'nullable|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Le nom est obligatoire.',
            'code_postal.digits' => 'Le code postal doit faire exactement 5 chiffres.',
            'username.unique'    => 'Ce nom d\'utilisateur est déjà pris.',
            'password.min'       => 'Le mot de passe doit faire au moins 8 caractères.',
        ];
    }
}