<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'customer_id',
        'service_id',
        'area_id',
        'profession_id',
        'plan',
        'estado_pago',
        'estado_trabajo',
        'fechacontacto_ultima',
        'link_drive',
        'observaciones',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}

