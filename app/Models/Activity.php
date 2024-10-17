<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'chapter_id',
        'descripcion',
        'tiempo_estandar',
        'titulo',
        'fecha',
        'hora_inicio',
        'tiempo_total',
        'hora_fin',
        'justificacion',
        'estado',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
