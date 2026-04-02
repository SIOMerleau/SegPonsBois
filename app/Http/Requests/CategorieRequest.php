<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{
    /**
     * TRÈS IMPORTANT : Passer à true.
     */
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        // On récupère l'ID actuel pour ignorer la règle 'unique' lors d'une modification
        $id = $this->route('id'); 

        return [
            // On ne valide généralement pas l'ID ici car il est géré par la route
            'libelleCategorie' => 'required|string|max:255|unique:categories,libelleCategorie,' . $id . ',idCategorie'
        ];
    }

    public function messages(): array
    {
        return [
            'libelleCategorie.required' => 'Le nom de la catégorie est obligatoire.',
            'libelleCategorie.unique'   => 'Cette catégorie existe déjà.',
        ];
    }
}