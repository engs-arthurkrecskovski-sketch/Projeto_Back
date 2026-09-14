<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-slate-900 rounded-xl p-6 shadow-sm">
            <p class="text-white text-lg">Bem-vindo, <strong>{{ auth()->user()->name }}</strong>!</p>
            <p class="text-slate-300 text-sm mt-1">
                Seu papel no sistema:
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-600 text-white ml-1">
                    {{ auth()->user()->role }}
                </span>
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-slate-50 rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-500 font-medium">Equipamentos cadastrados</p>
                    <div class="bg-indigo-50 p-2.5 rounded-xl">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-slate-800 mt-3">
                    {{ $totalEquipamentos ?? 0 }}
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-500 font-medium">Ordens de serviço abertas</p>
                    <div class="bg-amber-50 p-2.5 rounded-xl">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-slate-800 mt-3">
                    {{ $totalOrdens ?? 0 }}
                </p>
            </div>

            @if(auth()->user()->isAdmin())
            <div class="bg-slate-50 rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-500 font-medium">Usuários ativos</p>
                    <div class="bg-emerald-50 p-2.5 rounded-xl">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-slate-800 mt-3">
                    {{ $totalUsuarios ?? 0 }}
                </p>
            </div>
            @endif

        </div>

    </div>
</x-app-layout>