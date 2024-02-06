<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();

        return \response()->json([
            "status" => "success",
            "message" => "Get all categories successfully",
            "data" => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
            "name" => $request->name,
            "type" => $request->type,
            "status" => $request->status,
        ]);

        return \response()->json([
            "status" => "success",
            "message" => "Create category successfully",
            "data" => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return \response()->json([
            "status" => "success",
            "message" => "Get category successfully",
            "data" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            "name" => $request->name,
            "type" => $request->type,
            "status" => $request->status,
        ]);

        return \response()->json([
            "status" => "success",
            "message" => "Update category successfully",
            "data" => $category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return \response()->json([
            "status" => "success",
            "message" => "Delete category successfully",
            "data" => null,
        ]);
    }
}
