<?php

namespace Promociones\Controllers;

use App\Http\Controllers\Controller;
use Promociones\Model\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::all();
        return view('Promociones::index', compact('promociones'));
    }

    public function create()
    {
        return view('Promociones::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Promocion::create($validated);

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción creada correctamente.');
    }

    public function show(Promocion $promocion)
    {
        return view('Promociones::show', compact('promocion'));
    }

    public function edit(Promocion $promocion)
    {
        return view('Promociones::edit', compact('promocion'));
    }

    public function update(Request $request, Promocion $promocion)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $promocion->update($validated);

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción actualizada correctamente.');
    }

    public function destroy(Promocion $promocion)
    {
        $promocion->delete();

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción eliminada correctamente.');
    }
}