<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Http\Controllers\Controller;
use App\Models\ComentPeriodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodoController extends Controller
{
    public function coment(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'description' => 'max:500',  // Validar que description sea requerido y sea una cadena con un máximo de 500 caracteres
        ], [
    
            'description.max' => 'El comentario no puede ser demasiado extenso.',
        ]);
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Crear un nuevo comentario
        ComentPeriodo::create([
            'periodo_id' => $request->periodo_id,
            'factura_id' => $request->factura_id,  // Asegúrate de que factura_id esté presente en la solicitud
            'description' => $request->description,
            'fecha' => now(),  // Guardar la fecha actual
            'usuario' => $user->name,  // Guardar el nombre del usuario autenticado
        ]);
    
        return redirect()->route('periodos.index')->with('success', 'Comentario guardado exitosamente.');
    }
    

    public function listpag(Request $request)
{
    $totalPeriodos = Periodo::count();
    $numRecords = (int) $request->input('records');
    
    $buscarpor = trim($request->get('buscarpor'));
    $periodos = Periodo::with(['factura', 'area', 'comentarios'])
        ->where(function ($query) use ($buscarpor) {
            $query->where('periodo_id', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('status', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('factura_id', 'LIKE', '%' . $buscarpor . '%');
        })
        ->paginate($numRecords);

    return redirect()->route('periodos.index', [
        'periodos' => $periodos,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]);
}




public function index(Request $request)
{
    $numRecords = (int) $request->input('records', 20);
    $totalPeriodos = Periodo::count();
    $buscarpor = trim($request->get('buscarpor'));

    $periodos = Periodo::with(['factura', 'area', 'comentarios'])
        ->where(function ($query) use ($buscarpor) {
            $query->where('periodo_id', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('status', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('factura_id', 'LIKE', '%' . $buscarpor . '%');
        })
        ->paginate($numRecords);

    return view('periodos.index', compact('buscarpor', 'periodos', 'totalPeriodos', 'numRecords'));
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