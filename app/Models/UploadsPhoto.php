<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadsPhoto extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'upload_user_email',
        'upload_user_ceremony_id',
        'photo_path',
        'is_seating_chart',
    ];
    protected $hidden = [
        'id',
    ];
    protected $casts = [

    ];
}
