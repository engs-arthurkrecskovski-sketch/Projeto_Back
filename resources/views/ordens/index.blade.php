<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ordens de Serviço</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <a href="{{ route('ordens.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                + Abrir Ordem de Serviço
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Equipamento</th>
                        <th class="px-4 py-2">Cliente</th>
                        <th class="px-4 py-2">Técnico</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ordens as $os)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $os->id }}</td>
                            <td class="px-4 py-2">{{ $os->equipamento->tipo }} - {{ $os->equipamento->modelo }}</td>
                            <td class="px-4 py-2">{{ $os->equipamento->cliente->name }}</td>
                            <td class="px-4 py-2">{{ $os->tecnico->name ?? '—' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs bg-gray-200">
                                    {{ \App\Models\OrdemServico::STATUS[$os->status] }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('ordens.show', $os) }}" class="text-indigo-600">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-4 text-gray-500">Nenhuma ordem de serviço encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>