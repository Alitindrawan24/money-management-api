<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::owned()->latest()->paginate();

        return \response()->json([
            "status" => "success",
            "message" => "Get all categories successfully",
            "data" => CategoryResource::collection($categories)->response()->getData(true),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $category = Category::create([
            "user_id" => auth()->user()->id,
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
        $this->authorize('view', $category);

        return \response()->json([
            "status" => "success",
            "message" => "Get category successfully",
            "data" => new CategoryResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Category $category)
    {
        $this->authorize('update', $category);

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
        $this->authorize('delete', $category);

        $category->delete();

        return \response()->json([
            "status" => "success",
            "message" => "Delete category successfully",
            "data" => null,
        ]);
    }
}
