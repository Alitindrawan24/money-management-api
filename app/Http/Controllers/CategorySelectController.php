<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategorySelectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = Category::owned()
        ->orderBy("name")
        ->owned()
        ->when($request->type, fn($query) => $query->where("type", $request->type))
        ->where("status", 1)
        ->get();

        return \response()->json([
            "status" => "success",
            "message" => "Get categories for select successfully",
            "data" => CategoryResource::collection($categories),
        ]);
    }
}
