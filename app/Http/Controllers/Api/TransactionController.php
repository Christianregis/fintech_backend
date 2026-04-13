<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
        public function send(Request $request)
    {
        // Validation des données
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
            'reference' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $sender = Auth::user();
        $receiver = User::find($request->receiver_id);

        // Vérification du solde du sender
        if ($sender->balance < $request->amount) {
            return response()->json(['message' => 'Solde insuffisant'], 400);
        }

        // Création de la transaction
        $transaction = Transaction::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'amount' => $request->amount,
            'reference' => $request->reference,
            'description' => $request->description,
        ]);

        // Mise à jour des soldes
        $sender->balance -= $request->amount;
        $receiver->balance += $request->amount;

        $sender->save();
        $receiver->save();

        return response()->json(['message' => 'Transaction réussie', 'transaction' => $transaction], 201);
    }

    public function history()
    {
        $user = Auth::user();
        $transactions = Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['transactions' => $transactions], 200);
    }
}
