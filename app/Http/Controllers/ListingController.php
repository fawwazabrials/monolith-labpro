<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Rules\BuyRule;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ListingController extends Controller
{
    use PaginationTrait;

    public function index()
    {
        // dd(env("SINGLE_SERVICE_API_URL") . "/barang/");
        $response = Http::get(env("SINGLE_SERVICE_API_URL") . "/barang");
        $barangDataJson = $response->json()["data"];
        $listings = $this->paginate($barangDataJson, 4);

        return view("listings.index", [
            "listings" => $listings
        ]);

        // Test no barang
        // return view("listings.index", [
        //     "listings" => []
        // ]);
    }

    public function show($id)
    {
        $response = Http::get(env("SINGLE_SERVICE_API_URL") . "/barang/{$id}");
        if ($response->status() === 400) {
            abort(404);
        }
        $listing = $response->json()["data"];

        return view("listings.show", [
            "listing" => $listing
        ]);
    }

    public function buy()
    {
        $request = request()->all();

        request()->validate([
            "quantity" => ["required", "numeric", "gt:0" , new BuyRule]
        ]);

        // dd(env("SINGLE_SERVICE_API_URL") . "/barang/" . $request["listing_id"]);
        // dd(env("MONOLITH_TOKEN"));
        
        $response = Http::withToken(env("MONOLITH_TOKEN"))
                ->put(env("SINGLE_SERVICE_API_URL") . "/barang/" . $request["listing_id"] , [
                    "nama" => $request["listing_nama"],
                    "harga" => (int)$request["listing_harga"],
                    "stok" => (int)$request["listing_stok"] - $request["quantity"],
                    "kode" => $request["listing_kode"],
                    "perusahaan_id" => $request["listing_perusahaan_id"],
                ]);
        $response = json_decode($response);
        if ($response->status === "error") {
            return back()->with(["danger", "Failed to buy item"]);
        }
        
        $transaction_data = [
            "item_name" => $response->data->nama,
            "amount" => (int)$request["quantity"],
            "price" => (int)$request["quantity"] * (int)$response->data->harga,
            "user_id" => auth()->user()->id,
        ];
        
        $transaction = Transaction::create($transaction_data);

        return redirect(route("home"))->with(["success", "Item successfuly bought"]);
    }
}
