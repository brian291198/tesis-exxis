<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentPeriodo extends Model
{
    use HasFactory;

    protected $table = 'coment_periodo';
    protected $primaryKey = ['com_periodo_id', 'periodo_id', 'factura_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['periodo_id', 'factura_id', 'description', 'usuario', 'fecha'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, ['periodo_id', 'factura_id']);
    }
}
