<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\ComentFactura;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
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
    ComentFactura::create([
        'factura_id' => $request->factura_id,  // Asegúrate de que factura_id esté presente en la solicitud
        'description' => $request->description,
        'fecha' => now(),  // Guardar la fecha actual
        'usuario' => $user->name,  // Guardar el nombre del usuario autenticado
    ]);

    return redirect()->route('facturas.index')->with('success', 'Comentario guardado exitosamente.');
}


    public function listpag(Request $request)
{
    $totalFacturas = Factura::count();
    $numRecords = (int) $request->input('records');
    
    $buscarpor = trim($request->get('buscarpor'));
    $facturas = Factura::with(['periodos' => function ($query) {
        $query->orderBy('numero', 'asc'); // Ordena los periodos por número de cuota ascendente
    }, 'cliente', 'comentariosFactura' => function ($query) {
        $query->orderBy('com_factura_id', 'desc');
    }])
        ->where(function ($query) use ($buscarpor) {
            $query->where('factura_id', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('concepto', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('servicio', 'LIKE', '%' . $buscarpor . '%')
                  ->orWhere('cliente_id', 'LIKE', '%' . $buscarpor . '%');
        })
        ->paginate($numRecords);

    return redirect()->route('facturas.index', [
        'facturas' => $facturas,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]);
}



public function index(Request $request)
{
    $numRecords = (int) $request->input('records', 20);
    $totalFacturas = Factura::count();
    $buscarpor = trim($request->get('buscarpor'));

    $facturas = Factura::with(['periodos' => function ($query) {
        $query->orderBy('numero', 'asc'); // Ordena los periodos por número de cuota ascendente
    }, 'cliente', 'comentariosFactura' => function ($query) {
        $query->orderBy('com_factura_id', 'desc');
    }])
    ->where(function ($query) use ($buscarpor) {
        $query->where('factura_id', 'LIKE', '%' . $buscarpor . '%')
              ->orWhere('concepto', 'LIKE', '%' . $buscarpor . '%')
              ->orWhere('servicio', 'LIKE', '%' . $buscarpor . '%')
              ->orWhere('cliente_id', 'LIKE', '%' . $buscarpor . '%');
    })
    ->paginate($numRecords);

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

