<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Ordens de Serviço</h2>
            <a href="{{ route('ordens.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                + Nova Ordem
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">

        @if (session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Equipamento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Técnico</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Abertura</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($ordens as $ordem)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $ordem->equipamento->tipo ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $ordem->equipamento->cliente->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $ordem->tecnico->name ?? 'Não atribuído' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">{{ ucfirst(str_replace('_', ' ', $ordem->status)) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $ordem->data_abertura?->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('ordens.show', $ordem) }}" class="text-slate-600 hover:text-slate-800 font-medium">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-sm text-slate-400">Nenhuma ordem de serviço encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>{{ $ordens->links() }}</div>
    </div>
</x-app-layout>