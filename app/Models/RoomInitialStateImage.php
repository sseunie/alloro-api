<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomInitialStateImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'room_initial_state_id',
        'url'
    ];
}
