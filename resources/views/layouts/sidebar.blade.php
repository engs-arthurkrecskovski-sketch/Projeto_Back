<aside class="w-64 flex-shrink-0 bg-slate-900 text-slate-200 flex flex-col shadow-lg">

    {{-- Logo / Topo --}}
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <span class="text-lg font-semibold tracking-wide text-white">
            GestOS
        </span>
    </div>

    {{-- Navegação --}}
    <nav class="flex-1 px-3 py-6 space-y-1">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard')
                     ? 'bg-indigo-600 text-white'
                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('equipamentos.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                  {{ request()->routeIs('equipamentos.*')
                     ? 'bg-indigo-600 text-white'
                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Equipamentos
        </a>

        <a href="{{ route('ordens.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                  {{ request()->routeIs('ordens.*')
                     ? 'bg-indigo-600 text-white'
                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Ordens de Serviço
        </a>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                      {{ request()->routeIs('admin.users.*')
                         ? 'bg-indigo-600 text-white'
                         : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                </svg>
                Gerenciar Usuários
            </a>
        @endif

    </nav>

    {{-- Rodapé / usuário logado --}}
    <div class="px-3 py-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Sair
            </button>
        </form>
    </div>

</aside>