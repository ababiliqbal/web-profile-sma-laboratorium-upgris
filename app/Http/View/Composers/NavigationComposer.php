<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class NavigationComposer
{
    public function compose(View $view)
    {
        $navPages = Cache::remember('nav_pages', now()->addHour(), function () {
            return Page::where('status', 'published')->get();
        });

        $view->with('navPages', $navPages);
    }
}
