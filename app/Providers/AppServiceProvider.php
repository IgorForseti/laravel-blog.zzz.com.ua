<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //'front.layouts.sidebar' - шаблон в viewsdd(Category::getPopularCategory());
        view()->composer('front.layouts.sidebar', function ($view) {
            //popular_post - название даваемое переменной доступная в sidebar
            $view->with('popular_posts', Post::getPopularPosts());
            //Вывод категории и количества постов по убыванию с помощью withCount
            $view->with('cats', Category::getPopularCategories());
            $view->with('menu', Category::get());
        });
        view()->composer('front.layouts.layout', function ($view) {
            //popular_post - название даваемое переменной доступная в sidebar
            $view->with('popular_posts', Post::getPopularPosts());
            //Вывод категории и количества постов по убыванию с помощью withCount
            $view->with('cats', Category::getPopularCategories());
            $view->with('last_posts', Post::getLastPosts());
        });
    }
}
