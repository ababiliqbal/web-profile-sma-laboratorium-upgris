<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniTestimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'graduation_year',
        'testimonial',
        'image_path',
        'image_alt',
        'current_occupation',
    ];
}
