<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public $table='clientes';
    protected $fillable=['idcliente','nombre','apellidos','num_documento','edad','correo','telefono'];
    protected $primaryKey='idcliente';
    public $timestamps=false;
    use HasFactory;
}
