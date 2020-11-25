<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketProduct extends JsonResource
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
            'id' => $this->id,
            'image' => $this->image,
            'slug' => $this->slug,
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category->slug,
            'is_wishlist' => $this->product_id
        ];
    }
}
