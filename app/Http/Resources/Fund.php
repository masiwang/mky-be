<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Fund extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'prospectus' => $this->prospectus,
            'minROI' => explode('-', $this->return_per_periode)[0],
            'maxROI' => explode('-', $this->return_per_periode)[1],
            'price' => $this->price,
            'stock' => $this->stock,
            'closed_at' => $this->closed_at,
            'ended_at' => $this->ended_at,
        ];
    }
}
