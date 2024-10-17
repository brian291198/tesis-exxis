<?php

use App\Http\Controllers\AdvisorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ActivityController;

 Route::get('/', function () {
  return redirect()->route('login'); // Redirige a la ruta 'login'
});


/* Route::get('/pe', function () {
  return view('admin.eliminar-plantilla');
}); */

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('admin.plantilla');
    });
    Route::fallback(function () {
      return view('errores.errors-404');
    });
    Route::get('/home', [HomeController::class, 'retornarHome'])->name('retornarHome');
    
    /* ASESORES */
    Route::resource('advisors', AdvisorController::class)->names('asesores');
    Route::get('/advisors', [AdvisorController::class, 'index'])->name('advisors.index');
    Route::get('/asesores', [AdvisorController::class, 'index'])->name('asesores.index');
    /* CLIENTES */
    Route::resource('customers', CustomerController::class)->names('clientes');
    Route::resource('usuarios', UsuarioController::class)->names('usuarios');
    Route::resource('roles',RolController::class)->names('roles');

    
    Route::resource('activities',ActivityController::class)->names('actividades');;

    Route::resource('projects', ProjectController::class);
    Route::get('/users/by-area', [ProjectController::class, 'getUsersByArea'])->name('users.by.area');







});


