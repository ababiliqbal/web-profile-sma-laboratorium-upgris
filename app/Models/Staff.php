<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'identity_number',
        'name',
        'position',
        'type',
        'employment_status',
        'biography',
        'image_path',
        'image_alt',
        'email',
        'display_order',
    ];

    protected static function booted()
    {
        // Saat data Staff baru disimpan, diubah, atau dihapus
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_statistics');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_statistics');
        });
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'staff_subject');
    }
}
