<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total = $this->total;
        return [
            "id" => $this->id,
            "products" => $this->whenLoaded("products", ProductShoppingCartResource::collection($this->products)),
            "total" => $this->total,
            "formatted_total" => "$".formatMoneyNumber($total),
        ];
    }
}
