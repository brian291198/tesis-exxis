<?php

namespace App\Http\Controllers;

use App\Models\Condicion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CondicionController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $condiciones = Condicion::where('status', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('condiciones.index', compact('condiciones'));
}


    public function create()
    {
        return view('condiciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
        ]);

        Condicion::create($validated);
        return redirect()->route('condiciones.index')->with('success', 'Condición creada exitosamente.');
    }

    public function show($id)
    {
        $condicion = Condicion::findOrFail($id);
        return view('condiciones.show', compact('condicion'));
    }

    public function edit($id)
    {
        $condicion = Condicion::findOrFail($id);
        return view('condiciones.edit', compact('condicion'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
        ]);

        $condicion = Condicion::findOrFail($id);
        $condicion->update($validated);
        return redirect()->route('condiciones.index')->with('success', 'Condición actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $condicion = Condicion::findOrFail($id);
        $condicion->delete();
        return redirect()->route('condiciones.index')->with('success', 'Condición eliminada exitosamente.');
    }
}