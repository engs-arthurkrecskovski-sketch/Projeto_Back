<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo' => ['required', 'string', 'max:100'],
            'marca' => ['required', 'string', 'max:100'],
            'modelo' => ['required', 'string', 'max:100'],
            'numero_serie' => ['nullable', 'string', 'max:100'],
            'descricao' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipo.required' => 'Informe o tipo do equipamento (ex: Console, PC Gamer).',
            'tipo.max' => 'O tipo deve ter no máximo 100 caracteres.',
            'marca.required' => 'Informe a marca do equipamento.',
            'marca.max' => 'A marca deve ter no máximo 100 caracteres.',
            'modelo.required' => 'Informe o modelo do equipamento.',
            'modelo.max' => 'O modelo deve ter no máximo 100 caracteres.',
            'numero_serie.max' => 'O número de série deve ter no máximo 100 caracteres.',
            'descricao.max' => 'A descrição deve ter no máximo 1000 caracteres.',
        ];
    }
}