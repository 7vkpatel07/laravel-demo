<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\AdminTranslationController;
use Illuminate\Support\Facades\Redis;
class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Redis::del('translate');
        //
        /* Data Store in Redis Cache */
        if(!Redis::exists('translate')){
            app()->call('App\Http\Controllers\AdminTranslationController@languageDataRedis');
        }
        if(!Redis::exists('settingParams')){
            app()->call('App\Http\Controllers\AdminSettingsController@settingsDataRedis');
        }
        
    }
}
