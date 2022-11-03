<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

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
        Paginator::useBootstrap();

        if (Schema::hasTable('categories')) {
            $categoriesHeader = Category::whereNull('parent_id')->activeCategory()->orderBy('order_by', 'asc')->take(8)->get();
            View::share('categoriesHeader', $categoriesHeader);
    
            $categoriesHeaderAll = Category::whereNull('parent_id')->activeCategory()->orderBy('order_by', 'asc')->get();
            View::share('categoriesHeaderAll', $categoriesHeaderAll);
    
            $categoriesFooter = Category::whereNull('parent_id')->activeCategory()->orderBy('order_by', 'asc')->get();
            View::share('categoriesFooter', $categoriesFooter);
        }
    }
}
