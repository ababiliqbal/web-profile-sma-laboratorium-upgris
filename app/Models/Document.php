<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'mime_type',
        'file_size',
        'documentable_id',
        'documentable_type',
        'downloads',
    ];

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
