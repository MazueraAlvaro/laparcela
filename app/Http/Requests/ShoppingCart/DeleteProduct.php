<?php

namespace App\Http\Requests\ShoppingCart;

use App\Repositories\ShoppingCartRepository;
use Illuminate\Foundation\Http\FormRequest;

class DeleteProduct extends FormRequest
{
    /**
     * @param ShoppingCartRepository $shoppingCartRepository
     * @return bool
     */
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
            //
        ];
    }
}
