<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;  // Usa PhpSpreadsheet para leer el archivo
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Periodo;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use TypeError;

class ImportExcel extends Controller
{

    public function index(Request $request)
    {
        return view('import.import');

    }



    public function save(Request $request)
    {

    try {
        // Decodificar los datos JSON a arrays
        $clientes = array_map('json_decode', $request->input('clientes'));
        $facturas = array_map('json_decode', $request->input('facturas'));
        $periodos = array_map('json_decode', $request->input('periodos'));
        // Guardar clientes
        foreach ($clientes as $cliente) {
            Cliente::updateOrCreate(
                ['cliente_id' => $cliente->cliente_id],
                ['nombre' => $cliente->nombre]
            );
        }
    
        // Guardar facturas
        foreach ($facturas as $factura) {
            Factura::updateOrCreate(
                ['factura_id' => $factura->factura_id],
                [
                    'saldo_pendiente' => $factura->saldo_pendiente,
                    'cliente_id' => $factura->cliente_id,
                    'fecha_factura' => $factura->fecha_factura,
                    'fecha_vencimiento' => $factura->fecha_vencimiento
                ]
            );
        }
        // Guardar periodos
        foreach ($periodos as $periodo) {
            Periodo::create([
                'factura_id' => $periodo->factura_id,
                'numero' => $periodo->numero,
                'fecha_vencimiento' => $periodo->fecha_vencimiento,
                'monto' => $periodo->monto
            ]);
        }
            
        return redirect()->route('import.index')->with('success', 'Datos guardados exitosamente');
    } catch (QueryException $e) {
        // Manejo genérico de excepciones
        return redirect()->route('import.index')->with('error', 'Ocurrió un error al cargar el archivo, revise la  integridad de datos.');
    }catch (TypeError $e) {
        return redirect()->route('import.index')->with('error', 'Ocurrió un error al cargar el archivo, intentelo denuevo.');
    }
}


    


public function preview(Request $request)
{try {
    // Validar el archivo
    /* $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,xls'
    ]);
 */
    $rules = [
        'excel_file' => 'required|file|mimes:xlsx,xls',
    ];

    // Validar el archivo con el validador manual
    $validator = Validator::make($request->all(), $rules);

    // Si la validación falla, redirigir a index con mensaje de error
    if ($validator->fails()) {
        return redirect()->route('import.index') // Ajusta la ruta 'index' a la adecuada
            ->withErrors($validator)
            ->withInput() // Esto preserva los datos ingresados en el formulario
            ->with('error', 'El archivo subido no es válido. Solo se permiten archivos Excel (.xlsx, .xls)');
    }else{

    // Cargar el archivo Excel
    $file = $request->file('excel_file');
    $spreadsheet = IOFactory::load($file->getPathname());

    // Obtener la primera hoja del archivo
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Inicializar las tablas
    $clientes = [];
    $facturasMap = [];
    $periodos = [];
    $currentCliente = null;

    // Procesar filas de la hoja
    for ($i = 1; $i < count($data); $i++) {
        $row = $data[$i];

        // Verificar si la fila es un cliente
        if (!empty($row[0]) && !empty($row[1]) && empty($row[2]) && empty($row[3]) && empty($row[4]) && empty($row[5]) && empty($row[6]) && empty($row[7])  && !empty($row[8])) {
            $cliente_id = $row[0]; // Código cliente
            $nombre = $row[1];     // Nombre cliente

            // Guardar cliente previo si existe
            if ($currentCliente) {
                $clientes[] = $currentCliente;
            }

            // Crear nuevo cliente
            $currentCliente = [
                'cliente_id' => $cliente_id,
                'nombre' => $nombre,
            ];
            continue;
        }

        // Si es una fila de factura y el número de factura no está vacío
        if ($currentCliente && !empty($row[3])) {
            $factura_id = $row[3]; // N° folio
            $saldo_vencido = floatval(str_replace(['USD ', ','], '', $row[8])) ?: 0;

            // Inicializar la fecha de vencimiento de la factura y la fecha de vencimiento del periodo
            $fecha_factura = $this->formatDate($row[5]);
            $numero = $row[4]; // Cuotas

            // Agregar factura al mapa
            if (!isset($facturasMap[$factura_id])) {
                $facturasMap[$factura_id] = [
                    'factura_id' => $factura_id,
                    'saldo_pendiente' => 0,
                    'cliente_id' => $currentCliente['cliente_id'],
                    'fecha_factura' => $fecha_factura,
                    'fecha_vencimiento' => null // Inicialmente nulo
                ];
            }

            // Acumular saldo pendiente
            $facturasMap[$factura_id]['saldo_pendiente'] += $saldo_vencido;

            // Determinar la fecha de vencimiento de la factura basado en el máximo número de cuota
            if (is_null($facturasMap[$factura_id]['fecha_vencimiento']) || $numero > $facturasMap[$factura_id]['fecha_vencimiento']) {
                $facturasMap[$factura_id]['fecha_vencimiento'] = $this->formatDate($row[6]); // Fecha de vencimiento de la factura
            }

            // Agregar periodo con su fecha de vencimiento específica
            $periodos[] = [
                'factura_id' => $factura_id,
                'numero' => $numero,
                'fecha_vencimiento' => $this->formatDate($row[6]), // Fecha de vencimiento del periodo
                'monto' => floatval(str_replace(['USD ', ','], '', $row[8])) ?: 0
            ];
        }
    }

    // Agregar el último cliente procesado
    if ($currentCliente) {
        $clientes[] = $currentCliente;
    }

    // Convertir facturasMap a un array
    $facturas = array_values($facturasMap);

    // Retornar los datos a la vista
    return view('import.preview', compact('clientes', 'facturas', 'periodos'))->with('error', 'Ocurrió un error al cargar el archivo, revise la  integridad de datos.');

}
} catch (QueryException $e) {
    // Manejo genérico de excepciones
    return redirect()->route('import.index')->with('error', 'Ocurrió un error al cargar el archivo, revise la  integridad de datos.');
}
   
}
/* 
public function preview(Request $request)
{
    try {  // Validar el archivo
    $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,xls'
    ]);

    // Cargar el archivo Excel
    $file = $request->file('excel_file');
    $spreadsheet = IOFactory::load($file->getPathname());

    // Obtener la primera hoja del archivo
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(null, true, true, true); // Array con índices alfabéticos para columnas (A, B, etc.)

    // Inicializar las tablas y variables de error
    $clientes = [];
    $facturasMap = [];
    $periodos = [];
    $currentCliente = null;
    $errors = [];

    // Procesar filas de la hoja
    for ($i = 2; $i <= count($data); $i++) { // Empezar en fila 2 (omitir encabezados)
        $row = $data[$i];

        // Verificar si la fila es un cliente y validar campos requeridos
        if (!empty($row['A']) && !empty($row['B']) && !empty($row['I'])) {
            $cliente_id = $row['A']; // Código cliente
            $nombre = $row['B'];     // Nombre cliente

            // Guardar cliente previo si existe
            if ($currentCliente) {
                $clientes[] = $currentCliente;
            }

            // Crear nuevo cliente
            $currentCliente = [
                'cliente_id' => $cliente_id,
                'nombre' => $nombre,
            ];
        } else {
            // Validar campos obligatorios de cliente y agregar error si falta algo
            if (empty($row['A'])) $errors[] = "Campo vacío en celda {$i}A"; // Código cliente
            if (empty($row['B'])) $errors[] = "Campo vacío en celda {$i}B"; // Nombre cliente
            if (empty($row['I'])) $errors[] = "Campo vacío en celda {$i}I"; // Saldo vencido (o similar)
        }

        // Si es una fila de factura, validar campos requeridos
        if ($currentCliente && !empty($row['D'])) {
            $factura_id = $row['D']; // N° folio
            $saldo_vencido = floatval(str_replace(['USD ', ','], '', $row['I'])) ?: 0;

            if (empty($row['D'])) $errors[] = "Campo vacío en celda {$i}D"; // N° folio
            if (empty($row['F'])) $errors[] = "Campo vacío en celda {$i}F"; // Fecha factura

            // Procesar datos de la factura y periodo
            $fecha_factura = $this->formatDate($row['F']);
            $numero = $row['E']; // Cuotas

            // Agregar factura al mapa
            if (!isset($facturasMap[$factura_id])) {
                $facturasMap[$factura_id] = [
                    'factura_id' => $factura_id,
                    'saldo_pendiente' => 0,
                    'cliente_id' => $currentCliente['cliente_id'],
                    'fecha_factura' => $fecha_factura,
                    'fecha_vencimiento' => null // Inicialmente nulo
                ];
            }

            // Acumular saldo pendiente
            $facturasMap[$factura_id]['saldo_pendiente'] += $saldo_vencido;

            // Determinar la fecha de vencimiento de la factura basado en el máximo número de cuota
            if (is_null($facturasMap[$factura_id]['fecha_vencimiento']) || $numero > $facturasMap[$factura_id]['fecha_vencimiento']) {
                $facturasMap[$factura_id]['fecha_vencimiento'] = $this->formatDate($row['G']); // Fecha de vencimiento de la factura
            }

            // Agregar periodo con su fecha de vencimiento específica
            $periodos[] = [
                'factura_id' => $factura_id,
                'numero' => $numero,
                'fecha_vencimiento' => $this->formatDate($row['G']), // Fecha de vencimiento del periodo
                'monto' => floatval(str_replace(['USD ', ','], '', $row['I'])) ?: 0
            ];
        } else {
            // Validar campos obligatorios de factura
            if (empty($row['D'])) $errors[] = "Campo vacío en celda {$i}D"; // N° folio
            if (empty($row['F'])) $errors[] = "Campo vacío en celda {$i}F"; // Fecha factura
            if (empty($row['G'])) $errors[] = "Campo vacío en celda {$i}G"; // Fecha vencimiento
        }
    }

    // Agregar el último cliente procesado
    if ($currentCliente) {
        $clientes[] = $currentCliente;
    }

    // Convertir facturasMap a un array
    $facturas = array_values($facturasMap);

    // Si hay errores, mostrar el mensaje de error y no mostrar datos
    if (!empty($errors)) {
        return view('import.preview', ['errors' => $errors]);
    }

    // Retornar los datos a la vista en caso de éxito
    return view('import.preview', [
        'clientes' => $clientes,
        'facturas' => $facturas,
        'periodos' => $periodos,
        'success' => 'Importación exitosa'
    ]);

} catch (QueryException $e) {
    // Manejo genérico de excepciones
    return redirect()->route('import.index')->with('error', 'Ocurrió un error al cargar el archivo, revise la  integridad de datos.');
}
   
} */

public function formatDate($fechaStr)
{
    // Separar el string en partes usando '/' como delimitador
    $partes = explode('/', $fechaStr);
    
    // Verificar que se hayan obtenido exactamente 3 partes
    if (count($partes) === 3) {
        // Obtener el día, mes y año
        $mes = $partes[0];
        $dia = $partes[1];
        $anio = $partes[2];
        
        // Reorganizar a la forma yyyy-mm-dd
        $fechaConvertida = $anio.'-'.$mes.'-'.$dia;
        
        // Convertir la cadena a tipo date



        return $fechaConvertida;
    }

    // Si no se pudo convertir la fecha, puedes lanzar una excepción o devolver null
    return null; // O manejar el error de la manera que prefieras
}

}

