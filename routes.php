<?php

Route::post('/markdown/preview', function()
{
    return Markdown::convertToHtml(Request::get('content'));
});

/*
View::composer('jetcms.core::widgets.footer', function($view)
{
    $value = Cache::remember('widgets.footer', config('jetcms.core.cache_time.footer',null), function()
    {
        $context_page = App\Menu::where('name','footer')->first();
        if ($context_page) {
            return App\Menu::active()
                ->where('parent_id', $context_page->id)
                ->orderBy('lft')
                ->get();
        }else{
            return [];
        }
    });

    dump($value);

    $view->with('footer', $value);
});
*/