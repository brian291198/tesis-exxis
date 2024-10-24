<?php

namespace App\Http\Controllers;

use App\Models\ComentPeriodo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComentPeriodoController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $comentPeriodos = ComentPeriodo::where('description', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('coment_periodo.index', compact('comentPeriodos'));
}


    public function create()
    {
        return view('comentarios-periodo.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:500',
            'periodo_id' => 'required|exists:periodos,id',
        ], [
            'comentario.required' => 'El campo comentario es obligatorio.',
            'comentario.max' => 'El comentario no puede tener más de 500 caracteres.',
            'periodo_id.required' => 'Debe seleccionar un período válido.',
            'periodo_id.exists' => 'El período seleccionado no existe.',
        ]);

        ComentPeriodo::create($validated);
        return redirect()->route('comentarios-periodo.index')->with('success', 'Comentario de período creado exitosamente.');
    }

    public function show($id)
    {
        $comentario = ComentPeriodo::findOrFail($id);
        return view('comentarios-periodo.show', compact('comentario'));
    }

    public function edit($id)
    {
        $comentario = ComentPeriodo::findOrFail($id);
        return view('comentarios-periodo.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:500',
            'periodo_id' => 'required|exists:periodos,id',
        ], [
            'comentario.required' => 'El campo comentario es obligatorio.',
            'comentario.max' => 'El comentario no puede tener más de 500 caracteres.',
            'periodo_id.required' => 'Debe seleccionar un período válido.',
            'periodo_id.exists' => 'El período seleccionado no existe.',
        ]);

        $comentario = ComentPeriodo::findOrFail($id);
        $comentario->update($validated);
        return redirect()->route('comentarios-periodo.index')->with('success', 'Comentario de período actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $comentario = ComentPeriodo::findOrFail($id);
        $comentario->delete();
        return redirect()->route('comentarios-periodo.index')->with('success', 'Comentario de período eliminado exitosamente.');
    }
}