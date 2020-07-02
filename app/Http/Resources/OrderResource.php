<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "total" => $this->total,
            "date" => $this->date->locale("es_CO")->isoFormat("LL"),
            "number" => str_pad($this->number, 8, "0", STR_PAD_LEFT),
            "products" => $this->whenLoaded("products", OrderProductResource::collection($this->products)),
        ];
    }
}
