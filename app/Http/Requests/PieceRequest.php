<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PieceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'idEssence' => 'required|integer',
            'typePiece' => 'required|string|max:15',
            'photoPiece' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prixHTPiece' => 'required|numeric',
            'stockPiece' => 'required|integer',
            'commentaire' => 'required|string|max:255',
            'referencePiece' => 'required|string|max:255',
            'exportablePiece' => 'required|integer',
        ];
    }
}
