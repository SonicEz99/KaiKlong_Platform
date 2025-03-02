<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายการเเชทสนทนา</title>
    @vite(['resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Kanit', 'Prompt', sans-serif;
        background-color: #f5f7fa;
        margin: 0;
        padding: 0;
    }

    .container_chat {
        margin-top: 15px;
        display: flex;
        gap: 20px;
        height: 70vh;
    }

    .list {
        width: 30%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        overflow-y: auto;
        border: none;
    }

    .chat {
        margin-bottom: 10px;
        border: none;
        background-color: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        width: 100%;
        padding: 10px;
        display: flex;
        align-items: center;
        border-radius: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
        text-align: left;
    }

    .chat:hover {
        background-color: #f0f5ff;
        transform: translateY(-2px);
    }

    .chat img {
        border-radius: 50%;
        object-fit: cover;
        margin-right: 12px;
    }

    .massage {
        width: 70%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        display: flex;
        flex-direction: column;
        border: none;
    }

    #chat_mes {
        list-style: none;
        padding: 0;
        margin: 0;
        overflow-y: auto;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .li-chat {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 18px;
        margin: 5px 0;
        word-break: break-word;
        position: relative;
        color: white;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Sender message style */
    .li-chat[style*="text-align: right"] {
        background-color: rgb(255, 139, 61);
        align-self: flex-end;
        border-bottom-right-radius: 5px;
        margin-left: auto;
    }

    /* Receiver message style */
    .li-chat[style*="text-align: left"] {
        background-color: #e6e6e6;
        color: #333;
        align-self: flex-start;
        border-bottom-left-radius: 5px;
        margin-right: auto;
    }

    /* Add message input area */
    .message-input-container {
        display: flex;
        margin-top: 15px;
        border-top: 1px solid #eaeaea;
        padding-top: 15px;
    }

    .message-input {
        flex-grow: 1;
        border: 1px solid #ddd;
        border-radius: 24px;
        padding: 10px 15px;
        font-family: inherit;
        resize: none;
        outline: none;
    }

    .send-button {
        background-color: rgb(255, 139, 61);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-left: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .send-button:hover {
        background-color: rgb(255, 139, 61);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container_chat {
            flex-direction: column;
            height: auto;
        }

        .list,
        .massage {
            width: 100%;
            margin-bottom: 20px;
        }

        .li-chat {
            max-width: 85%;
        }
    }
</style>
@extends('layouts.page')
@section('content')
    <?php
    $user = Auth::user();
                                                                                    ?>


    <body>
        <div class="container">
            <div class="container_chat d-flex gap-2">
                <div class="list" id="list">

                </div>
                <div class="massage">
                    <ul id="chat_mes"></ul>
                    <div class="message-input-container">
                        <textarea class="message-input" placeholder="พิมพ์ข้อความ..."></textarea>
                        <button class="send-button" onclick="sendMessage()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const authId = <?php echo Auth::id(); ?>;
            let currentChatId = null;
            // console.log("auth : id ", authId);
            function chatTo(id_) {
                currentChatId = id_;
                console.log(id_);
                fetchMessages();
            }
            async function fetchMessages() {
                if (!currentChatId) return;
                try {
                    const response = await fetch(`/api/message/${authId}/${currentChatId}`);
                    const data = await response.json();
                    const chatMes = document.getElementById("chat_mes");
                    chatMes.innerHTML = "";

                    if (data.message_chat && data.message_chat.length > 0) {
                        data.message_chat.forEach(mes => {
                            const list_chat = document.createElement("li");
                            list_chat.classList.add("li-chat");
                            list_chat.textContent = mes.message;
                            // จัดตำแหน่งข้อความ ถ้าส่งจากผู้ใช้ที่ล็อกอินให้ชิดขวา
                            list_chat.style.textAlign = mes.send_form  === authId ? "right" : "left";
                            console.log(mes.send_form , authId);
                            chatMes.appendChild(list_chat);
                        });
                        // เลื่อนลงด้านล่างอัตโนมัติ
                        chatMes.scrollTop = chatMes.scrollHeight;
                    }
                } catch (error) {
                    console.error("Error fetching messages:", error);
                }
            }
            async function sendMessage() {
                const messageInput = document.querySelector(".message-input");
                const messageText = messageInput.value.trim();

                // ตรวจสอบว่ามีข้อความหรือไม่
                if (!messageText) return;

                // ตรวจสอบว่ามีการเลือกแชท (currentChatId) หรือไม่
                if (!currentChatId) {
                    console.error("ไม่มีการเลือกแชท");
                    return;
                }

                console.log(messageText, authId, currentChatId);


                try {
                    const chatMes = document.getElementById("chat_mes");
                    const response = await axios.post(
                        "/api/chat/send",
                        {
                            message: messageText,
                            user_seller_id: authId,      // ผู้ส่งคือผู้ใช้ที่ล็อกอิน
                            user_buyer_id: currentChatId // ผู้รับคือผู้ที่เลือกแชท
                        },
                        {
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content")
                            }
                        }
                    );

                 
                    fetchMessages();
                } catch (error) {
                    console.error("เกิดข้อผิดพลาดในการเชื่อมต่อ API: ", error);
                }
            }



            function fetchPeopleChat() {
                fetch(`/api/peoplechat/${authId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // ตรวจสอบข้อมูลที่ได้รับจาก API
                        const peopleList = data.users;
                        const peopleChatContainer = document.getElementById('list');

                        // ล้างข้อมูลเก่า
                        peopleChatContainer.innerHTML = '';

                        // ตรวจสอบว่า `peopleList` มีข้อมูลหรือไม่
                        if (peopleList && peopleList.length > 0) {
                            // แสดงปุ่มสำหรับแต่ละคน
                            peopleList.forEach(user => {
                                const userButton = document.createElement('button');
                                userButton.classList.add('chat', 'd-flex', 'gap-3');
                                userButton.setAttribute('onclick', `chatTo(${user.id})`);
                                userButton.innerHTML = `
                                                                                                        <img src="${user.user_pic}" alt="" width="50" height="50">
                                                                                                        ${user.user_name}
                                                                                                    `;

                                // เพิ่มปุ่มลงใน container
                                peopleChatContainer.appendChild(userButton);
                            });
                        } else {
                            peopleChatContainer.innerHTML = '<p>No users found.</p>';
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            // เรียกใช้ฟังก์ชันเพื่อดึงข้อมูล
            fetchPeopleChat();
        </script>
    </body>
@endsection



</html>