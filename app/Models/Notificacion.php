<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';
    protected $primaryKey = ['notificacion_id', 'periodo_id', 'factura_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['periodo_id', 'factura_id', 'asunto_id', 'mensaje', 'fecha'];

    public function asunto()
    {
        return $this->belongsTo(AsuntoNotificacion::class, 'asunto_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, ['periodo_id', 'factura_id']);
    }
}
