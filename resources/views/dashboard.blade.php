<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="bg-white shadow rounded p-6">
            <p>Bem-vindo, <strong>{{ auth()->user()->name }}</strong>!</p>
            <p class="text-gray-600">Seu papel no sistema: <strong>{{ auth()->user()->role }}</strong></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('equipamentos.index') }}" class="block bg-white shadow rounded p-6 hover:bg-gray-50">
                <h3 class="font-semibold">Equipamentos</h3>
                <p class="text-sm text-gray-500">Consultar e cadastrar equipamentos.</p>
            </a>
            <a href="{{ route('ordens.index') }}" class="block bg-white shadow rounded p-6 hover:bg-gray-50">
                <h3 class="font-semibold">Ordens de Serviço</h3>
                <p class="text-sm text-gray-500">Abrir e acompanhar ordens de serviço.</p>
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="block bg-white shadow rounded p-6 hover:bg-gray-50">
                    <h3 class="font-semibold">Gerenciar Usuários</h3>
                    <p class="text-sm text-gray-500">Área exclusiva do Administrador.</p>
                </a>
            @endif
        </div>

    </div>
</x-app-layout>