<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Ventas 🍪</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 p-6">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="bg-green-500 text-white p-4 rounded-xl shadow">
        <p class="text-sm font-bold opacity-80">Dinero en Caja</p>
        <p class="text-3xl font-bold">${{ number_format($totalGanado, 0) }}</p>
    </div>
    <div class="bg-red-500 text-white p-4 rounded-xl shadow">
        <p class="text-sm font-bold opacity-80">Por Cobrar (Fiados)</p>
        <p class="text-3xl font-bold">${{ number_format($totalPendiente, 0) }}</p>
    </div>
</div>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-amber-800">📊 Historial de Ventas</h1>
            <a href="{{ route('galletas.index') }}" class="text-amber-600 hover:underline">← Volver al Inventario</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-amber-100 text-amber-800">
                    <tr>
                        <th class="px-6 py-3">Fecha</th>
                        <th class="px-6 py-3">Cliente</th>
                        <th class="px-6 py-3">Galleta</th>
                        <th class="px-6 py-3">Cant.</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Pago</th>
                        <th class="px-6 py-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @foreach($ventas as $venta)
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-medium">{{ $venta->cliente->nombre }}</td>
                        <td class="px-6 py-4">{{ $venta->galleta->nombre }}</td>
                        <td class="px-6 py-4">{{ $venta->cantidad }}</td>
                        <td class="px-6 py-4 font-bold">${{ number_format($venta->total, 0) }}</td>
                        <td class="px-6 py-4 uppercase text-xs">{{ $venta->forma_pago }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-bold {{ $venta->estado == 'pagado' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ strtoupper($venta->estado) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>