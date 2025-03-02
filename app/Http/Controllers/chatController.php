<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Message;

class ChatController extends Controller
{
    public function getPeople($id)
    {
        $authId = $id;

        $messages = DB::select("
        SELECT message, user_seller_id, user_buyer_id, send_form
        FROM messages
        WHERE user_seller_id = ? OR user_buyer_id = ?
    ", [$authId, $authId]);

        $otherUserIds = collect($messages)->pluck('user_seller_id')->merge(collect($messages)->pluck('user_buyer_id'))->unique()->filter(function ($id) use ($authId) {
            return $id != $authId;
        });

        $users = DB::select("SELECT * FROM users WHERE id IN (" . implode(",", $otherUserIds->toArray()) . ")");

        return response()->json([
            'users' => $users,
            'message' => $messages
        ]);
    }


    public function getMessagesBuyer($sellerId, $buyerId)
    {
        try {
            $messages = DB::select("
                SELECT message, user_seller_id, user_buyer_id, send_form
                FROM messages
                WHERE (user_seller_id = ? AND user_buyer_id = ?)
                   OR (user_seller_id = ? AND user_buyer_id = ?)
                ORDER BY created_at ASC;
            ", [$sellerId, $buyerId, $buyerId, $sellerId]);

            return response()->json([
                'message_chat' => $messages,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching messages: ' . $e->getMessage());
        }
    }



    public function getMessages($sellerId, $userId)
    {
        try {
            $messages = Message::where(function ($query) use ($sellerId, $userId) {
                $query->where('user_seller_id', $sellerId)
                    ->where('user_buyer_id', $userId);
            })
                ->orWhere(function ($query) use ($sellerId, $userId) {
                    $query->where('user_seller_id', $userId)
                        ->where('user_buyer_id', $sellerId);
                })
                ->orderBy('created_at', 'asc')
                ->get();

            return view('massage.chatpage', compact('messages', 'sellerId', 'userId'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching messages: ' . $e->getMessage());
        }
    }


    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'user_seller_id' => 'required|integer',
            'user_buyer_id' => 'required|integer',
        ]);

        try {
            Message::create([
                'user_seller_id' => $request->user_seller_id,
                'user_buyer_id' => $request->user_buyer_id,
                'message' => $request->message,
                'send_form' => $request->user_seller_id,
            ]);

            return redirect()->back()->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }

}


