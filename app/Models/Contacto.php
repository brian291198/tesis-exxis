<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contactos';
    protected $primaryKey = ['contacto_id', 'factura_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['correo', 'nombre', 'factura_id'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
