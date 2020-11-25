<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $timestamp = new Carbon($this->created_at);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'timestamp' => $timestamp->diffForHumans()
        ];
    }
}
