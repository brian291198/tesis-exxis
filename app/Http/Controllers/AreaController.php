<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function listpag(Request $request)
    {
        $totalAreas =Area::count();
 
        $numRecords = (int) $request->input('records');
    
        // Obtiene los clientes según la cantidad de registros solicitados
        $buscarpor = trim($request->get('buscarpor'));
        $areas = Area::where('nombre', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);
    
         // Redirige al método index con los parámetros de la paginación
    return redirect()->route('areas.index', [
        'areas' => $areas,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]); 
    }

public function index(Request $request)
{
    $numRecords = (int) $request->input('records',20);
    $totalAreas =Area::count();
    $buscarpor = trim($request->get('buscarpor'));

        $areas = Area::where('nombre', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);


// Retornar la vista con los clientes paginados
return view('areas.index', compact('areas', 'totalAreas', 'numRecords', 'buscarpor'));
}








    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
        ]);

        Area::create($validated);
        return redirect()->route('areas.index')->with('success', 'Área creada exitosamente.');
    }

    public function show($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.show', compact('area'));
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
        ]);

        $area = Area::findOrFail($id);
        $area->update($validated);
        return redirect()->route('areas.index')->with('success', 'Área actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Área eliminada exitosamente.');
    }
}

