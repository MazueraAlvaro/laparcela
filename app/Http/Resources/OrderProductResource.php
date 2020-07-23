<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            "price" => $this->price,
            "quantity" => $this->quantity,
            "subtotal" => $this->subtotal,
            "unit" => $this->resource->unit
        ];
    }
}
