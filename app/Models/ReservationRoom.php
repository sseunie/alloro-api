<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRoom extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function timeRange()
    {
        return $this->hasMany(ReservationTimeRange::class, 'room', 'name');
    }
}
