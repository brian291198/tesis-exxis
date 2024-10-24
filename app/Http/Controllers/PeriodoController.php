<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{

    public function listpag(Request $request)
    {
        $totalPeriodos =Periodo::count();
 
        $numRecords = (int) $request->input('records');
    
        // Obtiene los periodos según la cantidad de registros solicitados
        $buscarpor = trim($request->get('buscarpor'));
    $periodos = Periodo::where('factura_id', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);
    
         // Redirige al método index con los parámetros de la paginación
    return redirect()->route('periodos.index', [
        'periodos' => $periodos,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]); 
    }



    public function index(Request $request)
    {
        $numRecords = (int) $request->input('records',20);
        $totalPeriodos =Periodo::count();
        
        
        $buscarpor = trim($request->get('buscarpor'));
    $periodos = Periodo::where('factura_id', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);
    /* dd($periodos); */
    
    // Retornar la vista con los periodos paginados
    return view('periodos.index', compact('periodos', 'totalPeriodos', 'numRecords', 'buscarpor'));
    }



    public function create()
    {

    }

    public function store(Request $request)
    {
        /* $validated = $request->validate([
            'nombre' => 'required|max:100',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
        ]); */

        /* Periodo::create($validated); */
        return redirect()->route('periodos.index')->with('success', 'Período creado exitosamente.');
    }

    public function show($id)
    {
        $periodo = Periodo::findOrFail($id);
        return view('periodos.show', compact('periodo'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        /* $validated = $request->validate([
            'nombre' => 'required|max:100',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
        ]); */

        $periodo = Periodo::findOrFail($id);
        /* $periodo->update($validated); */
        return redirect()->route('periodos.index')->with('success', 'Período actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $periodo = Periodo::findOrFail($id);
        $periodo->delete();
        return redirect()->route('periodos.index')->with('success', 'Período eliminado exitosamente.');
    }
}