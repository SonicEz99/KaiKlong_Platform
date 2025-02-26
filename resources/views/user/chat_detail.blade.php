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
    .list {
        padding: 24px;
        border: solid 1px black;
        width: 30%;
    }

    .massage {
        padding: 24px;
        border: solid 1px black;
        width: 65%;
    }

    .chat {
        margin-bottom: 14px;
        border: none;
        background-color: white;
        box-shadow: 1px 1px 2px 1px black;
        width: 100%;
        padding: 4px;
        display: flex;
        align-items: center;
    }
</style>
@extends('layouts.page')
@section('content')
    <?php
    $user = Auth::user();
    ?>


    <body>


        <div class="container">
            <h1>
                รายการเเชทสนทนา
            </h1>

            <div class="container_chat d-flex gap-2">
                <div class="list" id="list">

                </div>
                <div class="massage">
                    <ul id="chat_mes"></ul>
                </div>
            </div>
        </div>
        <script>
            const authId = <?php echo Auth::id(); ?>;
            console.log("auth : id ", authId);

            function chatTo(id_) {
                let chat_mes = document.getElementById('chat_mes');

                function fetchMessage() {
                    fetch(`/api/message/${authId}/${id_}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            const chatList = data.message_chat;
                            const chatChatContainer = document.getElementById('chat_mes');
                            chatChatContainer.innerHTML = '';

                            if (chatList && chatList.length > 0) {
                                chatList.forEach(mes => {
                                    const list_chat = document.createElement('li');
                                    list_chat.innerHTML = `${mes.message}`;
                                    chatChatContainer.appendChild(list_chat); // Append each message
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error fetching messages:", error);
                        });
                }

                fetchMessage(); // Call the function to fetch messages
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
