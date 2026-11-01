<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extracurricular extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo_path',
        'image_alt',
        'schedule',
        'coach_staff_id',
    ];

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'coach_staff_id');
    }
}
