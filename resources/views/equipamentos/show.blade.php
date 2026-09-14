<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Detalhes do Equipamento</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">{{ $equipamento->tipo }} — {{ $equipamento->marca }} {{ $equipamento->modelo }}</h3>
                    <p class="text-sm text-slate-500">Nº Série: {{ $equipamento->numero_serie ?? '—' }}</p>
                </div>
                <a href="{{ route('equipamentos.edit', $equipamento) }}" class="px-3 py-1.5 text-sm font-medium text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50">
                    Editar
                </a>
            </div>

            @if(auth()->user()->isAdmin() || auth()->user()->isTecnico())
                <p class="text-sm text-slate-600 mb-2"><strong>Cliente:</strong> {{ $equipamento->cliente->name ?? '—' }}</p>
            @endif

            <p class="text-sm text-slate-600"><strong>Descrição:</strong> {{ $equipamento->descricao ?? 'Sem descrição.' }}</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
            <h4 class="font-semibold text-slate-800 mb-4">Ordens de Serviço</h4>

            @forelse ($equipamento->ordensServico as $ordem)
                <div class="flex justify-between items-center py-3 border-b border-slate-100 last:border-0">
                    <div>
                        <p class="text-sm font-medium text-slate-700">{{ $ordem->descricao_problema }}</p>
                        <p class="text-xs text-slate-400">Aberta em {{ $ordem->data_abertura?->format('d/m/Y') }}</p>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-blue-50 text-blue-700">
                        {{ \App\Models\OrdemServico::STATUS[$ordem->status] ?? $ordem->status }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-slate-400">Nenhuma ordem de serviço registrada para este equipamento.</p>
            @endforelse
        </div>

        <a href="{{ route('equipamentos.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Voltar para a lista</a>
    </div>
</x-app-layout>