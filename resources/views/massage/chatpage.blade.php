<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แชทสนทนากับผู้ขาย</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .profile_chat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #FF6F00;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chat-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;
            max-height: 400px;
            overflow-y: auto;
            border-radius: 8px;
            background: #fff;
        }

        .chat-message {
            padding: 10px;
            border-radius: 10px;
            max-width: 75%;
            word-wrap: break-word;
            font-size: 14px;
            line-height: 1.4;
        }

        .seller-message {
            background-color: #FF3D00;
            color: white;
            align-self: flex-start;
            text-align: left;
        }

        .buyer-message {
            background-color: #4CAF50;
            color: white;
            align-self: flex-end;
            text-align: right;
        }

        .chat-input {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            padding: 10px;
            border-top: 1px solid #ddd;
            background: #fff;
            border-radius: 8px;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .chat-input button {
            background: #FF6F00;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .chat-input button:hover {
            background: #E65100;
        }
    </style>
</head>

@extends('layouts.page')

@section('content')

    <body>
        <div class="container">
            <h1>แชทกับผู้ขาย</h1>

            <div class="profile_chat">
                <p>ผู้ขาย</p>
                {{ Auth::user()->user_name }}
            </div>

            <div class="chat-box">
                @if($messages->isEmpty())
                    <p style="text-align: center; color: #777;">ไม่มีข้อความ</p>
                @else
                    @foreach($messages as $message)
                        @if($message->send_form == $sellerId)
                            <p class="chat-message seller-message">{{ $message->message }}</p>
                        @else
                            <p class="chat-message buyer-message">{{ $message->message }}</p>
                        @endif
                    @endforeach
                @endif
            </div>

            <form action="{{ route('chat.send') }}" method="POST" class="chat-input">
                @csrf
                <input type="hidden" name="user_seller_id" value="{{ $sellerId }}">
                <input type="hidden" name="user_buyer_id" value="{{ $userId }}">
                <input type="text" name="message" placeholder="พิมพ์ข้อความ..." required>
                <button type="submit">ส่ง</button>
            </form>
        </div>
    </body>

@endsection

</html>