<?php

namespace App\Providers;

use App\MainOffice;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use  App\Page;
use  App\Post;
use App\SocialMedia;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);

        View::composer('front.inc.footer',function($view){
            $main_office = MainOffice::first();
            $view->with('main_office',$main_office);
        });
        View::composer('front.inc.footer',function($view){
            $medias = SocialMedia::all();
            $view->with('medias',$medias);
        });
    }
}
