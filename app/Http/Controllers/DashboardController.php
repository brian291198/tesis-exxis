<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Area;
use App\Models\Periodo;
use App\Models\Notificacion;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $totalClientes = Cliente::count();
        $totalFacturas = Factura::count();
        $totalAreas = Area::count();
        $totalPeriodos = Periodo::count();
        $totalNotificaciones = Notificacion::count();

        // Pasar los totales a la vista (opcional)
        return view('dashboard.index', compact('totalClientes', 'totalFacturas', 'totalAreas', 'totalPeriodos', 'totalNotificaciones'));

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
