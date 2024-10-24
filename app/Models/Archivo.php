<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivos';
    protected $primaryKey = 'archivo_id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'periodo_id', 'factura_id', 'notificacion_id'];

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class, ['periodo_id', 'factura_id', 'notificacion_id']);
    }
}
