<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseStorageService
{
    protected $projectUrl;
    protected $apiKey;
    protected $storageBucket;

    public function __construct()
    {
        $this->projectUrl = env('SUPABASE_URL');
        $this->apiKey = env('SUPABASE_KEY');
        $this->storageBucket = env('SUPABASE_BUCKET', 'default');
    }

    public function upload($file, $prefix = "")
    {
        $fileName = $prefix . $file->hashName();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])
            ->attach('file', fopen($file, 'r'), $fileName)
            ->post("{$this->projectUrl}/storage/v1/object/{$this->storageBucket}/{$fileName}");

        if ($response->failed()) {
            return null;
        }

        return "{$this->projectUrl}/storage/v1/object/public/{$this->storageBucket}/{$fileName}";
    }
}
