<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Galleta;
use App\Models\Cliente; // IMPORTANTE: Agregamos esta línea
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
{
    // Obtenemos las ventas ordenadas por la más reciente
    // Cargamos 'cliente' y 'galleta' para que no de error al mostrar los nombres
    $ventas = Venta::with(['cliente', 'galleta'])->latest()->get();
    
    // Calculamos el total de dinero para un pequeño reporte
    $totalGanado = $ventas->where('estado', 'pagado')->sum('total');
    $totalPendiente = $ventas->where('estado', 'pendiente')->sum('total');

    return view('galletas.historial', compact('ventas', 'totalGanado', 'totalPendiente'));
}
    /**
     * Muestra el formulario para crear una nueva venta.
     * Este es el método que te faltaba y causaba el error.
     */
    public function create()
    {
        // 1. Traemos todos los clientes para el select
        $clientes = Cliente::orderBy('nombre')->get();
        
        // 2. Traemos solo las galletas que tienen stock disponible
        $galletas = Galleta::where('stock', '>', 0)->orderBy('nombre')->get();

        // 3. Retornamos la vista (Asegúrate de que el archivo sea resources/views/galletas/vender.blade.php)
        return view('galletas.vender', compact('clientes', 'galletas'));
    }

    /**
     * Guarda la venta en la base de datos y descuenta el stock.
     */
    public function store(Request $request)
    {
        // 1. Validar que los datos lleguen bien
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'galleta_id' => 'required|exists:galletas,id',
            'cantidad'   => 'required|integer|min:1',
            'forma_pago' => 'required|in:efectivo,nequi,daviplata,fiado',
        ]);

        // Usamos una Transacción por seguridad
        return DB::transaction(function () use ($request) {
            
            // 2. Buscar la galleta para saber el precio y el stock actual
            $galleta = Galleta::findOrFail($request->galleta_id);

            // 3. Verificar si hay suficientes galletas antes de vender
            if ($galleta->stock < $request->cantidad) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "No hay suficiente stock. Solo quedan {$galleta->stock} unidades.");
            }

            // 4. Calcular el total
            $totalVenta = $galleta->precio * $request->cantidad;

            // 5. Crear el registro de la venta
            Venta::create([
                'cliente_id' => $request->cliente_id,
                'galleta_id' => $request->galleta_id,
                'cantidad'   => $request->cantidad,
                'total'      => $totalVenta,
                'forma_pago' => $request->forma_pago,
                // Lógica de estado para el sistema de fiados
                'estado'     => ($request->forma_pago == 'fiado') ? 'pendiente' : 'pagado',
            ]);

            // 6. Descontar del inventario físicamente
            $galleta->decrement('stock', $request->cantidad);

            // 7. Redirigir al inventario con mensaje de éxito
            return redirect()->route('galletas.index')
                ->with('success', "¡Venta realizada! Se vendieron {$request->cantidad} unidades de {$galleta->nombre}.");
        });
    }
}