<?php

namespace App\Http\Resources\Transaction;

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
            'amount' => $this->amount,
            'reference' => $this->reference,
            'sender_name' => $this->sender ? $this->sender->name : 'Utilisateur supprimé',
            'receiver_name' => $this->receiver ? $this->receiver->name : 'Utilisateur supprimé',
            'receiver_phone' => $this->receiver ? $this->receiver->phone : 'Utilisateur supprimé',
            'description' => $this->description ? $this->description : 'Aucune description',
            'created_at' => $this->created_at->format('d-m-Y'),
        ];
    }
}
