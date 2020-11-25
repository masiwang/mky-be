<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Wishlist extends JsonResource
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
            'id' => $this->product_id,
            'image' => $this->product->image,
            'slug' => $this->product->slug,
            'name' => $this->product->name,
            'price' => $this->product->price,
            'category' => $this->product->category->slug,
            'is_wishlist' => $this->id
        ];
    }
}
