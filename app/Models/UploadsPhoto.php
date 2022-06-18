<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadsPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_user_id',
        'photo_path',
    ];
}
