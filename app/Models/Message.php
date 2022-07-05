<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'upload_user_name',
        'upload_user_email',
        'ceremony_id',
        'message_body',
        'deleted_at',
    ];
    protected $hidden = [
        
    ];
    protected $casts = [
        
    ];  
}
