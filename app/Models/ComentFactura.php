<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentFactura extends Model
{
    use HasFactory;

    protected $table = 'coment_factura';
    protected $primaryKey = ['com_factura_id', 'factura_id'];
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['factura_id', 'description', 'usuario', 'fecha'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
