<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\Peca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PecaController extends Controller
{
    public function store(Request $request, OrdemServico $ordem)
    {
        Gate::authorize('update', $ordem);

        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:1', 'max:100000'],
            'valor_unitario' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
                'decimal:0,2',
            ],
        ], [
            'nome.required' => 'Informe o nome da peça.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
            'quantidade.required' => 'Informe a quantidade.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade deve ser pelo menos 1.',
            'quantidade.max' => 'A quantidade máxima é 100000.',
            'valor_unitario.required' => 'Informe o valor unitário.',
            'valor_unitario.numeric' => 'Informe um valor numérico.',
            'valor_unitario.min' => 'O valor não pode ser negativo.',
            'valor_unitario.max' => 'O valor informado ultrapassa o limite.',
            'valor_unitario.decimal' => 'Use no máximo duas casas decimais.',
        ]);

        $ordem->pecas()->create($dados);

        return redirect()
            ->route('ordens.show', $ordem)
            ->with('success', 'Peça adicionada com sucesso.');
    }

    public function destroy(OrdemServico $ordem, Peca $peca)
    {
        Gate::authorize('update', $ordem);

        abort_unless(
            $ordem->pecas()->whereKey($peca->id)->exists(),
            404
        );

        $peca->delete();

        return redirect()
            ->route('ordens.show', $ordem)
            ->with('success', 'Peça removida com sucesso.');
    }
}