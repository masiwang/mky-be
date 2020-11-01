<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FundCheckout extends JsonResource
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
            'product_image' => $this->product,
            'product_name' => $this->product->name,
            'product_price' => $this->product->price,
            'qty' => $this->qty,
        ];
    }
}
