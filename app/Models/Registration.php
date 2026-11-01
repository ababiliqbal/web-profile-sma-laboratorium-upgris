<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'registration_number',
        'status',
        'birth_place',
        'birth_date',
        'gender',
        'previous_school',
        'parent_name',
        'parent_phone',
        'address',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
