<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     */
    private function bust(): void
    {
        // Jika hanya satu key:
        Cache::forget('nav_pages');

        // Jika kelak ada banyak key (per-locale/role), loop di sini
        // atau pakai "versioned key" / cache tags.
    }

    public function created(Page $page): void
    {
        $this->bust();
    }
    public function updated(Page $page): void
    {
        $this->bust();
    }
    public function deleted(Page $page): void
    {
        $this->bust();
    }
    public function restored(Page $page): void
    {
        $this->bust();
    }
    public function forceDeleted(Page $page): void
    {
        $this->bust();
    }
}
