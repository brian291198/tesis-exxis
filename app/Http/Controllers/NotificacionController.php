<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $notificaciones = Notificacion::where('mensaje', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('notificaciones.index', compact('notificaciones'));
}


    public function create()
    {
        return view('notificaciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:200',
            'mensaje' => 'required|max:500',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 200 caracteres.',
            'mensaje.required' => 'El campo mensaje es obligatorio.',
            'mensaje.max' => 'El mensaje no puede tener más de 500 caracteres.',
        ]);

        Notificacion::create($validated);
        return redirect()->route('notificaciones.index')->with('success', 'Notificación creada exitosamente.');
    }

    public function show($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        return view('notificaciones.show', compact('notificacion'));
    }

    public function edit($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        return view('notificaciones.edit', compact('notificacion'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:200',
            'mensaje' => 'required|max:500',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 200 caracteres.',
            'mensaje.required' => 'El campo mensaje es obligatorio.',
            'mensaje.max' => 'El mensaje no puede tener más de 500 caracteres.',
        ]);

        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update($validated);
        return redirect()->route('notificaciones.index')->with('success', 'Notificación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete();
        return redirect()->route('notificaciones.index')->with('success', 'Notificación eliminada exitosamente.');
    }
}