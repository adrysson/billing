<?php

namespace App\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchUploadFilesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'nullable|string',
            'status' => 'nullable|string',
            'created_at' => 'nullable|date',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id.integer' => 'O ID deve ser um número inteiro.',
            'name.string' => 'O nome deve ser uma string.',
            'status.string' => 'O status deve ser uma string.',
            'created_at.date' => 'A data de criação deve ser uma data válida.',
            'page.integer' => 'A página deve ser um número inteiro.',
            'page.min' => 'A página deve ser no mínimo 1.',
        ];
    }
}
