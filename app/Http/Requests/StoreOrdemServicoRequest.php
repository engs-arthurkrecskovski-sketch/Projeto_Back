<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdemServicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipamento_id' => ['required', 'integer', 'exists:equipamentos,id'],
            'descricao_problema' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'equipamento_id.required' => 'Selecione o equipamento.',
            'equipamento_id.exists' => 'Equipamento inválido.',
            'descricao_problema.required' => 'Descreva o problema apresentado.',
            'descricao_problema.min' => 'Descreva o problema com pelo menos 10 caracteres.',
            'descricao_problema.max' => 'A descrição do problema deve ter no máximo 1000 caracteres.',
        ];
    }
}