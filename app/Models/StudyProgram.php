<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyProgram extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'head_staff_id', 'image_path', 'image_alt'];

    public function headStaff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'head_staff_id');
    }
}
