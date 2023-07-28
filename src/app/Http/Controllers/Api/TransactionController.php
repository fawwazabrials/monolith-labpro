<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index() {
        $transactions = auth()->user()->transactions()->get();
        return response()->json([
            "status" => "success",
            "message" => "User transactions fetched successfuly",
            "data" => $transactions
        ], 200); 
    }

    public function store() {
        $request = request()->all();
        // dd($request);

        $validator = Validator::make($request, [
            "item_name" => "required",
            "amount" => "required|numeric",
            "price" => "required|numeric",
            "user_id" => "required|exists:users,id" 
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->messages(),
            ], 400);
        }

        if ($request["user_id"] != auth()->user()->id) {
            return response()->json([
                "status" => "error",
                "message" => "Forbidden access",
            ], 403);
        }

        $transactions = Transaction::create($request);

        return response()->json([
            "status" => "success",
            "message" => "User transactions fetched successfuly",
            "data" => $transactions
        ], 200); 
    }
}