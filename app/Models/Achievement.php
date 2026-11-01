<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'level',
        'type',
        'image_path',
        'image_alt',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
