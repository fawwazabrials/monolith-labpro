<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        // $user = auth()->user();
        // dd($user->transactions()->paginate(6));

        return view("transactions.index", [
            "transactions" => auth()->user()->transactions()->paginate(10),
            "index" => 1
        ]);
    }
}
