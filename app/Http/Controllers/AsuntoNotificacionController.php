<?php

namespace App\Http\Controllers;

use App\Models\AsuntoNotificacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsuntoNotificacionController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $asuntos = AsuntoNotificacion::where('titulo', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('asuntos.index', compact('asuntos'));
}


    public function create()
    {
        return view('asuntos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:200',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 200 caracteres.',
        ]);

        AsuntoNotificacion::create($validated);
        return redirect()->route('asuntos.index')->with('success', 'Asunto creado exitosamente.');
    }

    public function show($id)
    {
        $asunto = AsuntoNotificacion::findOrFail($id);
        return view('asuntos.show', compact('asunto'));
    }

    public function edit($id)
    {
        $asunto = AsuntoNotificacion::findOrFail($id);
        return view('asuntos.edit', compact('asunto'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:200',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 200 caracteres.',
        ]);

        $asunto = AsuntoNotificacion::findOrFail($id);
        $asunto->update($validated);
        return redirect()->route('asuntos.index')->with('success', 'Asunto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $asunto = AsuntoNotificacion::findOrFail($id);
        $asunto->delete();
        return redirect()->route('asuntos.index')->with('success', 'Asunto eliminado exitosamente.');
    }
}