<?php

namespace App\Http\Controllers\Api;

use App\Services\ListingService;
use App\Http\Controllers\Controller;
use Exception;

class ListingController extends Controller
{
    public function __construct(protected ListingService $listingService) {
    }

    public function index() {
        try {
            $response = $this->listingService->index();
            $response = response()->json($response->json(), 200);
        } catch (Exception $e) {
            $response = response()->json([
                "status" => "error",
                "message" => "Single Service API not running"
            ], 500);
        }

        return $response;
    }

    public function show($id) {
        try {
            $response = $this->listingService->show($id);
            $response = response()->json($response->json(), 200);
        } catch (Exception $e) {
            $response = response()->json([
                "status" => "error",
                "message" => "Single Service API not running"
            ], 500);
        }

        return $response;
    }
}
