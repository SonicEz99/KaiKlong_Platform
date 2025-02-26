<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function getMessages($sellerId, $userId)
    {
        try {
            // Fetch messages for the specific conversation, sorted by created_at
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
                'send_form' => auth()->id(),
            ]);

            return redirect()->back()->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }

}


