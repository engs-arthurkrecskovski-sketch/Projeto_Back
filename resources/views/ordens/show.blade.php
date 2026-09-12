<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ordem de Serviço #{{ $ordem->id }}</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded p-6 space-y-2">
            <p><strong>Equipamento:</strong> {{ $ordem->equipamento->tipo }} - {{ $ordem->equipamento->marca }} {{ $ordem->equipamento->modelo }}</p>
            <p><strong>Cliente:</strong> {{ $ordem->equipamento->cliente->name }}</p>
            <p><strong>Técnico responsável:</strong> {{ $ordem->tecnico->name ?? 'Não atribuído' }}</p>
            <p><strong>Status:</strong> {{ \App\Models\OrdemServico::STATUS[$ordem->status] }}</p>
            <p><strong>Problema relatado:</strong> {{ $ordem->descricao_problema }}</p>
            <p><strong>Diagnóstico:</strong> {{ $ordem->diagnostico ?? '-' }}</p>
            <p><strong>Valor total:</strong> {{ $ordem->valor_total ? 'R$ '.number_format($ordem->valor_total, 2, ',', '.') : '-' }}</p>
            <p><strong>Abertura:</strong> {{ $ordem->data_abertura->format('d/m/Y') }}</p>
            <p><strong>Fechamento:</strong> {{ $ordem->data_fechamento?->format('d/m/Y') ?? '-' }}</p>

            @can('update', $ordem)
                <a href="{{ route('ordens.edit', $ordem) }}" class="inline-block mt-2 text-blue-600">Editar / Atualizar status</a>
            @endcan
            @can('delete', $ordem)
                <form action="{{ route('ordens.destroy', $ordem) }}" method="POST" class="inline" onsubmit="return confirm('Excluir esta OS?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="ml-4 text-red-600">Excluir</button>
                </form>
            @endcan
        </div>

        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold mb-3">Peças utilizadas</h3>
            <ul class="space-y-1 mb-4">
                @forelse ($ordem->pecas as $peca)
                    <li class="flex justify-between border-b py-1">
                        <span>{{ $peca->nome }} (x{{ $peca->quantidade }}) - R$ {{ number_format($peca->valor_unitario, 2, ',', '.') }}</span>
                        @can('update', $ordem)
                            <form action="{{ route('pecas.destroy', [$ordem, $peca]) }}" method="POST" onsubmit="return confirm('Remover peça?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm">remover</button>
                            </form>
                        @endcan
                    </li>
                @empty
                    <li class="text-gray-500">Nenhuma peça registrada.</li>
                @endforelse
            </ul>

            @can('update', $ordem)
                <form action="{{ route('pecas.store', $ordem) }}" method="POST" class="flex gap-2 items-end">
                    @csrf
                    <div>
                        <label class="block text-xs">Nome</label>
                        <input type="text" name="nome" required class="border-gray-300 rounded">
                    </div>
                    <div>
                        <label class="block text-xs">Qtd</label>
                        <input type="number" name="quantidade" min="1" value="1" required class="border-gray-300 rounded w-20">
                    </div>
                    <div>
                        <label class="block text-xs">Valor unit.</label>
                        <input type="number" step="0.01" min="0" name="valor_unitario" required class="border-gray-300 rounded w-28">
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-3 py-2 rounded text-sm">Adicionar</button>
                </form>
            @endcan
        </div>
    </div>
</x-app-layout>