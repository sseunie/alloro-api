<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomInitialState extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'chair',
        'cork_board',
        'desktop',
        'towels',
        'bed_sheets'
    ];

    public function images()
    {
        return $this->hasMany(RoomInitialStateImage::class);
    }
}
