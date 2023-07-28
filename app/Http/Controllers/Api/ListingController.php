<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\ListingService;
use App\Http\Controllers\Controller;

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
                "message" => "Check your fields again and check if the Single Service API is running!"
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
                "message" => "Check your fields again and check if the Single Service API is running!"
            ], 500);
        }

        return $response;
    }

    public function update($id) {
        try {
            $response = $this->listingService->update($id);
            $response = response()->json($response->json(), 200);
        } catch (Exception $e) {
            $response = response()->json([
                "status" => "error",
                "message" => "Check your fields again and check if the Single Service API is running!",
            ], 500);
        }

        return $response;        
    }
}
