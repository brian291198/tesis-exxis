<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'advisor_id',
        'activity_id',
        'titulo',
        'descripcion',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

