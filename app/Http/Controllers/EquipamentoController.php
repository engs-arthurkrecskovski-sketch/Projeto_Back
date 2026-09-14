<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipamentoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $equipamentos = $user->isCliente()
            ? Equipamento::where('user_id', $user->id)->latest()->paginate(10)
            : Equipamento::with('cliente')->latest()->paginate(10);

        return view('equipamentos.index', compact('equipamentos'));
    }

    public function create()
    {
        $clientes = Auth::user()->isAdmin()
            ? \App\Models\User::where('role', 'cliente')->orderBy('name')->get()
            : collect();

        return view('equipamentos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'tipo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'user_id' => $user->isAdmin() ? 'required|exists:users,id' : 'nullable',
        ]);

        $data['user_id'] = $user->isAdmin() ? $data['user_id'] : $user->id;

        Equipamento::create($data);

        return redirect()->route('equipamentos.index')
            ->with('success', 'Equipamento cadastrado com sucesso.');
    }

    public function show(Equipamento $equipamento)
    {
        $this->autorizarAcesso($equipamento);

        $equipamento->load('ordensServico');

        return view('equipamentos.show', compact('equipamento'));
    }

    public function edit(Equipamento $equipamento)
    {
        $this->autorizarAcesso($equipamento);

        $clientes = Auth::user()->isAdmin()
            ? \App\Models\User::where('role', 'cliente')->orderBy('name')->get()
            : collect();

        return view('equipamentos.edit', compact('equipamento', 'clientes'));
    }

    public function update(Request $request, Equipamento $equipamento)
    {
        $this->autorizarAcesso($equipamento);

        $user = Auth::user();

        $data = $request->validate([
            'tipo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'user_id' => $user->isAdmin() ? 'required|exists:users,id' : 'nullable',
        ]);

        if ($user->isAdmin()) {
            $equipamento->user_id = $data['user_id'];
        }

        $equipamento->update($data);

        return redirect()->route('equipamentos.index')
            ->with('success', 'Equipamento atualizado com sucesso.');
    }

    public function destroy(Equipamento $equipamento)
    {
        $this->autorizarAcesso($equipamento, somenteAdmin: true);

        $equipamento->delete();

        return redirect()->route('equipamentos.index')
            ->with('success', 'Equipamento removido com sucesso.');
    }

    private function autorizarAcesso(Equipamento $equipamento, bool $somenteAdmin = false): void
    {
        $user = Auth::user();

        if ($somenteAdmin && ! $user->isAdmin()) {
            abort(403);
        }

        if ($user->isCliente() && $equipamento->user_id !== $user->id) {
            abort(403);
        }
    }
}