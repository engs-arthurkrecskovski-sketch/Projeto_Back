<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $equipamento->tipo }} - {{ $equipamento->marca }} {{ $equipamento->modelo }}</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow rounded p-6">
            <p><strong>Número de série:</strong> {{ $equipamento->numero_serie ?? '-' }}</p>
            <p><strong>Cliente:</strong> {{ $equipamento->cliente->name }}</p>
            <p><strong>Descrição:</strong> {{ $equipamento->descricao ?? '-' }}</p>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold mb-3">Ordens de Serviço deste equipamento</h3>
            <ul class="space-y-2">
                @forelse ($equipamento->ordensServico as $os)
                    <li class="border-b pb-2">
                        <a href="{{ route('ordens.show', $os) }}" class="text-indigo-600">
                            OS #{{ $os->id }} - {{ \App\Models\OrdemServico::STATUS[$os->status] }}
                        </a>
                        <span class="text-gray-500 text-sm"> ({{ $os->tecnico->name ?? 'sem técnico' }})</span>
                    </li>
                @empty
                    <li class="text-gray-500">Nenhuma ordem de serviço registrada.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>