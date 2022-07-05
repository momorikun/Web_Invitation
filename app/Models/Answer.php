<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'question_id',
        'upload_user_type',
        'answer_body',
        'upload_user_ceremony_id',
    ];
    protected $hidden = [
        
    ];
    protected $casts = [

    ];    
}
