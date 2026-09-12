<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrdemServicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tecnico_id' => ['nullable', 'integer', 'exists:users,id'],
            'diagnostico' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'string', 'in:aberta,em_andamento,concluida,cancelada'],
            'valor_total' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
        ];
    }

    public function messages(): array
    {
        return [
            'tecnico_id.exists' => 'Técnico inválido.',
            'diagnostico.max' => 'O diagnóstico deve ter no máximo 1000 caracteres.',
            'status.required' => 'Selecione o status da ordem de serviço.',
            'status.in' => 'Status inválido.',
            'valor_total.numeric' => 'O valor total deve ser um número.',
            'valor_total.min' => 'O valor total não pode ser negativo.',
            'valor_total.max' => 'O valor informado ultrapassa o limite permitido.',
        ];
    }
}