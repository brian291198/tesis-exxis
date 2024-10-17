<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    public $table='asesores';
    protected $fillable=['idasesor','nombres','dni','edad','Direccion','apellidos','bancaria','Foto','interbancaria'];
    protected $primaryKey='idasesor';
    public $timestamps=false;
    use HasFactory;
}
