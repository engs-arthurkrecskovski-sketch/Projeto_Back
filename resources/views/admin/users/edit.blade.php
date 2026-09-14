<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Editar Usuário</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nova Senha <span class="text-slate-400 font-normal">(deixe em branco para manter a atual)</span></label>
                    <input type="password" name="password" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Papel</label>
                    <select name="role" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                        <option value="tecnico" @selected(old('role', $user->role) == 'tecnico')>Técnico</option>
                        <option value="cliente" @selected(old('role', $user->role) == 'cliente')>Cliente</option>
                    </select>
                    @error('role') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>