<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingCart\AddProductCartRequest;
use App\Http\Requests\ShoppingCart\UpdateProductRequest;
use App\Http\Resources\ProductShoppingCartResource;
use App\Http\Resources\ShoppingCartResource;
use App\Models\Product;
use App\Repositories\ShoppingCartRepository;
use App\Models\ShoppingCart;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShoppingCartController extends Controller
{
    private $shoppingCartRepository;

    public function __construct(ShoppingCartRepository $shoppingCartRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    function cart()
    {
        $shoppingCart = $this->shoppingCartRepository->get();
        return new ShoppingCartResource($shoppingCart);
    }

    function index(ShoppingCart $shoppingCart)
    {
        $products = $shoppingCart->products;
        return ProductShoppingCartResource::collection($products);
    }

    public function store(AddProductCartRequest $request)
    {
        $sCart = $this->shoppingCartRepository->get();
        $cartProduct = $sCart->products()->find($request->get("product_id"));
        if($cartProduct){
            $sCart->products()->updateExistingPivot(
                $request->get("product_id"),
                [
                    "quantity" => $cartProduct->cartProduct->quantity + $request->get("quantity")
                ]
            );
        }
        else {
            $sCart->products()->attach(
                $request->get("product_id"),
                [
                    "quantity" => $request->get("quantity")
                ]
            );
        }
        return new ProductShoppingCartResource($sCart->products()->find($request->get("product_id")));
    }

    public function show(ShoppingCart $shoppingCart)
    {
        $shoppingCart = $this->shoppingCartRepository->get();
        return new ShoppingCartResource($shoppingCart);
    }

    public function update(UpdateProductRequest $request, ShoppingCart $shoppingCart, Product $product)
    {
        $cartProduct = $this->validateProductOnMyCart($shoppingCart, $product);
        $newQuantity = ((float) $request->get("quantity")) + $cartProduct->cartProduct->quantity;
        $shoppingCart->products()->updateExistingPivot($product->id, ["quantity" => $newQuantity]);
        return new ProductShoppingCartResource($shoppingCart->products()->find($product->id));
    }

    public function destroy(ShoppingCart $shoppingCart, Product $product)
    {
        $this->validateProductOnMyCart($shoppingCart, $product);
        $shoppingCart->products()->detach($product);
        return response()->json(["data" => true]);
    }

    private function validateProductOnMyCart(ShoppingCart $shoppingCart, Product $product)
    {
        $cartProduct = $shoppingCart->products->find($product->id);
        if(!$cartProduct)
            throw new NotFoundHttpException("Product with id $product->id not found in Shopping Cart products");
        return $cartProduct;
    }
}
