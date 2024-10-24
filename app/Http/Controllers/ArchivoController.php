<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $archivos = Archivo::where('nombre', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('archivos.index', compact('archivos'));
}


    public function create()
    {
        return view('archivos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'ruta' => 'required|url',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'ruta.required' => 'El campo ruta es obligatorio.',
            'ruta.url' => 'La ruta debe ser una URL válida.',
        ]);

        Archivo::create($validated);
        return redirect()->route('archivos.index')->with('success', 'Archivo creado exitosamente.');
    }

    public function show($id)
    {
        $archivo = Archivo::findOrFail($id);
        return view('archivos.show', compact('archivo'));
    }

    public function edit($id)
    {
        $archivo = Archivo::findOrFail($id);
        return view('archivos.edit', compact('archivo'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'ruta' => 'required|url',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'ruta.required' => 'El campo ruta es obligatorio.',
            'ruta.url' => 'La ruta debe ser una URL válida.',
        ]);

        $archivo = Archivo::findOrFail($id);
        $archivo->update($validated);
        return redirect()->route('archivos.index')->with('success', 'Archivo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);
        $archivo->delete();
        return redirect()->route('archivos.index')->with('success', 'Archivo eliminado exitosamente.');
    }
}