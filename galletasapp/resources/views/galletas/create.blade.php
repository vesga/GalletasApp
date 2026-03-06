<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Galleta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen p-6">

    <div class="max-w-lg mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('galletas.index') }}" class="text-amber-600 hover:text-amber-800">← Volver</a>
            <h1 class="text-2xl font-bold text-amber-800">🍪 Agregar Galleta</h1>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('galletas.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sabor / Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                           placeholder="Ej: Choco chips, Vainilla...">
                    @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio unitario ($)</label>
                    <input type="number" name="precio" value="{{ old('precio') }}" step="0.01"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                           placeholder="Ej: 1500">
                    @error('precio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad en stock</label>
                    <input type="number" name="stock" value="{{ old('stock') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                           placeholder="Ej: 50">
                    @error('stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-lg">
                    Guardar Galleta
                </button>
            </form>
        </div>
    </div>

</body>
</html>