<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Repositories\ShoppingCartRepository;
use App\Rules\ProductQuantityRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(ShoppingCartRepository $shoppingCartRepository)
    {
        $shoppingCart = $this->route("shoppingCart");
        return $shoppingCartRepository->isMyShoppingCart($shoppingCart);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "quantity" => ["required", new ProductQuantityRule($this->route("product"))]
        ];
    }
}
