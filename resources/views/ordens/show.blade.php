<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Ordem de Serviço #{{ $ordem->id }}</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">

        @if (session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-4">
            <div>
                <span class="text-xs uppercase text-slate-400">Equipamento</span>
                <p class="text-slate-800">{{ $ordem->equipamento->tipo ?? '-' }}</p>
            </div>
            <div>
                <span class="text-xs uppercase text-slate-400">Cliente</span>
                <p class="text-slate-800">{{ $ordem->equipamento->cliente->name ?? '-' }}</p>
            </div>
            <div>
                <span class="text-xs uppercase text-slate-400">Descrição do problema</span>
                <p class="text-slate-800">{{ $ordem->descricao_problema }}</p>
            </div>
            <div>
                <span class="text-xs uppercase text-slate-400">Diagnóstico</span>
                <p class="text-slate-800">{{ $ordem->diagnostico ?? 'Ainda não informado' }}</p>
            </div>
            <div>
                <span class="text-xs uppercase text-slate-400">Técnico</span>
                <p class="text-slate-800">{{ $ordem->tecnico->name ?? 'Não atribuído' }}</p>
            </div>
            <div>
                <span class="text-xs uppercase text-slate-400">Status</span>
                <p class="text-slate-800">{{ ucfirst(str_replace('_', ' ', $ordem->status)) }}</p>
            </div>
            <div>
                <span class="text-xs uppercase text-slate-400">Valor total</span>
                <p class="text-slate-800">{{ $ordem->valor_total ? 'R$ ' . number_format($ordem->valor_total, 2, ',', '.') : '-' }}</p>
            </div>

            <div class="flex justify-between pt-4 border-t border-slate-100">
                <a href="{{ route('ordens.index') }}" class="text-sm text-slate-600 hover:text-slate-800">← Voltar</a>
                @if (!auth()->user()->isCliente())
                    <a href="{{ route('ordens.edit', $ordem) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Editar</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>