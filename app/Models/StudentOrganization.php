<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentOrganization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'logo_path', 'image_alt', 'supervisor_staff_id'];

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'supervisor_staff_id');
    }
}
