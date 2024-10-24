<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model
{
    use HasFactory;
    protected $table = 'tipo_cambio';
    protected $primaryKey = 'tipo_id';
    public $timestamps = false;
    protected $fillable = ['valor', 'fecha'];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'tipo_id');
    }
}
