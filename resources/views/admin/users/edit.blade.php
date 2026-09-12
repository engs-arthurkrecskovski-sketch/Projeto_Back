<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar papel de {{ $user->name }}</h2>
    </x-slot>

    <div class="py-8 max-w-lg mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white shadow rounded p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium">Papel</label>
                <select name="role" class="mt-1 w-full border-gray-300 rounded">
                    <option value="admin" @selected($user->role == 'admin')>Admin</option>
                    <option value="tecnico" @selected($user->role == 'tecnico')>Técnico</option>
                    <option value="cliente" @selected($user->role == 'cliente')>Cliente</option>
                </select>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Salvar</button>
        </form>
    </div>
</x-app-layout>