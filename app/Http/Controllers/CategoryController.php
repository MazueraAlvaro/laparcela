<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CategoryResource
     */
    public function store(Request $request)
    {
        $this->validateEntity($request);
        $category = Category::create($request->all());
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category  $category
     * @return CategoryResource
     */
    public function update(Request $request, Category $category)
    {
        $this->validateEntity($request);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(["deleted" => true]);
    }

    public function products($categoryId)
    {
        if($categoryId === "0")
            $products = Product::with(["unit", "images"])->paginate(12);
        else
            $products = Category::findOrFail($categoryId)->products()->with(["unit", "images"])->paginate(12);
        return ProductResource::collection($products);
    }

    private function validateEntity(Request $request)
    {
        $request->validate([
            "name" => ["required", "max:100"],
            "description" => ["required"],
        ]);
    }
}
