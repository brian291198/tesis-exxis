<?php

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AsuntoNotificacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComentFacturaController;
use App\Http\Controllers\ComentPeriodoController;
use App\Http\Controllers\CondicionController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportExcel;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoCambioController;

 Route::get('/', function () {
  return redirect()->route('login'); // Redirige a la ruta 'login'
});
Route::get('/register', function () {
  return view('login');
});


/* Route::get('/pe', function () {
  return view('admin.eliminar-plantilla');
}); */


Route::get('/tipocambio', [TipoCambioController::class, 'index'])->name('tipocambio.index');
Route::post('/tipocambio/scrape', [TipoCambioController::class, 'scrape'])->name('tipocambio.scrape');

Route::middleware(['auth'])->group(function () {


  Route::get(' /img/jpconsultoria_logo.jpg', function () {
    return redirect()->route('retornarHome');
});



    Route::get('/home', [HomeController::class, 'retornarHome'])->name('retornarHome');
    

 
    Route::resource('usuarios', UsuarioController::class)->names('usuarios');
    Route::resource('roles',RolController::class)->names('roles');



/* DASHBOARD */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

/* CLIENTES */

      // Listar cantidad especifica de los clientes (GET /clientes)
      Route::post('/clientes/listpag', [ClienteController::class, 'listpag'])->name('clientes.listpag');

      // Listar clientes por defecto (GET /clientes)
      Route::get('/clientes/index', [ClienteController::class, 'index'])->name('clientes.index');

      // Guardar un nuevo cliente (POST /clientes)
      Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');

      // Mostrar un cliente específico (GET /clientes/{cliente})
      Route::get('clientes/show/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');

      // Actualizar un cliente (PUT/PATCH /clientes/{cliente})
      Route::patch('clientes/update/{cliente_id}', [ClienteController::class, 'update'])->name('clientes.update');

      // Eliminar un cliente (DELETE /clientes/{cliente})
      Route::delete('clientes/destroy/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

/* FACTURAS */


/* PERIODOS */




    Route::resource('asuntos', AsuntoNotificacionController::class);
    Route::resource('tipo-cambio', TipoCambioController::class);
    Route::resource('facturas', FacturaController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('periodos', PeriodoController::class);
    Route::resource('notificaciones', NotificacionController::class);
    Route::resource('archivos', ArchivoController::class);
    Route::resource('comentarios-factura', ComentFacturaController::class);
    Route::resource('comentarios-periodo', ComentPeriodoController::class);
    Route::resource('condiciones', CondicionController::class);
    Route::resource('contactos', ContactoController::class);

    Route::resource('importExcel', ImportExcel::class);



Route::get('/import/import', [ImportExcel::class, 'index'])->name('import.index');

Route::post('/importExcel/save', [ImportExcel::class, 'save'])->name('importExcel.save');
Route::post('/import/preview', [ImportExcel::class, 'preview'])->name('import.preview');
// routes/web.php

/* Route::post('/import/save', [ImportExcel::class, 'save'])->name('import.save'); */
Route::post('/areas/listpag', [AreaController::class, 'listpag'])->name('areas.listpag');
/* Route::post('/clientes/listpag', [ClienteController::class, 'listpag'])->name('clientes.listpag'); */
/* Route::patch('/clientes/update/{cliente_id}', [ClienteController::class, 'update'])->name('clientes.update'); */
Route::post('/facturas/listpag', [FacturaController::class, 'listpag'])->name('facturas.listpag');
Route::post('/periodos/listpag', [PeriodoController::class, 'listpag'])->name('periodos.listpag');



Route::fallback(function () {
  return view('errores.errors-404');
});

});


