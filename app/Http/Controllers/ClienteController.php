<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

/* use App\DataTables\ClientesDataTable; */


class ClienteController extends Controller
{
    public function listpag(Request $request)
    {
        $totalClientes= Cliente::count();
        $numRecords = (int) $request->input('records');
        
    
        // Obtiene los clientes según la cantidad de registros solicitados
        $buscarpor = trim($request->get('buscarpor'));
        $clientes = Cliente::with(['facturas'])->where('cliente_id', 'LIKE', '%' . $buscarpor . '%')->paginate($numRecords);
    
         // Redirige al método index con los parámetros de la paginación
    return redirect()->route('clientes.index', [
        'clientes' => $clientes,
        'records' => $numRecords, 
        'buscarpor' => $buscarpor
    ]); 
    }

    public function index(Request $request)
    {
        $numRecords = (int) $request->input('records', 20);
        $totalClientes = Cliente::count();
        $buscarpor = trim($request->get('buscarpor'));
    
        // Realiza la búsqueda en cliente_id, nombre y ruc
        $clientes = Cliente::with(['facturas'])
            ->where(function ($query) use ($buscarpor) {
                $query->where('cliente_id', 'LIKE', '%' . $buscarpor . '%')
                      ->orWhere('nombre', 'LIKE', '%' . $buscarpor . '%')
                      ->orWhere('ruc', 'LIKE', '%' . $buscarpor . '%');
            })
            ->paginate($numRecords);
    
        // Retornar la vista con los clientes paginados
        return view('clientes.index', compact('buscarpor', 'clientes', 'totalClientes', 'numRecords'));
    }

    public function create()
    {
    
    }

    public function store(Request $request)
{
    // Definimos las reglas de validación y los mensajes
    $rules = [
        'nombre' => 'required|max:200',
        'ruc' => 'required|numeric|digits:11',
    ];

    $messages = [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'nombre.max' => 'El nombre no puede tener más de 200 caracteres.',
        'ruc.required' => 'El campo RUC es obligatorio.',
        'ruc.numeric' => 'El RUC debe contener solo caracteres numéricos.',
        'ruc.digits' => 'El RUC debe tener exactamente 11 dígitos.',
    ];

    try {
        // Validar los datos de entrada
        $validated = $request->validate($rules, $messages);

        // Verifica si cliente_id está vacío
        if (empty($request->cliente_id)) {
            // Busca el último cliente cuyo ID comience con "CSC", basado en el campo updated_at
            $ultimoCliente = Cliente::where('cliente_id', 'like', 'CSC%')->orderBy('updated_at', 'desc')->first();

            // Genera el nuevo cliente_id
            $nuevoId = $ultimoCliente ? intval(substr($ultimoCliente->cliente_id, 3)) + 1 : 1; // "CSC" ocupa los primeros 3 caracteres
            $validated['cliente_id'] = 'CSC' . str_pad($nuevoId, 10, '0', STR_PAD_LEFT);
        } else {
            // Mantener el cliente_id proporcionado si existe
            $validated['cliente_id'] = $request->cliente_id;
        }

        // Crear el cliente con el ID generado
        $clienteCreado = Cliente::create($validated);

        // Comprobar si el cliente fue creado exitosamente
        if ($clienteCreado) {
            return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
        } else {
            return redirect()->route('clientes.index')->with('error', 'El cliente no pudo ser registrado. Intente nuevamente.');
        }
        
    } catch (ValidationException $e) {
        // Redirigir al usuario a la vista anterior con los mensajes de error
        return redirect()->route('clientes.index')
            ->withErrors($e->validator) // Agregar los errores de validación a la sesión
            ->withInput() // Mantener la entrada anterior en el formulario
            ->with('error', 'El cliente no pudo ser registrado. Intente nuevamente.'); // mostrar mensaje de error
    } catch (QueryException $e) {
        // Manejo genérico de excepciones
        return redirect()->route('clientes.index')->with('error', 'Ocurrió un error inesperado. Por favor, inténtelo más tarde.');
    }
}
    

    public function show($id)
    {
        $verCliente = Cliente::findOrFail($id);
        /* return view('clientes.show', compact('cliente')); */
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.')->with('verCliente', $verCliente);
    }

    public function edit($id)
    {
 
    }

    public function update(Request $request, $cliente_id)
{
   // Definimos las reglas de validación y los mensajes
   $rules = [
    'nombre' => 'required|max:200',
    'ruc' => 'required|numeric|digits:11',
    ];

    $messages = [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'nombre.max' => 'El nombre no puede tener más de 200 caracteres.',
        'ruc.required' => 'El campo RUC es obligatorio.',
        'ruc.numeric' => 'El RUC debe contener solo caracteres numéricos.',
        'ruc.digits' => 'El RUC debe tener exactamente 11 dígitos.',
    ];


    // Actualizar los datos del cliente
    /* $cliente->update([
        'nombre' => $validated['nombre'],
        'ruc' => $validated['ruc'] ?? $cliente->ruc, // Mantiene el RUC actual si es null
        'cliente_id' => $validated['cliente_id'] ?? $cliente->cliente_id, // Mantiene el cliente_id actual si no se modifica
    ]); */

    try {


        // Validar los datos de entrada
        $validated = $request->validate($rules, $messages);


    // Verifica si cliente_id está vacío
    if (empty($request->cliente_id)) {
        // Busca el último cliente cuyo ID comience con "CSC", basándose en el campo updated_at
        $ultimoCliente = Cliente::where('cliente_id', 'like', 'CSC%')->orderBy('updated_at', 'desc')->first();

        // Si no hay registros, empezar con 1, de lo contrario sumar 1 al último número encontrado
        $nuevoId = $ultimoCliente ? intval(substr($ultimoCliente->cliente_id, 3)) + 1 : 1; // "CSC" ocupa los primeros 3 caracteres

        // Genera el nuevo cliente_id con el formato "CSC" seguido por un número rellenado con ceros hasta 10 dígitos
        $validated['cliente_id'] = 'CSC' . str_pad($nuevoId, 10, '0', STR_PAD_LEFT);
    } else {
        // Mantener el cliente_id proporcionado si existe
        $validated['cliente_id'] = $request->cliente_id;
    }
    
           // Buscar el cliente por ID
           $cliente = Cliente::findOrFail($cliente_id);
    $cliente->nombre = $request->nombre;
    $cliente->ruc= $request->ruc;

    $cliente->save();

    // Redirigir al índice con un mensaje de éxito
    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');

} catch (ValidationException $e) {
    // Redirigir al usuario a la vista anterior con los mensajes de error
    return redirect()->route('clientes.index')
        ->withErrors($e->validator) // Agregar los errores de validación a la sesión
        ->withInput() // Mantener la entrada anterior en el formulario
        ->with('error', 'El cliente no pudo ser actualizado. Intente nuevamente.'); // mostrar mensaje de error
} catch (QueryException $e) {
    // Manejo genérico de excepciones
    return redirect()->route('clientes.index')->with('error', 'Ocurrió un error inesperado. Por favor, inténtelo más tarde.');
}
}


public function destroy($id)
{
    try {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    } catch (QueryException $e) {
        if ($e->getCode() == "23000") { // Código de error para violación de clave foránea
            return redirect()->route('clientes.index')->with('error', 'El cliente no puede ser eliminado porque tiene facturas registradas.');
        }
        return redirect()->route('clientes.index')->with('error', 'Ocurrió un error al intentar eliminar el cliente.');
    }
}

}