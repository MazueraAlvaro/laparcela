<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "sku" => $this->sku,
            "name" => $this->name,
            "description" => $this->description,
            "regular_price" => $this->regular_price,
            "discount_price" => $this->discount_price,
            "taxable" => $this->taxable,
            "unit" => new UnitResource($this->whenLoaded('unit')),
            "categories" => CategoryResource::collection($this->whenLoaded('categories')),
            "status" => new ProductStatusResource($this->whenLoaded('status'))
        ];
    }
}
