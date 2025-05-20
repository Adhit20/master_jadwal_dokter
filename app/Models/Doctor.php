<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $fillable = ['doctor_name'];
    
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
