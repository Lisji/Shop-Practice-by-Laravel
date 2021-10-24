<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShortUrlService implements ShortUrlInterfaceService
{
    public $client;
    public $version = 2.5;
    public function __construct()
    {
        $this->client = new Client();
        dump($this->version);
    }

    public function makeShortUrl($url)
    {
        
        try {
            $token = env('URL_TOKEN');
            $data = [
                'url' => $url,
            ];
            Log::channel('url_shorten') -> info('postData', ['data' => $data]);
            $response = $this -> client -> request(
                'POST',
                "https://api.pics.ee/v1/links/?access_token=$token",
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode($data)
                ]
            );
            $contents = $response -> getBody()->getContents();
            Log::channel('url_shorten') -> info('responseData', ['data' => $contents]);
            $contents = json_decode($contents);
        } catch (\Throwable $th) {
            report($th);
            return $url;    
        }
        
        return $contents -> data -> picseeUrl;
        
    }
}