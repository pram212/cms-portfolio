<?php 
namespace App\Extensions;

use Google\Client;
use Google\Service\Drive;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

class GoogleDriveStorage extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('custom', function ($app, $config) {
            $client = new Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $client->setAccessToken($client->fetchAccessTokenWithRefreshToken());

            $service = new Drive($client);

            $adapter = new GoogleDriveAdapter($service, $config['folderId'] ?? null);

            return new Filesystem($adapter);
        });
    }
}
