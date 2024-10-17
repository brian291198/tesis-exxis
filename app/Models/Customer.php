<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'num_documento',
        'edad',
        'correo',
        'telefono',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

