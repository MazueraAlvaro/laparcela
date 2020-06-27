<?php

namespace App\Http\Requests\ShoppingCart;

use App\Models\Product;
use App\Repositories\ShoppingCartRepository;
use App\Rules\ProductQuantityRule;
use Illuminate\Foundation\Http\FormRequest;

class AddProductCartRequest extends FormRequest
{
    public function authorize(ShoppingCartRepository $shoppingCartRepository)
    {
        $shoppingCartId = (int) $this->route("shoppingCart");
        return $shoppingCartRepository->isMyShoppingCart($shoppingCartId);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "product_id" => ["required", "exists:".Product::class.",id"],
            "quantity" => ["required", new ProductQuantityRule($this->get("product_id"))]
        ];
    }
}
