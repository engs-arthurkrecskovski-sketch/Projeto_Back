<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdemServicoRequest;
use App\Http\Requests\UpdateOrdemServicoRequest;
use App\Models\Equipamento;
use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrdemServicoController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', OrdemServico::class);

        $consulta = OrdemServico::with('equipamento.cliente', 'tecnico');

        if ($request->user()->isCliente()) {
            $consulta->whereHas('equipamento', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });
        }

        $ordens = $consulta->latest()->paginate(10);

        return view('ordens.index', compact('ordens'));
    }

    public function create(Request $request)
    {
        Gate::authorize('create', OrdemServico::class);

        $consulta = Equipamento::with('cliente');

        if ($request->user()->isCliente()) {
            $consulta->where('user_id', $request->user()->id);
        }

        $equipamentos = $consulta->orderBy('tipo')->get();

        return view('ordens.create', compact('equipamentos'));
    }

    public function store(StoreOrdemServicoRequest $request)
    {
        Gate::authorize('create', OrdemServico::class);

        $dados = $request->validated();

        $equipamento = Equipamento::findOrFail($dados['equipamento_id']);

        if ($request->user()->isCliente()) {
            abort_unless(
                $equipamento->user_id === $request->user()->id,
                403
            );
        }

        $ordem = OrdemServico::create([
            'equipamento_id' => $equipamento->id,
            'descricao_problema' => $dados['descricao_problema'],
            'status' => 'aberta',
            'data_abertura' => today(),
        ]);

        return redirect()
            ->route('ordens.show', $ordem)
            ->with('success', 'Ordem de serviço aberta com sucesso.');
    }

    public function show(OrdemServico $ordem)
    {
        Gate::authorize('view', $ordem);

        $ordem->load('equipamento.cliente', 'tecnico', 'pecas');

        return view('ordens.show', compact('ordem'));
    }

    public function edit(Request $request, OrdemServico $ordem)
    {
        Gate::authorize('update', $ordem);

        $consulta = User::where('role', 'tecnico');

        if (!$request->user()->isAdmin()) {
            $consulta->where('id', $request->user()->id);
        }

        $tecnicos = $consulta->orderBy('name')->get();

        return view('ordens.edit', compact('ordem', 'tecnicos'));
    }

    public function update(
        UpdateOrdemServicoRequest $request,
        OrdemServico $ordem
    ) {
        Gate::authorize('update', $ordem);

        $dados = $request->safe()->only([
            'diagnostico',
            'status',
            'valor_total',
        ]);

        if ($request->user()->isAdmin()) {
            $tecnicoId = $request->validated('tecnico_id');

            if ($tecnicoId !== null) {
                User::where('role', 'tecnico')->findOrFail($tecnicoId);
            }

            $dados['tecnico_id'] = $tecnicoId;
        }

        $status = $dados['status'] ?? $ordem->status;

        $dados['data_fechamento'] = in_array(
            $status,
            ['concluida', 'cancelada'],
            true
        )
            ? ($ordem->data_fechamento ?? today())
            : null;

        $ordem->update($dados);

        return redirect()
            ->route('ordens.show', $ordem)
            ->with('success', 'Ordem de serviço atualizada com sucesso.');
    }

    public function destroy(OrdemServico $ordem)
    {
        Gate::authorize('delete', $ordem);

        $ordem->delete();

        return redirect()
            ->route('ordens.index')
            ->with('success', 'Ordem de serviço excluída com sucesso.');
    }
}