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
        return [
            "id" => $this->id,
            "sku" => $this->sku,
            "name" => $this->name,
            "description" => $this->description,
            "unit" => new UnitResource($this->whenLoaded('unit')),
            "price" => $this->actual_price,
            "quantity" => $this->cartProduct->quantity,
            "categories" => CategoryResource::collection($this->whenLoaded('categories')),
            "status" => new ProductStatusResource($this->whenLoaded('status')),
            "total" => $this->getTotalPrice($this->cartProduct->quantity)
        ];
    }
}
