<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->verificarAdmin($request);

        $users = User::orderBy('name')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function edit(Request $request, User $user)
    {
        $this->verificarAdmin($request);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->verificarAdmin($request);

        $dados = $request->validate([
            'role' => [
                'required',
                Rule::in(['admin', 'tecnico', 'cliente']),
            ],
        ], [
            'role.required' => 'Selecione o papel do usuário.',
            'role.in' => 'O papel selecionado é inválido.',
        ]);

        if (
            $user->id === $request->user()->id
            && $dados['role'] !== 'admin'
        ) {
            return back()->withErrors([
                'role' => 'Você não pode remover seu próprio acesso de administrador.',
            ]);
        }

        if (
            $user->isTecnico()
            && $dados['role'] !== 'tecnico'
            && $user->ordensServicoComoTecnico()
                ->whereIn('status', ['aberta', 'em_andamento'])
                ->exists()
        ) {
            return back()->withErrors([
                'role' => 'Reatribua as ordens abertas deste técnico antes de alterar seu papel.',
            ]);
        }

        $user->update($dados);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Papel do usuário atualizado com sucesso.');
    }

    public function destroy(Request $request, User $user)
    {
        $this->verificarAdmin($request);

        if ($user->id === $request->user()->id) {
            return back()->withErrors([
                'user' => 'Você não pode excluir sua própria conta por esta tela.',
            ]);
        }

        if (
            $user->equipamentos()->exists()
            || $user->ordensServicoComoTecnico()->exists()
        ) {
            return back()->withErrors([
                'user' => 'Este usuário possui equipamentos ou ordens vinculadas e não pode ser excluído.',
            ]);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }

    private function verificarAdmin(Request $request): void
    {
        abort_unless($request->user()?->isAdmin(), 403);
    }
}