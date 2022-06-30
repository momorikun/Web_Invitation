<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceremony extends Model
{
    use HasFactory;

    protected $fillable = [
        'ceremony_id',
        'place_name',
        'address',
        'date_and_time',
    ];
    protected $hidden = [
        'id',
    ];
    protected $casts = [
        
    ];  
    
}
