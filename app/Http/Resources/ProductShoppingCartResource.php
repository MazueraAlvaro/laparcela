<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductShoppingCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total = $this->getTotalPrice($this->cartProduct->quantity);
        $fTotal = formatMoneyNumber($total);
        return [
            "id" => $this->id,
            "sku" => $this->sku,
            "name" => $this->name,
            "main_image" => $this->whenLoaded("images", $this->main_image),
            "description" => $this->description,
            "unit" => new UnitResource($this->whenLoaded('unit')),
            "price" => $this->actual_price,
            "quantity" => $this->cartProduct->quantity,
            "categories" => CategoryResource::collection($this->whenLoaded('categories')),
            "status" => new ProductStatusResource($this->whenLoaded('status')),
            "total" => $total,
            "formatted_total" => "$".$fTotal,
            "formatted_price" => "$".formatMoneyNumber($this->actual_price),
        ];
    }
}
