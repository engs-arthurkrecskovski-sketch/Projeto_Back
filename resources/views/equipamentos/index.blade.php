<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Equipamentos</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <a href="{{ route('equipamentos.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                + Novo Equipamento
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Tipo</th>
                        <th class="px-4 py-2">Marca / Modelo</th>
                        @if(!auth()->user()->isCliente())
                            <th class="px-4 py-2">Cliente</th>
                        @endif
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipamentos as $equipamento)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $equipamento->tipo }}</td>
                            <td class="px-4 py-2">{{ $equipamento->marca }} - {{ $equipamento->modelo }}</td>
                            @if(!auth()->user()->isCliente())
                                <td class="px-4 py-2">{{ $equipamento->cliente->name ?? '-' }}</td>
                            @endif
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('equipamentos.show', $equipamento) }}" class="text-indigo-600">Ver</a>
                                <a href="{{ route('equipamentos.edit', $equipamento) }}" class="text-blue-600">Editar</a>
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('equipamentos.destroy', $equipamento) }}" method="POST" class="inline" onsubmit="return confirm('Excluir equipamento?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-4 text-gray-500">Nenhum equipamento cadastrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>