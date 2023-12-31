<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Rules\BuyRule;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class ListingController extends Controller
{
    use PaginationTrait;

    public function index()
    {
        $query = "?";
        if (request()->query("q")) {
            $query = $query . "q=" . request()->query("q") . "&";
        }    

        $request = Request::create("api/listing" . $query, "GET");
        $response = Route::dispatch($request);

        if ($response->getData()->status === "error") {
            abort(500);
        }

        $barangDataJson = $response->getData()->data;
        if ($sortby = request()->query("sortby")) {
            $query = $query . "sortby=" . $sortby;
            if ($sortby == "nama") {
                $barangDataJson = collect($barangDataJson)->sortBy('nama')->reverse()->toArray();
            } else if ($sortby == "harga_d") {
                $barangDataJson = collect($barangDataJson)->sortBy('harga')->reverse()->toArray();
            } else if ($sortby == "harga_a") {
                $barangDataJson = collect($barangDataJson)->sortBy('harga')->toArray();
            } else if ($sortby == "stok") {
                $barangDataJson = collect($barangDataJson)->sortBy('stok')->reverse()->toArray();
            }
        }

        $listings = $this->paginate($barangDataJson, 8)->setPath('/'.$query);
        return view("listings.index", [
            "listings" => $listings
        ]);
    }

    public function show($id)
    {
        $request = Request::create("api/listing/$id", "GET");
        $response = Route::dispatch($request);

        if ($response->getData()->status === "error") {
            abort(500);
        }

        $listing = $response->getData()->data;

        return view("listings.show", [
            "listing" => $listing
        ]);
    }

    public function buy()
    {
        $data = request()->all();
        request()->validate([
            "quantity" => ["required", "numeric", "gt:0" , new BuyRule]
        ]);
        
        $request = Request::create("api/listing/".$data["listing_id"], "POST", [
            "nama" => $data["listing_nama"],
            "harga" => (int)$data["listing_harga"],
            "stok" => (int)$data["listing_stok"] - $data["quantity"],
            "kode" => $data["listing_kode"],
            "perusahaan_id" => $data["listing_perusahaan_id"],
        ]);
        $response = app()->handle($request);
        
        if ($response->getData()->status === "error") {
            return back()->with("danger", "Failed to buy item");
        }
        
        $request = Request::create("api/transaction", "POST", [
            "item_name" => $data["listing_nama"],
            "amount" => $data["quantity"],
            "price" => (int)$data["listing_harga"] * $data["quantity"],
            "user_id" => auth()->user()->id
        ]);
        $response = app()->handle($request);

        return redirect(route("home"))->with("success", "Item successfuly bought");
    }
}
