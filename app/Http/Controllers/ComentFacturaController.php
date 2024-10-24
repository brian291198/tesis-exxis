<?php

namespace App\Http\Controllers;

use App\Models\ComentFactura;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComentFacturaController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $comentFacturas = ComentFactura::where('description', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('coment_factura.index', compact('comentFacturas'));
}


    public function create()
    {
        return view('comentarios-factura.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:500',
            'factura_id' => 'required|exists:faturas,id',
        ], [
            'comentario.required' => 'El campo comentario es obligatorio.',
            'comentario.max' => 'El comentario no puede tener más de 500 caracteres.',
            'factura_id.required' => 'Debe seleccionar una factura válida.',
            'factura_id.exists' => 'La factura seleccionada no existe.',
        ]);

        ComentFactura::create($validated);
        return redirect()->route('comentarios-factura.index')->with('success', 'Comentario de factura creado exitosamente.');
    }

    public function show($id)
    {
        $comentario = ComentFactura::findOrFail($id);
        return view('comentarios-factura.show', compact('comentario'));
    }

    public function edit($id)
    {
        $comentario = ComentFactura::findOrFail($id);
        return view('comentarios-factura.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:500',
            'factura_id' => 'required|exists:faturas,id',
        ], [
            'comentario.required' => 'El campo comentario es obligatorio.',
            'comentario.max' => 'El comentario no puede tener más de 500 caracteres.',
            'factura_id.required' => 'Debe seleccionar una factura válida.',
            'factura_id.exists' => 'La factura seleccionada no existe.',
        ]);

        $comentario = ComentFactura::findOrFail($id);
        $comentario->update($validated);
        return redirect()->route('comentarios-factura.index')->with('success', 'Comentario de factura actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $comentario = ComentFactura::findOrFail($id);
        $comentario->delete();
        return redirect()->route('comentarios-factura.index')->with('success', 'Comentario de factura eliminado exitosamente.');
    }
}