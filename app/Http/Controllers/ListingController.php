<?php

namespace App\Http\Controllers;

use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ListingController extends Controller
{
    use PaginationTrait;

    public function index() {
        $response = Http::get(env("SINGLE_SERVICE_API_URL") . "barang");
        $barangDataJson = $response->json()["data"];
        $listings = $this->paginate($barangDataJson, 100);

        return view("listings.index", [
            "listings" => $listings
        ]);

        // Test no barang
        // return view("listings.index", [
        //     "listings" => []
        // ]);
    }
}
