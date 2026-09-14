<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Nova Ordem de Serviço</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('ordens.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Equipamento</label>
                    <select name="equipamento_id" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Selecione...</option>
                        @foreach ($equipamentos as $equipamento)
                            <option value="{{ $equipamento->id }}" @selected(old('equipamento_id') == $equipamento->id)>
                                {{ $equipamento->tipo }} @isset($equipamento->cliente) — {{ $equipamento->cliente->name }} @endisset
                            </option>
                        @endforeach
                    </select>
                    @error('equipamento_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Descrição do problema</label>
                    <textarea name="descricao_problema" rows="4" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('descricao_problema') }}</textarea>
                    @error('descricao_problema') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                @if ($tecnicos->isNotEmpty())
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Técnico responsável</label>
                        <select name="tecnico_id" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Não atribuído</option>
                            @foreach ($tecnicos as $tecnico)
                                <option value="{{ $tecnico->id }}" @selected(old('tecnico_id') == $tecnico->id)>{{ $tecnico->name }}</option>
                            @endforeach
                        </select>
                        @error('tecnico_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                            @foreach (\App\Models\OrdemServico::STATUS as $key => $label)
                                <option value="{{ $key }}" @selected(old('status') == $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                @endif

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('ordens.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Abrir chamado</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>