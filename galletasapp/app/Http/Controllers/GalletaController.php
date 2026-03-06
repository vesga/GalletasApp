<?php

namespace App\Http\Controllers;

use App\Models\Galleta;
use Illuminate\Http\Request;

class GalletaController extends Controller
{
    public function index()
    {
        $galletas = Galleta::orderBy('nombre')->get();
        return view('galletas.index', compact('galletas'));
    }

    public function create()
    {
        return view('galletas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        Galleta::create($request->only('nombre', 'precio', 'stock'));

        return redirect()->route('galletas.index')->with('success', '¡Galleta registrada!');
    }

    public function edit(Galleta $galleta)
    {
        return view('galletas.edit', compact('galleta'));
    }

    public function update(Request $request, Galleta $galleta)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        $galleta->update($request->only('nombre', 'precio', 'stock'));

        return redirect()->route('galletas.index')->with('success', '¡Galleta actualizada!');
    }

    public function destroy(Galleta $galleta)
    {
        $galleta->delete();
        return redirect()->route('galletas.index')->with('success', '¡Galleta eliminada!');
    }
}