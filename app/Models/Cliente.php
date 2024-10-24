<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'cliente_id';
    public $incrementing = false; // Para usar un campo VARCHAR como clave primaria
    protected $fillable = ['cliente_id', 'nombre', 'ruc'];
    public $timestamps = true;

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }
}
