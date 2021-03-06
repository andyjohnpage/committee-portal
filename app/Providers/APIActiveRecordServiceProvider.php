<?php

namespace App\Providers;

use ActiveResource\Connection;
use ActiveResource\ConnectionManager;
use App\Packages\ControlDB\ActiveRecordAuthentication;
use App\Packages\ControlDB\ControlDBInterface;
use Illuminate\Support\ServiceProvider;

class APIActiveRecordServiceProvider extends ServiceProvider
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
        $this->createControlDBConnection();
    }

    private function createControlDBConnection()
    {

        $token = app('App\Packages\ControlDB\ControlDBInterface')->getAuthToken();

        $options = [
            Connection::OPTION_BASE_URI => config('control.base_uri').'/api/',
            Connection::OPTION_DEFAULT_HEADERS => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ];
        $connection = new Connection($options);
        ConnectionManager::add('control', $connection);
    }

}
