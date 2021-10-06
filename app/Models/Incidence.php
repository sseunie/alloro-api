<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'residence_id',
        'incidence_area_id',
        'subject',
        'message',
        'user_id'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function files()
    {
        return $this->hasMany(IncidenceFile::class);
    }

    public function incidence_area()
    {
        return $this->belongsTo(IncidenceArea::class);
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }
}
