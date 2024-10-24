<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(Request $request)
{
    $buscarpor = trim($request->get('buscarpor'));
    $contactos = Contacto::where('nombre', 'LIKE', '%' . $buscarpor . '%')
                    ->orWhere('correo', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
    return view('contactos.index', compact('contactos'));
}


    public function create()
    {
        return view('contactos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email|max:100',
            'telefono' => 'nullable|max:15',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección válida.',
            'email.max' => 'El email no puede tener más de 100 caracteres.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
        ]);

        Contacto::create($validated);
        return redirect()->route('contactos.index')->with('success', 'Contacto creado exitosamente.');
    }

    public function show($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('contactos.show', compact('contacto'));
    }

    public function edit($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('contactos.edit', compact('contacto'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email|max:100',
            'telefono' => 'nullable|max:15',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección válida.',
            'email.max' => 'El email no puede tener más de 100 caracteres.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
        ]);

        $contacto = Contacto::findOrFail($id);
        $contacto->update($validated);
        return redirect()->route('contactos.index')->with('success', 'Contacto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();
        return redirect()->route('contactos.index')->with('success', 'Contacto eliminado exitosamente.');
    }
}