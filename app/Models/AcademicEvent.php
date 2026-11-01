<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class AcademicEvent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'category'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        // 2. Daftarkan event 'deleting'
        static::deleting(function ($academicEvent) {
            // Hapus semua dokumen terkait saat agenda dihapus
            foreach ($academicEvent->documents as $document) {
                Storage::disk('public')->delete($document->file_path);
                $document->delete();
            }
        });
    }

    public function documents(): MorphMany // 2. Definisikan relasi
    {
        // 'documentable' adalah nama yang kita gunakan di migration (documentable_id & documentable_type)
        return $this->morphMany(Document::class, 'documentable');
    }
}
