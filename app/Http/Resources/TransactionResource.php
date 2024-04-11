<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            "id" => $this->id,
            "date_formatted" => Carbon::parse($this->date)->format("d M Y"),
            "amount_formatted" => "Rp. ".\number_format($this->amount),
            "description" => $this->description,
            "category" => new CategoryResource($this->category),
            "tags" => TagResource::collection($this->tags),
            "date" => $this->date,
            "amount" => \intval($this->amount),
        ];
    }
}
