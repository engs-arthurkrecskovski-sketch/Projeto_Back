@php $eq = $equipamento ?? null; @endphp

<div>
    <label class="block text-sm font-medium">Tipo (Console, PC Gamer, Notebook...)</label>
    <input type="text" name="tipo" value="{{ old('tipo', $eq->tipo ?? '') }}" class="mt-1 w-full border-gray-300 rounded">
    @error('tipo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium">Marca</label>
    <input type="text" name="marca" value="{{ old('marca', $eq->marca ?? '') }}" class="mt-1 w-full border-gray-300 rounded">
    @error('marca') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium">Modelo</label>
    <input type="text" name="modelo" value="{{ old('modelo', $eq->modelo ?? '') }}" class="mt-1 w-full border-gray-300 rounded">
    @error('modelo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium">Número de série</label>
    <input type="text" name="numero_serie" value="{{ old('numero_serie', $eq->numero_serie ?? '') }}" class="mt-1 w-full border-gray-300 rounded">
</div>

<div>
    <label class="block text-sm font-medium">Descrição</label>
    <textarea name="descricao" class="mt-1 w-full border-gray-300 rounded">{{ old('descricao', $eq->descricao ?? '') }}</textarea>
</div>