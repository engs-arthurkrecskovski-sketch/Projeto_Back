<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar OS #{{ $ordem->id }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form method="POST"
              action="{{ route('ordens.update', $ordem) }}"
              class="bg-white shadow rounded p-6 space-y-4">
            @csrf
            @method('PUT')

            @if (auth()->user()->isAdmin())
                <div>
                    <label for="tecnico_id" class="block text-sm font-medium">
                        Técnico responsável
                    </label>

                    <select id="tecnico_id"
                            name="tecnico_id"
                            class="mt-1 w-full border-gray-300 rounded">
                        <option value="">Não atribuído</option>

                        @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id }}"
                                @selected(old('tecnico_id', $ordem->tecnico_id) == $tecnico->id)>
                                {{ $tecnico->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <div>
                    <p class="text-sm font-medium">Técnico responsável</p>
                    <p>{{ $ordem->tecnico?->name ?? 'Não atribuído' }}</p>
                </div>
            @endif

            <div>
                <label for="diagnostico" class="block text-sm font-medium">
                    Diagnóstico
                </label>

                <textarea id="diagnostico"
                          name="diagnostico"
                          rows="3"
                          class="mt-1 w-full border-gray-300 rounded">{{ old('diagnostico', $ordem->diagnostico) }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium">
                    Status
                </label>

                <select id="status"
                        name="status"
                        class="mt-1 w-full border-gray-300 rounded">
                    @foreach (\App\Models\OrdemServico::STATUS as $value => $label)
                        <option value="{{ $value }}"
                            @selected(old('status', $ordem->status) == $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="valor_total" class="block text-sm font-medium">
                    Valor total (R$)
                </label>

                <input id="valor_total"
                       type="number"
                       step="0.01"
                       min="0"
                       name="valor_total"
                       value="{{ old('valor_total', $ordem->valor_total) }}"
                       class="mt-1 w-full border-gray-300 rounded">
            </div>

            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Salvar
            </button>
        </form>
    </div>
</x-app-layout>