<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Usuários</h2>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                + Novo Usuário
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">

        @if (session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">{{ session('error') }}</div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">E-mail</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Papel</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td class="px-6 py-4 text-right text-sm space-x-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-slate-600 hover:text-slate-800 font-medium">Editar</a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Excluir este usuário?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>{{ $users->links() }}</div>
    </div>
</x-app-layout>