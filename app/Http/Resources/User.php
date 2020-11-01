<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\API\v1\TransactionController;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $transaction = new TransactionController;
        return [
            'name' => $this->name,
            'saldo' => $transaction->saldo()
        ];
    }
}
