<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.nav', function($view) {

            if(Cache::has('country'))
            {
                $country = Cache::get('country');
                $city = Cache::get('city');
            }
            else
            {
                $country = "Saudi Arabia";
                $city = "Riyadh";

                Cache::put('country', $country, 60*24*7);
                Cache::put('city', $city, 60*24*7);  
            }
            //$navs = Category::where('active', 1)->where('homepage', 1)->orderBy('priority', 'ASC')->take(5)->get();
            
            $view->with(['country'=>$country, 'city'=>$city]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
