<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScrapeTipoCambio extends Command
{
    protected $signature = 'scrape:tipocambio';
    protected $description = 'Scrape tipo de cambio de la SUNAT';

    public function handle()
    {
        // Ruta del script en la carpeta public
        $scriptPath = public_path('scrape.js');

        // Comprobar si el script existe
        if (!file_exists($scriptPath)) {
            $this->error('El script no se encontró en la ruta especificada.');
            return;
        }

        // Ejecutar el script de Puppeteer
        $output = shell_exec("node $scriptPath 2>&1"); // Capturar errores

        // Comprobar si hubo errores en la ejecución
        if ($output === null) {
            $this->error('Hubo un problema al ejecutar el script de scraping.');
            return;
        }

        // Convertir el resultado JSON a un array
        $tipoCambioData = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Error al decodificar el JSON: ' . json_last_error_msg());
            return;
        }

        // Guardar los resultados en la sesión
        session(['tipoCambio' => $tipoCambioData]);
        
        $this->info('Datos de tipo de cambio actualizados.');
    }
}
