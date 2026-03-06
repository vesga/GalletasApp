<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Galletas 🍪</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen p-6">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-amber-800">🍪 Inventario de Galletas</h1>
            <a href="{{ route('galletas.create') }}"
               class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-lg">
                + Agregar Galleta
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-amber-100 text-amber-800">
                    <tr>
                        <th class="px-6 py-3">Sabor</th>
                        <th class="px-6 py-3">Precio</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @forelse($galletas as $galleta)
                    <tr class="hover:bg-amber-50">
                        <td class="px-6 py-4 font-medium">{{ $galleta->nombre }}</td>
                        <td class="px-6 py-4">${{ number_format($galleta->precio, 0) }}</td>
                        <td class="px-6 py-4">{{ $galleta->stock }} uds</td>
                        <td class="px-6 py-4">
                            @if($galleta->stock <= 5)
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-bold">⚠️ Stock bajo</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">✅ Disponible</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('galletas.edit', $galleta) }}"
                               class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm hover:bg-blue-200">Editar</a>
                            <form action="{{ route('galletas.destroy', $galleta) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar esta galleta?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm hover:bg-red-200">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            No hay galletas registradas aún. ¡Agrega la primera!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>