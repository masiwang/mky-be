<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminFundProductFrontPage extends JsonResource
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
            'name' => $this->name,
            'vendor' => $this->vendor->name,
            'roi' => $this->return_per_periode,
            'actual_roi' => $this->actual_return_per_periode,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at
        ];
    }
}
