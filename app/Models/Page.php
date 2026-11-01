<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'content',
        'image_path',
        'image_alt',
        'meta_title',
        'meta_description',
    ];

    protected static function boot()
    {
        parent::boot();

        // 2. Daftarkan event 'deleting'
        static::deleting(function ($page) {
            // Hapus semua dokumen terkait saat agenda dihapus
            foreach ($page->documents as $document) {
                Storage::disk('public')->delete($document->file_path);
                $document->delete();
            }
        });
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
