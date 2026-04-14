<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\TransactionRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionsHistoryResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function add(Request $request)
    {
        // Validation des données
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $user->balance += $request->amount;
        $user->save();

        return response()->json(['message' => 'Argent ajouté avec succès', 'balance' => $user->balance], 200);
    }

    public function send(TransactionRequest $request)
    {
        // Validation des données
        $request->validated();

        $sender = Auth::user();
        $receiver = User::where('phone', $request->receiver_phone)->first();

        if ($sender->id == $receiver->id) {
            return response()->json(['message' => 'Vous ne pourvez pas vous envoyer de l\'argent a vous meme.'], 400);
        }
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

        return response()->json(['message' => 'Transaction réussie', 'transaction' => TransactionResource::make($transaction)], 201);
    }

    public function history()
    {
        $user = Auth::user();
        $transactions = Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['transactions' => TransactionsHistoryResource::collection($transactions)], 200);
    }
}
