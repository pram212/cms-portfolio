<?php 
namespace App\Providers;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\ServiceProvider;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Drive::class, function ($app) {
            $client = new Client();
            
            // Set kredensial dari .env
            $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
            $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
            $client->setAccessToken(env('GOOGLE_DRIVE_ACCESS_TOKEN'));
            // dd($client);

            return new Drive($client);
        });
    }

    public function boot()
    {
        //
    }
}
