<?php

namespace App\Http\Services;

class TryService
{
    public $shortUrlService;
    public function __construct(ShortUrlInterfaceService $service)
    {
        $this->shortUrlService = $service;
    }
    public function callTry()
    {
        $service = app()->make('ShortUrlService');
        dd($service -> version);
    }
}