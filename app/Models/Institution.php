<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'abreviatura',
    ];

    public function professions()
    {
        return $this->hasMany(Profession::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

