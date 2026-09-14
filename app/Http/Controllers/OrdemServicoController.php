<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = OrdemServico::with(['equipamento.cliente', 'tecnico']);

        if ($user->isCliente()) {
            $query->whereHas('equipamento', fn ($q) => $q->where('user_id', $user->id));
        } elseif ($user->isTecnico()) {
            // técnico vê todas, pode filtrar as suas se quiser futuramente
        }

        $ordens = $query->latest('data_abertura')->paginate(10);

        return view('ordens.index', compact('ordens'));
    }

    public function create()
    {
        $user = Auth::user();

        $equipamentos = $user->isCliente()
            ? Equipamento::where('user_id', $user->id)->orderBy('tipo')->get()
            : Equipamento::with('cliente')->orderBy('tipo')->get();

        $tecnicos = $user->isAdmin() || $user->isTecnico()
            ? User::where('role', 'tecnico')->orderBy('name')->get()
            : collect();

        return view('ordens.create', compact('equipamentos', 'tecnicos'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'equipamento_id' => 'required|exists:equipamentos,id',
            'descricao_problema' => 'required|string',
        ];

        if ($user->isAdmin() || $user->isTecnico()) {
            $rules += [
                'tecnico_id' => 'nullable|exists:users,id',
                'diagnostico' => 'nullable|string',
                'status' => 'required|in:' . implode(',', array_keys(OrdemServico::STATUS)),
                'valor_total' => 'nullable|numeric|min:0',
            ];
        }

        $data = $request->validate($rules);

        // Cliente só pode abrir OS para o próprio equipamento
        if ($user->isCliente()) {
            $equipamento = Equipamento::findOrFail($data['equipamento_id']);
            if ($equipamento->user_id !== $user->id) {
                abort(403);
            }
            $data['status'] = 'aberta';
        }

        $data['data_abertura'] = now();

        OrdemServico::create($data);

        return redirect()->route('ordens.index')
            ->with('success', 'Ordem de serviço aberta com sucesso.');
    }

    public function show(OrdemServico $ordem)
    {
        $this->autorizarAcesso($ordem);

        $ordem->load(['equipamento.cliente', 'tecnico', 'pecas']);

        return view('ordens.show', compact('ordem'));
    }

    public function edit(OrdemServico $ordem)
    {
        $this->autorizarAcesso($ordem, somenteEdicao: true);

        $tecnicos = User::where('role', 'tecnico')->orderBy('name')->get();

        return view('ordens.edit', compact('ordem', 'tecnicos'));
    }

    public function update(Request $request, OrdemServico $ordem)
    {
        $this->autorizarAcesso($ordem, somenteEdicao: true);

        $data = $request->validate([
            'tecnico_id' => 'nullable|exists:users,id',
            'descricao_problema' => 'required|string',
            'diagnostico' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(OrdemServico::STATUS)),
            'valor_total' => 'nullable|numeric|min:0',
        ]);

        if ($data['status'] === 'concluida' && ! $ordem->data_fechamento) {
            $data['data_fechamento'] = now();
        }

        $ordem->update($data);

        return redirect()->route('ordens.index')
            ->with('success', 'Ordem de serviço atualizada com sucesso.');
    }

    public function destroy(OrdemServico $ordem)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        $ordem->delete();

        return redirect()->route('ordens.index')
            ->with('success', 'Ordem de serviço removida com sucesso.');
    }

    private function autorizarAcesso(OrdemServico $ordem, bool $somenteEdicao = false): void
    {
        $user = Auth::user();

        if ($somenteEdicao && $user->isCliente()) {
            abort(403);
        }

        if ($user->isCliente() && $ordem->equipamento->user_id !== $user->id) {
            abort(403);
        }
    }
}