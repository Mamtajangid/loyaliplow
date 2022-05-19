<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use App\Models\Custom;

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

        Validator::extend('is_even_string',function($attribute, $value, $parameters, $validator){
            if(!empty($value) && (strlen($value) % 2) == 0){
                return false;
            }
                return true;
        });
        Validator::extend('is_less_then',function($attribute, $value, $parameters, $validator){
            if(!empty($value) && (strlen($value) >= 6) == 0){
                return false;
            }
                return true;
        });
        Validator::extend('double_condition', function ($attribute, $value, $parameters, $validator) {
          
            $data = $validator->getData();
            $min_value = $data['title1'];
            $max_value = $data['title2'];

            if(($min_value >= $max_value) == 0){
                        return false;
                    }
                        return true;
        });
    }
}
