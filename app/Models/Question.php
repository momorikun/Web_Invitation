<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'upload_user_email',
        'question_body',
        'upload_user_ceremony_id',
        'deleted_at',
    ];
    protected $hidden = [
        
    ];
    protected $casts = [
        
    ];    
}
