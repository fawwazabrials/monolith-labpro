<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\Route;

class TransactionController extends Controller
{
    use PaginationTrait;

    public function index() {
        $request = Request::create("api/transaction", "GET");
        $response = Route::dispatch($request);

        $transactions = $this->paginate($response->getData()->data, 4)->setPath('/history');
        return view("transactions.index", [
            "transactions" => $transactions,
            "index" => 1
        ]);
    }
}
