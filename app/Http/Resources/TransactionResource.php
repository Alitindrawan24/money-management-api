<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "date" => $this->date,
            "amount" => $this->amount,
            "description" => $this->description,
            "category" => new CategoryResource($this->category),
            "tags" => TagResource::collection($this->tags)
        ];
    }
}
