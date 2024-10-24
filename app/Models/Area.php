<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $primaryKey = 'area_id';
    public $timestamps = true;
    protected $fillable = ['nombre'];

    public function periodos()
    {
        return $this->hasMany(Periodo::class, 'area_id');
    }
}
