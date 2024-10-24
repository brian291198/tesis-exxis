<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsuntoNotificacion extends Model
{
    use HasFactory;
    protected $table = 'asunto_notificacion';
    protected $primaryKey = 'asunto_id';
    public $timestamps = false;
    protected $fillable = ['titulo'];

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'asunto_id');
    }
}
