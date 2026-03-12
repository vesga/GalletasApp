<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Galletas 🍪</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen p-6">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-amber-800 flex items-center gap-2">
                <span>🍪</span> Inventario de Galletas
            </h1>
            
            <div class="flex gap-2">
                <a href="{{ route('ventas.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-md transition">
                   <span>📊</span> Ver Ventas
                </a>

                <a href="{{ route('ventas.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-md transition">
                   <span>🛒</span> Registrar Venta
                </a>

                <a href="{{ route('galletas.create') }}"
                   class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    + Agregar Galleta
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-amber-100">
            <table class="w-full text-left">
                <thead class="bg-amber-100 text-amber-800 border-b border-amber-200">
                    <tr>
                        <th class="px-6 py-3 font-bold">Sabor</th>
                        <th class="px-6 py-3 font-bold text-center">Precio</th>
                        <th class="px-6 py-3 font-bold text-center">Stock</th>
                        <th class="px-6 py-3 font-bold text-center">Estado</th>
                        <th class="px-6 py-4 font-bold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @forelse($galletas as $galleta)
                    <tr class="hover:bg-amber-50/50 transition">
                        <td class="px-6 py-4 font-bold text-gray-800 uppercase tracking-tight">{{ $galleta->nombre }}</td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-700">${{ number_format($galleta->precio, 0) }}</td>
                        <td class="px-6 py-4 text-center font-medium text-gray-600">{{ $galleta->stock }} uds</td>
                        <td class="px-6 py-4 text-center">
                            @if($galleta->stock <= 5)
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold ring-1 ring-red-200 uppercase">⚠️ Bajo</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold ring-1 ring-green-200 uppercase">✅ Ok</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('galletas.edit', $galleta) }}"
                                   class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-bold hover:bg-blue-200 transition uppercase">
                                   Editar
                                </a>
                                
                                <form action="{{ route('galletas.destroy', $galleta) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que quieres eliminar esta delicia?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm font-bold hover:bg-red-200 transition uppercase">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">
                            No hay galletas en el horno... ¡Agrega la primera para empezar!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>