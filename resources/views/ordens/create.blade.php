<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Abrir Ordem de Serviço</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('ordens.store') }}" class="bg-white shadow rounded p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Equipamento</label>
                <select name="equipamento_id" class="mt-1 w-full border-gray-300 rounded">
                    <option value="">Selecione...</option>
                    @foreach ($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}" @selected(old('equipamento_id') == $equipamento->id)>
                            {{ $equipamento->tipo }} - {{ $equipamento->marca }} {{ $equipamento->modelo }}
                            @if(!auth()->user()->isCliente()) ({{ $equipamento->cliente->name }}) @endif
                        </option>
                    @endforeach
                </select>
                @error('equipamento_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Descrição do problema</label>
                <textarea name="descricao_problema" rows="4" class="mt-1 w-full border-gray-300 rounded">{{ old('descricao_problema') }}</textarea>
                @error('descricao_problema') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Abrir OS</button>
        </form>
    </div>
</x-app-layout>