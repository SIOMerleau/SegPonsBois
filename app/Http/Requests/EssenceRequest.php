<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EssenceRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             '  idEssence' => 'required|integer',
                'varieteEssence' => 'required|string|max:255',
                'typeEssence' => 'nullable|string|max:15',
                'customTypeEssence' => 'nullable|string|max:15',
                'nomLatinEssence' => 'required|string|max:30',
                'origineEssence' => 'nullable|string|max:20',
                'customOrigineEssence' => 'nullable|string|max:20',
                'densiteEssence' => 'nullable|string|max:15',
                'photoEssence' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'durabiliteEssence' => 'nullable|string|max:15',
                'customDurabiliteEssence' => 'nullable|string|max:15',
                'commentaireEssence' => 'required|string|max:255',
        ];
    }
}
