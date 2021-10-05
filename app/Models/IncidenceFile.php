<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidenceFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'incidence_id',
        'url',
        'mime_type'
    ];
}
