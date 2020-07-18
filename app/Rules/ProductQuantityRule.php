<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class ProductQuantityRule implements Rule
{
    private $product;

    /**
     * ProductQuantityRule constructor.
     * @param mixed $product
     */
    public function __construct($product)
    {
        if($product instanceof Product)
            $this->product = $product;
        else
            $this->product = Product::with("unit")->find($product);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!$this->product)
            return true;
        return ($value > 0 and ($value * 100) % ($this->product->unit->increment * 100) === 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La cantidad no corresponde a la unidad del producto.';
    }
}
