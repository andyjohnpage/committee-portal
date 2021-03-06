<?php

namespace App\Providers;

use App\Packages\ControlDB\ControlDB;
use App\Packages\ControlDB\ControlDBInterface;
use App\Packages\UnionCloud\UnionCloud;
use App\Packages\UnionCloud\UnionCloudInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ControlDBInterface::class, ControlDB::class);
        $this->app->bind(UnionCloudInterface::class, UnionCloud::class);

        Gate::before(function($user, $ability) {
            Log::info('Called before gate');
            return false;
        });
        Gate::define('test-edit', function($user) {
            Log::info('Called original gate, return false');
            return false;
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
