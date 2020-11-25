<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Portofolio extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $started = new Carbon($this->product->started_at);
        $ended = new Carbon($this->product->ended_at);
        return [
            'image' => $this->product->image,
            'invoice' => $this->invoice,
            'vendor' => $this->product->vendor->name,
            'product' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'return' => $this->product->return_per_periode,
            'periode' => $ended->diffInDays($started),
            'actual_return' => $this->product->actual_return_per_periode,
            'prospectus' => $this->product->risk_analysis,
            'description' => $this->product->description,
            'category_slug' => $this->product->category->slug,
            'product_slug' => $this->product->slug,
            'report' => $this->weekly_report
        ];
    }
}
