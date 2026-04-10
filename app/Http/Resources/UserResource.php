<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'balance' => $this->balance ? $this->balance : 0,
            "avatar_url" => $this->avatar_url ? $this->avatar_url : "",
            'phone' => $this->phone,
            'created_at'=> $this->created_at->format('d-m-Y')
        ];
    }
}
