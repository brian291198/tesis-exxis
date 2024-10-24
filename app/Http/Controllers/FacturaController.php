<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\TipoCambio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function listpag(Request $request)
    {
        $numRecords = (int) $request->input('records');
    
        // Obtiene los clientes según la cantidad de registros solicitados
        $buscarpor = trim($request->get('buscarpor'));
        $facturas = Factura::where('factura_id', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);

         // Redirige al método index con los parámetros de la paginación
    return redirect()->route('facturas.index', [
        'facturas' => $facturas,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]); 
    }



    public function index(Request $request)
{
    $numRecords = (int) $request->input('records',20);
    $totalFacturas =Factura::count();
    
    
    $buscarpor = trim($request->get('buscarpor'));
    $facturas = Factura::with(['tipoCambio', 'cliente'])->where('factura_id', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);

// Retornar la vista con los clientes paginados
/* dd($facturas); */
return view('facturas.index', compact('buscarpor', 'facturas', 'totalFacturas', 'numRecords'));
}
    


    public function create()
    {
        /* $clientes = Cliente::all();
        $tiposCambio = TipoCambio::all();
        return view('facturas.create', compact('clientes', 'tiposCambio')); */
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_factura' => 'required|date',
            'saldo_pendiente' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_id' => 'required|exists:tipo_cambio,id',
            'fecha_vencimiento' => 'required|date',
            'concepto' => 'nullable|max:100',
            'descripcion' => 'nullable|max:200',
            'servicio' => 'nullable|max:200',
        ], [
            'fecha_factura.required' => 'La fecha de la factura es obligatoria.',
            'saldo_pendiente.required' => 'El saldo pendiente es obligatorio.',
            'saldo_pendiente.numeric' => 'El saldo debe ser numérico.',
            'cliente_id.required' => 'Debe seleccionar un cliente válido.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'tipo_id.required' => 'Debe seleccionar un tipo de cambio válido.',
            'tipo_id.exists' => 'El tipo de cambio seleccionado no existe.',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.date' => 'La fecha de vencimiento debe ser válida.',
        ]);

        Factura::create($validated);
        return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
    }

    public function show($id)
    {
        $factura = Factura::findOrFail($id);
        return view('facturas.show', compact('factura'));
    }

    public function edit($id)
    {
        $factura = Factura::findOrFail($id);
        $clientes = Cliente::all();
        $tiposCambio = TipoCambio::all();
        return view('facturas.edit', compact('factura', 'clientes', 'tiposCambio'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fecha_factura' => 'required|date',
            'saldo_pendiente' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_id' => 'required|exists:tipo_cambio,id',
            'fecha_vencimiento' => 'required|date',
            'concepto' => 'nullable|max:100',
            'descripcion' => 'nullable|max:200',
            'servicio' => 'nullable|max:200',
        ], [
            'fecha_factura.required' => 'La fecha de la factura es obligatoria.',
            'saldo_pendiente.required' => 'El saldo pendiente es obligatorio.',
            'saldo_pendiente.numeric' => 'El saldo debe ser numérico.',
            'cliente_id.required' => 'Debe seleccionar un cliente válido.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'tipo_id.required' => 'Debe seleccionar un tipo de cambio válido.',
            'tipo_id.exists' => 'El tipo de cambio seleccionado no existe.',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.date' => 'La fecha de vencimiento debe ser válida.',
        ]);

        $factura = Factura::findOrFail($id);
       /*  $factura->update($validated); */
       $factura->save();
        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada exitosamente.');
    }
}

