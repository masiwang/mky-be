<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Transaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = new Carbon($this->created_at);
        return [
            'id' => $this->id,
            'time' => date('d M Y H:m:s', strtotime($date)),
            'bank_type' => $this->bank_type,
            'bank_acc' => $this->bank_acc,
            'nominal' => $this->nominal,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status->name
        ];
    }
}
