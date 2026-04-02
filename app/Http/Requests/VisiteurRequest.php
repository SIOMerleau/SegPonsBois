<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisiteurRequest extends FormRequest
{
    public function authorize(): bool
    {
        // On autorise tout le monde à envoyer un message (formulaire de contact)
        return true; 
    }

    public function rules(): array
    {
        return [
            'nomVisiteur'    => 'required|string|max:30',
            'prenomVisiteur' => 'required|string|max:30',
            'telVisiteur'    => 'nullable|string|max:15',
            'mailVisiteur'   => 'required|email|max:40', 
            'messageContact' => 'required|string|max:300',
        ];
    }

    public function messages(): array
    {
        return [
            'mailVisiteur.email'      => 'L\'adresse email doit être valide.',
            'messageContact.required' => 'Le message ne peut pas être vide.',
            'nomVisiteur.max'         => 'Le nom est trop long (30 caractères max).',
        ];
    }
}