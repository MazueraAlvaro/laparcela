<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStatus;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', "search"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $products = Product::paginate();
        return ProductResource::collection($products);
    }

    /**
     * @param string $term
     * @return AnonymousResourceCollection
     */
    public function search($term)
    {
        $products = Product::where("name", "like", "%$term%")->orWhere("sku",$term)->get();
        if ($products->count() <= 0)
            throw new NotFoundHttpException("Producto no encontrado");
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProductResource
     */
    public function store(Request $request)
    {
       $this->validateEntity($request);

        $product = Product::make($request->all());
        $product->unit()->associate($request->get("unit_id"));
        $product->status()->associate($request->get("status_id"));
        $product->save();
        $product->categories()->attach($request->get("categories"));
        $product->tags()->attach($request->get("tags"));

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $productId
     * @return ProductResource
     */
    public function show($productId)
    {
        $product = Product::whereId($productId)->with(['unit', 'tags', 'status'])->firstOrFail();
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(Request $request, Product $product)
    {
        $this->validateEntity($request, $product->id);
        $product->update($request->all());
        $product->unit()->associate($request->get("unit_id"));
        $product->status()->associate($request->get("status_id"));
        $product->save();
        $product->categories()->sync($request->get("categories"));
        $product->tags()->sync($request->get("tags"));

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['deleted' => true]);
    }

    private function validateEntity(Request $request, $productId = false)
    {
        $rules = [
            'sku' => [Rule::unique(Product::class, 'sku')->ignore($productId), "required", "min:8"],
            'name' => ['required', 'max:100'],
            'description' => ['required', 'min:10'],
            'regular_price' => ['numeric', 'required'],
            'discount_price' => ['sometimes', 'numeric'],
            'taxable' => ['required', 'boolean'],
            'unit_id' => ['exists:'.ProductStatus::class.',id'],
            'categories.*' => ['exists:'.Category::class.',id'],
            'tags.*' => ['exists:'.Tag::class.',id'],
            'status_id' => ['exists:'.ProductStatus::class.',id'],
            'files.*' => ['image']
        ];

        $request->validate($rules);
    }
}
