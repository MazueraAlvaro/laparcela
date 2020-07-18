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
            "id" => $this->id,
            "sku" => $this->sku,
            "name" => $this->name,
            "description" => $this->description,
            "regular_price" => $this->regular_price,
            "regular_price_formatted" => "$".number_format($this->regular_price, 2, ",", "."),
            "discount_price_formatted" => "$".number_format($this->discount_price, 2, ",", "."),
            "discount_price" => $this->discount_price,
            "main_image" => $this->whenLoaded("images", $this->main_image),
            "taxable" => $this->taxable,
            "unit" => new UnitResource($this->whenLoaded('unit')),
            "categories" => CategoryResource::collection($this->whenLoaded('categories')),
            "status" => new ProductStatusResource($this->whenLoaded('status'))
        ];
    }
}
