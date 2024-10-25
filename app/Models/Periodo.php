<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table = 'periodos';
    protected $primaryKey = 'periodo_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['fecha_vencimiento', 'status', 'area_id', 'fecha_pagado', 'numero', 'monto', 'factura_id'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, ['periodo_id', 'factura_id']);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class, ['periodo_id', 'factura_id', 'notificacion_id']);
    }
    /* public function comentarios()
    {
        return $this->hasMany(ComentPeriodo::class, ['periodo_id', 'factura_id']);

    } */
    public function comentarios()
    {
        return $this->hasMany(ComentPeriodo::class, 'periodo_id', 'periodo_id')
                    ->orderBy('com_periodo_id', 'desc'); // Asegúrate de que este nombre corresponda a la columna en ComentarioPeriodo
    }
}
