<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * Get all users the authenticated user has chatted with.
     */
    public function getPeople($id)
    {
        $messages = Message::where('user_seller_id', $id)
            ->orWhere('user_buyer_id', $id)
            ->select('user_seller_id', 'user_buyer_id')
            ->get();

        // Get unique user IDs except the authenticated user
        $otherUserIds = collect($messages)->pluck('user_seller_id')
            ->merge($messages->pluck('user_buyer_id'))
            ->unique()
            ->reject(fn($userId) => $userId == $id);

        // Fetch users in a single query
        $users = User::whereIn('id', $otherUserIds)->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    /**
     * Get messages between two users (either buyer or seller).
     */
    public function getMessagesBuyer($sellerId, $buyerId)
    {
        $messages = Message::where(function ($query) use ($sellerId, $buyerId) {
            $query->where('user_seller_id', $sellerId)
                ->where('user_buyer_id', $buyerId);
        })
            ->orWhere(function ($query) use ($sellerId, $buyerId) {
                $query->where('user_seller_id', $buyerId)
                    ->where('user_buyer_id', $sellerId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'message_chat' => $messages,
        ]);
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

            // Return only a partial Blade file with the messages
            return view('massage.partials.chat-messages', compact('messages', 'sellerId', 'userId'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching messages: ' . $e->getMessage()], 500);
        }
    }

    public function showChatPage($sellerId, $userId)
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
        return back()->with('error', 'Error loading chat page: ' . $e->getMessage());
    }
}

    /**
     * Send a message from one user to another.
     */
    public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'user_seller_id' => 'required|integer',
        'user_buyer_id' => 'required|integer',
    ]);

    try {
        $message = Message::create([
            'user_seller_id' => $request->user_seller_id,
            'user_buyer_id' => $request->user_buyer_id,
            'message' => $request->message,
            'send_form' => $request->user_seller_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200); // Explicitly return status 200
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
    }
}

}
