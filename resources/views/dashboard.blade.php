<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-slate-900 rounded-xl p-6 shadow-sm">
            <p class="text-white text-lg">Bem-vindo, <strong>{{ auth()->user()->name }}</strong>!</p>
            <p class="text-slate-300 text-sm mt-1">
                Seu papel no sistema:
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-600 text-white ml-1">
                    {{ auth()->user()->role }}
                </span>
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            <a href="{{ route('equipamentos.index') }}"
               class="group block bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md hover:border-blue-300 transition duration-150">
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50 text-blue-700 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800">Equipamentos</h3>
                </div>
                <p class="text-sm text-slate-500">Consultar e cadastrar equipamentos.</p>
            </a>

            <a href="{{ route('ordens.index') }}"
               class="group block bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md hover:border-blue-300 transition duration-150">
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50 text-blue-700 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800">Ordens de Serviço</h3>
                </div>
                <p class="text-sm text-slate-500">Abrir e acompanhar ordens de serviço.</p>
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}"
                   class="group block bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md hover:border-blue-300 transition duration-150">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50 text-blue-700 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 3c0-1.657-3.134-3-7-3s-7 1.343-7 3" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-800">Gerenciar Usuários</h3>
                    </div>
                    <p class="text-sm text-slate-500">Área exclusiva do Administrador.</p>
                </a>
            @endif

        </div>
    </div>
</x-app-layout>