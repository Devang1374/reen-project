<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class heroBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'caption',
        'btn-text',
        'btn-url',
        'file-path'
    ];
}
