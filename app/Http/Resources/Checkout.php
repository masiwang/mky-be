<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Checkout extends JsonResource
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
            'image' => $this->product->image,
            'invoice' => $this->invoice,
            'product' => $this->product->name,
            'status' => $this->status->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'description' => $this->product->description,
            'category_slug' => $this->product->category->slug,
            'product_slug' => $this->product->slug,
        ];
    }
}
