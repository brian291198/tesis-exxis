<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCambio;

class TipoCambioController extends Controller
{
    public function listpag(Request $request)
    {
        $numRecords = (int) $request->input('records');
    
        // Obtiene los clientes según la cantidad de registros solicitados
        $buscarpor = trim($request->get('buscarpor'));
        $clientes = TipoCambio::where('nombre', 'LIKE', '%' . $buscarpor . '%')
        ->paginate($numRecords);
    
         // Redirige al método index con los parámetros de la paginación
    return redirect()->route('clientes.index', [
        'clientes' => $clientes,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]);
    }
    
    public function index(Request $request)
    {
        $numRecords = (int) $request->input('records',20);
        $totalTipos =TipoCambio::count();
        $buscarpor = trim($request->get('buscarpor'));
    
            $tipocambios = TipoCambio::where('valor', 'LIKE', '%' . $buscarpor . '%')
                        ->paginate($numRecords);
       // Realizar la consulta con los parámetros
       $tipocambios = TipoCambio::where('valor', 'LIKE', '%' . $buscarpor . '%')
       ->paginate($numRecords);
    
    // Retornar la vista con los clientes paginados
    return view('tipocambio.index', compact('tipocambios', 'totalTipos', 'numRecords', 'buscarpor'));
    }

    public function scrape()
    {
        // Ejecutar el comando para llamar al script de scraping
        $output = [];
        $returnVar = 0;

        // Ejecutar el script de Node.js
        exec('node' . base_path('public/scrape.js'), $output, $returnVar);

        // Verificar si hubo algún error en la ejecución
        if ($returnVar !== 0) {
            return redirect()->route('tipocambio.index')->with('error', 'Error al ejecutar el script de scraping');
        }

        // Decodificar la salida JSON del script
        $tipoCambioData = json_decode(implode("\n", $output), true);
        // Pasar los datos a la vista
        return view('tipocambio.index', compact('tipoCambioData'));
    }


    public function create()
    {
        return view('tipocambio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'valor' => 'required|numeric',
            'fecha' => 'required|date',
        ], [
            'valor.required' => 'El campo valor es obligatorio.',
            'valor.numeric' => 'El valor debe ser numérico.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.date' => 'El campo fecha debe ser una fecha válida.',
        ]);

        TipoCambio::create($validated);
        return redirect()->route('tipocambio.index')->with('success', 'Tipo de cambio creado exitosamente.');
    }

    public function show($id)
    {
        $tipo = TipoCambio::findOrFail($id);
        return view('tipocambio.show', compact('tipo'));
    }

    public function edit($id)
    {
        $tipo = TipoCambio::findOrFail($id);
        return view('tipocambio.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'valor' => 'required|numeric',
            'fecha' => 'required|date',
        ], [
            'valor.required' => 'El campo valor es obligatorio.',
            'valor.numeric' => 'El valor debe ser numérico.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.date' => 'El campo fecha debe ser una fecha válida.',
        ]);

        $tipo = TipoCambio::findOrFail($id);
        $tipo->update($validated);
        return redirect()->route('tipocambio.index')->with('success', 'Tipo de cambio actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $tipo = TipoCambio::findOrFail($id);
        $tipo->delete();
        return redirect()->route('tipocambio.index')->with('success', 'Tipo de cambio eliminado exitosamente.');
    }

}
