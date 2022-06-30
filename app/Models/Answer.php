<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'is_bride',
        'answer_body',
        'upload_user_ceremony_id',
    ];
    protected $hidden = [
        'id',
    ];
    protected $casts = [

    ];    
}
