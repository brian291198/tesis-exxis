<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Cliente;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function exportExcel()
    {
        $clientes = Cliente::all();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Encabezados de las columnas
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'RUC');
        
        // Llenado de datos
        $row = 2;
        foreach ($clientes as $cliente) {
            $sheet->setCellValue('A' . $row, $cliente->cliente_id);
            $sheet->setCellValue('B' . $row, $cliente->nombre);
            $sheet->setCellValue('C' . $row, $cliente->ruc);
            $row++;
        }
        
        // Descargar archivo Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'clientes.xlsx';
        $response = response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
        
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', "attachment; filename=\"$fileName\"");
        
        return $response;
    }

    public function exportPDF()
    {
        $clientes = Cliente::all();
        
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        $dompdf = new Dompdf($pdfOptions);
        
        // Generación de la vista para PDF
        $html = view('report.index_pdf', compact('clientes'))->render();
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        return $dompdf->stream("clientes.pdf", ["Attachment" => true]);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
