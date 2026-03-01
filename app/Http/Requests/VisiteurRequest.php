<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisiteurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomVisiteur' => 'required|string|max:30',
            'prenomVisiteur' => 'required|string|max:30',
            'telVisiteur' => 'nullable|string|max:15',
            'mailVisiteur' => 'required|string|email|max:40',
            'messageContact' => 'required|string|max:300',
        ];
    }
}
