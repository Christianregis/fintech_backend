<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'amount' => $this->amount,
            'reference' => $this->reference,
            'sender_name' => $this->sender->name,
            'receiver_name' => $this->receiver->name,
            'receiver_phone' => $this->receiver->phone,
            'sender_phone' => $this->sender->phone,
            'description' => $this->description ? $this->description : 'Aucune description',
            'created_at' => $this->created_at->format('d-m-Y : H:i'),
        ];
    }
}
