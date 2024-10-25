<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $primaryKey = 'factura_id';
    public $incrementing = false;
    protected $fillable = ['factura_id', 'fecha_factura', 'saldo_pendiente', 'concepto', 'cliente_id', 'carta_notarial', 'tipo_id', 'fecha_vencimiento', 'descripcion', 'servicio'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function periodos()
    {
        return $this->hasMany(Periodo::class, 'factura_id');
    }

    public function comentariosFactura()
    {
        return $this->hasMany(ComentFactura::class, 'factura_id');
    }

    public function comentariosPeriodo()
    {
        return $this->hasMany(ComentPeriodo::class, ['periodo_id', 'factura_id']);
    }
}
