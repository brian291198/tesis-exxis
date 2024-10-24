<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condicion extends Model
{
    use HasFactory;

    protected $table = 'condiciones';
    protected $primaryKey = ['condicion_id', 'factura_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['status', 'num_periodos', 'condicion', 'factura_id', 'fecha_registro'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
