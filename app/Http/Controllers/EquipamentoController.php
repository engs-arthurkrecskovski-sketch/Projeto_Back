<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipamentoRequest;
use App\Models\Equipamento;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    public function index(Request $request)
    {
        $this->verificarPapel($request);

        $consulta = Equipamento::with('cliente');

        if ($request->user()->isCliente()) {
            $consulta->where('user_id', $request->user()->id);
        }

        $equipamentos = $consulta->latest()->paginate(10);

        return view('equipamentos.index', compact('equipamentos'));
    }

    public function create(Request $request)
    {
        $this->verificarPapel($request);

        return view('equipamentos.create');
    }

    public function store(StoreEquipamentoRequest $request)
    {
        $this->verificarPapel($request);

        $dados = $request->safe()->only([
            'tipo',
            'marca',
            'modelo',
            'numero_serie',
            'descricao',
        ]);

        $dados['user_id'] = $request->user()->id;

        $equipamento = Equipamento::create($dados);

        return redirect()
            ->route('equipamentos.show', $equipamento)
            ->with('success', 'Equipamento cadastrado com sucesso.');
    }

    public function show(Request $request, Equipamento $equipamento)
    {
        $this->verificarAcesso($request, $equipamento);

        $equipamento->load('cliente', 'ordensServico');

        return view('equipamentos.show', compact('equipamento'));
    }

    public function edit(Request $request, Equipamento $equipamento)
    {
        $this->verificarAcesso($request, $equipamento);

        return view('equipamentos.edit', compact('equipamento'));
    }

    public function update(
        StoreEquipamentoRequest $request,
        Equipamento $equipamento
    ) {
        $this->verificarAcesso($request, $equipamento);

        $equipamento->update($request->safe()->only([
            'tipo',
            'marca',
            'modelo',
            'numero_serie',
            'descricao',
        ]));

        return redirect()
            ->route('equipamentos.show', $equipamento)
            ->with('success', 'Equipamento atualizado com sucesso.');
    }

    public function destroy(Request $request, Equipamento $equipamento)
    {
        abort_unless($request->user()->isAdmin(), 403);

        if ($equipamento->ordensServico()->exists()) {
            return back()->withErrors([
                'equipamento' => 'Este equipamento possui ordens de serviço e não pode ser excluído.',
            ]);
        }

        $equipamento->delete();

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento excluído com sucesso.');
    }

    private function verificarPapel(Request $request): void
    {
        abort_unless(
            in_array(
                $request->user()->role,
                ['admin', 'tecnico', 'cliente'],
                true
            ),
            403
        );
    }

    private function verificarAcesso(
        Request $request,
        Equipamento $equipamento
    ): void {
        $this->verificarPapel($request);

        if ($request->user()->isCliente()) {
            abort_unless(
                $equipamento->user_id === $request->user()->id,
                403
            );
        }
    }
}