<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta 🍪</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen p-6">
    <div class="max-w-lg mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('galletas.index') }}" class="text-amber-600 hover:text-amber-800">← Volver al Inventario</a>
            <h1 class="text-2xl font-bold text-amber-800">🛒 Nueva Venta</h1>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('ventas.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">¿A quién le vendes?</label>
                    <select name="cliente_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-400 outline-none">
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">¿Qué galleta lleva?</label>
                    <select name="galleta_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-400 outline-none">
                        @foreach($galletas as $galleta)
                            <option value="{{ $galleta->id }}" {{ $galleta->stock <= 0 ? 'disabled' : '' }}>
                                {{ $galleta->nombre }} (${{ number_format($galleta->precio, 0) }}) - Stock: {{ $galleta->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                    <input type="number" name="cantidad" value="1" min="1" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-400 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Forma de Pago</label>
                    <select name="forma_pago" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-400 outline-none">
                        <option value="efectivo">💵 Efectivo</option>
                        <option value="nequi">📱 Nequi</option>
                        <option value="daviplata">💳 Daviplata</option>
                        <option value="fiado">📝 Fiado (Pendiente)</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 rounded-lg shadow-lg transition duration-200">
                    Confirmar Venta y Descontar Stock
                </button>
            </form>
        </div>
    </div>
</body>
</html>