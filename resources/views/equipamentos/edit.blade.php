<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Equipamento</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('equipamentos.update', $equipamento) }}" class="bg-white shadow rounded p-6 space-y-4">
            @csrf @method('PUT')
            @include('equipamentos._form')
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Atualizar</button>
        </form>
    </div>
</x-app-layout>