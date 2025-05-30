<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'doctor_id',
        'day',
        'time_start',
        'time_finish',
        'quota',
        'status',
        'schedule_date'
    ];
    
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
