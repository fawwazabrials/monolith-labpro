<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
 
class ListingService {
    public function index() {
        $response = Http::get(env("SINGLE_SERVICE_API_URL") . "/barang");
        return $response;
    }

    public function show($id) {
        $response = Http::get(env("SINGLE_SERVICE_API_URL") . "/barang/{$id}");
        return $response;
    }
}