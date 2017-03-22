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
            $coun = "";

            //$ip = $_SERVER['REMOTE_ADDR'];
            $ip = "119.155.54.186"; //demo ip remove when deploy
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            $city = $details->city;
            Cache::put('city', $city, 60*24*7);

            if(Cache::has('country'))
            {
                $country = Cache::get('country');
            }
            else
            {
                

                $country = "Saudi Arabia";
                
                switch($coun)
                {
                    case "BH": {
                        $country = "Bahrain";
                        break;
                    }

                    case "KW": {
                        $country = "Kuwait";
                        break;
                    }

                    case "OM": {
                        $country = "Oman";
                        break;
                    }

                    case "QA": {
                        $country = "Qatar";
                        break;
                    }

                    case "SA": {
                        $country = "Saudi Arabia";
                        break;
                    }

                    case "AE": {
                        $country = "UAE";
                        break;
                    }
                }

                $coun = $details->country;
                Cache::put('country', $country, 60*24*7);                
            }
            //$navs = Category::where('active', 1)->where('homepage', 1)->orderBy('priority', 'ASC')->take(5)->get();
            
            $view->with(['country'=>$country]);
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
