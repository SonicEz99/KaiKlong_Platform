<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แชทสนทนากับผู้ขาย</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .profile_chat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            font-weight: bold;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 4px;
        }

        .chat-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 15px;
            max-height: 400px;
            overflow-y: auto;
            background: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);

        }

        .chat-message {
            padding: 12px;
            border-radius: 12px;
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
            border-top-left-radius: 2px;
        }

        .buyer-message {
            background-color: #4CAF50;
            color: white;
            align-self: flex-end;
            text-align: right;
            border-top-right-radius: 2px;
        }

        .chat-input {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            background: #fff;
            border-radius: 8px;
        }

        .chat-input input {
            flex: 1;
            padding: 20px;
            border-radius: 5px;
            font-size: 14px;
            border: none;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chat-input button {
            background: #FF6F00;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .chat-input button:hover {
            background: #E65100;
        }

        /* Mobile Responsive */
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }

            .chat-box {
                max-height: 300px;
            }

            .chat-input {
                flex-direction: column;
            }

            .chat-input input {
                width: 100%;
            }
        }
    </style>
</head>



@extends('layouts.page')

@section('content')
    <body style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif;">
        <div class="container mt-2">
            <div class="profile_chat">
                <p>ผู้ขาย</p>
                {{ Auth::user()->user_name }}
            </div>

            <div class="chat-box">
                @include('massage.partials.chat-messages')  {{-- Include only the chat messages --}}
            </div>

            <form action="{{ route('chat.send') }}" method="POST" class="chat-input">
                @csrf
                <input type="hidden" name="user_seller_id" value="{{ $userId }}">
                <input type="hidden" name="user_buyer_id" value="{{ $sellerId }}">
                <input type="text" name="message" placeholder="พิมพ์ข้อความ..." required>
                <button type="submit">ส่ง</button>
            </form>
        </div>
    </body>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chatForm = document.querySelector(".chat-input");
            const messageInput = document.querySelector("input[name='message']");
            const chatBox = document.querySelector(".chat-box");

            chatForm.addEventListener("submit", async function (event) {
                event.preventDefault(); // Prevent page reload

                let formData = new FormData(chatForm);

                try {
                    const response = await fetch("{{ route('chat.send') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector("input[name='_token']").value
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        messageInput.value = ""; // Clear input after sending
                        fetchMessages(); // Refresh messages dynamically
                    } else {
                        console.error("Message send error:", data.error);
                    }
                } catch (error) {
                    console.error("Error sending message:", error);
                }
            });

            async function fetchMessages() {
                try {
                    const response = await fetch(`/product-detail/chatsale/messages/{{ $sellerId }}/{{ $userId }}`);
                    const data = await response.text();
                    chatBox.innerHTML = data;
                } catch (error) {
                    console.error("Error fetching messages:", error);
                }
            }

            setInterval(fetchMessages, 3000); // Auto-refresh messages every 3 seconds
        });
    </script>

@endsection
</html>
