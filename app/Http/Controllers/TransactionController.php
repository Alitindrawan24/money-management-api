<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Category;
use DivisionByZeroError;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionTag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::get();

        return \response()->json([
            "status" => "success",
            "message" => "Get transactions successfully",
            "data" => $transactions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $transaction = $category->transactions()->create([
            "date" => $request->date,
            "amount" => $request->amount,
            "description" => $request->description,
        ]);

        if (count($request->tag_ids) > 0) {
            $transaction->tags()->attach($request->tag_ids);
        }

        return \response()->json([
            "status" => "success",
            "message" => "Store transactions successfully",
            "data" => $transaction
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return \response()->json([
            "status" => "success",
            "message" => "Show transactions successfully",
            "data" => $transaction->load("tags")
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update([
            "category_id" => $request->category_id,
            "date" => $request->date,
            "amount" => $request->amount,
            "description" => $request->description,
        ]);

        $transaction->tags()->sync($request->tag_ids);

        return \response()->json([
            "status" => "success",
            "message" => "Update transactions successfully",
            "data" => $transaction
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->tags()->detach();

        $transaction->delete();
        return \response()->json([
            "status" => "success",
            "message" => "Delete transactions successfully",
            "data" => null
        ]);
    }
}
