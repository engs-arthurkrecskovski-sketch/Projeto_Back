<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Equipamentos</h2>
            <a href="{{ route('equipamentos.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                + Novo Equipamento
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">

        @if (session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Marca / Modelo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nº Série</th>
                        @if(auth()->user()->isAdmin() || auth()->user()->isTecnico())
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Cliente</th>
                        @endif
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($equipamentos as $equipamento)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $equipamento->tipo }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $equipamento->marca }} {{ $equipamento->modelo }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $equipamento->numero_serie ?? '—' }}</td>
                            @if(auth()->user()->isAdmin() || auth()->user()->isTecnico())
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $equipamento->cliente->name ?? '—' }}</td>
                            @endif
                            <td class="px-6 py-4 text-right text-sm space-x-3">
                                <a href="{{ route('equipamentos.show', $equipamento) }}" class="text-blue-600 hover:text-blue-800 font-medium">Ver</a>
                                <a href="{{ route('equipamentos.edit', $equipamento) }}" class="text-slate-600 hover:text-slate-800 font-medium">Editar</a>
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('equipamentos.destroy', $equipamento) }}" method="POST" class="inline" onsubmit="return confirm('Remover este equipamento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-400">
                                Nenhum equipamento cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $equipamentos->links() }}
        </div>
    </div>
</x-app-layout>