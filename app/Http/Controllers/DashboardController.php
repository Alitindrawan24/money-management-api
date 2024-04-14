<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $transactions = Transaction::with("category")
        ->owned()
        ->get();

        $totalIncome = $transactions->filter(fn($query) => $query->category->type == "in")->sum("amount");
        $totalSpending = $transactions->filter(fn($query) => $query->category->type == "out")->sum("amount");

        return [
            "status" => "success",
            "message" => "Data dashboard berhasil ditampilkan",
            "data" => [
                "total_income" => "Rp. ".\number_format($totalIncome),
                "total_spending" => "Rp. ".\number_format($totalSpending),
                "total_net_profit" => "Rp. ".\number_format($totalIncome - $totalSpending),
                "total_transaction" => $transactions->count(),
            ]
        ];
    }
}
