<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceremony extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ceremony_id',
        'groom_name',
        'bride_name',
        'attendance_contact_limit_day',
        'wedding_date',
        'reception_time',
        'start_ceremony_time',
        'start_wedding_reception_time',
        'place_name',
        'address',
    ];
    protected $hidden = [
        
    ];
    protected $casts = [
        
    ];  
    
}
