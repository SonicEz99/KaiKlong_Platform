<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์</title>
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<style>
    .header-title {
        color: orange;
    }

    .profile-setting {
        background-color: #E6E6E6;
        padding: 54px 54px 54px 54px;
        display: flex;
        gap: 5%;
        justify-content: start;
        align-items: center;

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 100%;
        }

        .detail-profile {
            color: grey;
        }
    }

    .management-data-profile {

        hr {
            margin-left: 15px;
        }

        margin-top: 24px;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 5%;
        padding-bottom:60px;

        .text-flind-setting {
            display: flex;
            flex-direction: column;
            gap: 24px;
            border-left: 1px solid #E6E6E6;
        }

        .input-data {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-data label {
            width: 120px;
            font-weight: bold;
            margin-right: 15px;
            margin-left: 15px;
        }

        .input-data input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }


        ul {
            list-style: none;
            text-align: center;
            font-size: 18px;
            padding: 0;
        }

        ul li {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        ul li.active {
            background-color: orange;
            color: white;
        }

        .btn {
            button {
                padding: 5px;
                border: none;
                background-color: orange;
                border-radius: 4px;
                width: 300px;
                height: 40px;
                color: white;
            }
        }

        .required {
            color: red;
            font-weight: bold;
            margin-left: 5px;
        }

        .account-form {
            width: 100%;
        }

    }
</style>

<?php
$user = auth()->user();
?>
@extends('layouts.page')
@section('content')

    <body style="font-family: 'Prompt', sans-serif;">
        <div class="container" style="margin-top: 10px;">
            <h1 class="header-title">ข้อมูลส่วนตัว</h1>
        </div>
        <hr>

        <div class="container">
            <div class="profile-setting">
                <img class="profile-pic"
                    src="{{ $user->user_pic ? $user->user_pic : 'https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg' }}"
                    alt="">

                <div class="detail-profile">
                    <h3>ชื่อผู้ใช้ : {{ $user->user_name }}</h3>
                    <h3>อีเมล : {{ $user->user_email }}</h3>
                </div>
            </div>

            <div class="management-data-profile">
                <div class="menu-setting">
                    <ul id="menu-list">
                        <li class="active" onclick="selectMenu(this)" data-target="profile">ข้อมูลส่วนตัว</li>
                        <?php $user = Auth::user(); ?>

                        <?php if ($user->google_id == null) { ?>
                        <li onclick="selectMenu(this)" data-target="account">จัดการบัญชี</li>
                        <?php } ?>
                    </ul>
                    <hr>
                </div>

                <!-- ข้อมูลส่วนตัว -->
                <?php $user = Auth::user(); ?>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('updateUserForm');

                        if (form) {
                            form.action = "/api/updateUser/{{ $user->id }}"; // Set action URL

                            form.addEventListener('submit', function(event) {
                                event.preventDefault(); // Prevent default form submission

                                const formData = new FormData(form);

                                fetch(form.action, {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                                        }
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            return response.json(); // Convert response to JSON
                                        }
                                        throw new Error('Failed to update');
                                    })
                                    .then(data => {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'บันทึกสำเร็จ!',
                                            text: 'ข้อมูลของคุณถูกอัปเดตเรียบร้อยแล้ว',
                                            confirmButtonText: 'ตกลง'
                                        }).then(() => {
                                            location.reload(); // Refresh the page
                                        });
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'เกิดข้อผิดพลาด',
                                            text: 'ไม่สามารถอัปเดตข้อมูลได้ กรุณาลองอีกครั้ง',
                                            confirmButtonText: 'ตกลง'
                                        });
                                        console.error(error);
                                    });
                            });
                        }
                    });
                </script>

                <div class="text-flind-setting" id="profile-section">
                    <form id="updateUserForm" method="POST" class="needs-validation" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="input-data">
                            <label for="">ชื่อผู้ใช้</label>
                            <input type="text" name="user_name" value="{{ $user->user_name }}">
                        </div>
                        <div class="input-data">
                            <label for="">ชื่อ <span class="required">*</span></label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}"
                                placeholder="ยังไม่ได้ตั้งค่าชื่อ">
                        </div>
                        <div class="input-data">
                            <label for="">นามสกุล <span class="required">*</span></label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}"
                                placeholder="ยังไม่ได้ตั้งค่านามสกุล">
                        </div>
                        <hr>
                        <div class="input-data">
                            <label for="">เบอร์โทร <span class="required">*</span></label>
                            <input type="text" name="tel" value="{{ $user->tel }}" placeholder="+ เบอร์โทรศัพท์">
                        </div>
                        <hr>
                        <div class="btn">
                            <button type="submit">บันทึก</button>
                        </div>
                    </form>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('updatePasswordForm');

                        if (form) {
                            form.addEventListener('submit', function(event) {
                                event.preventDefault(); // Prevent default form submission

                                const formData = new FormData(form);

                                fetch("/api/resetPassword", {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                                text: 'รหัสผ่านของคุณถูกอัปเดตเรียบร้อยแล้ว',
                                                confirmButtonText: 'ตกลง'
                                            }).then(() => {
                                                location.reload(); // Reload the page
                                            });
                                        } else {
                                            throw new Error(data.error || 'ไม่สามารถเปลี่ยนรหัสผ่านได้');
                                        }
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'เกิดข้อผิดพลาด',
                                            text: error.message || 'โปรดลองอีกครั้ง',
                                            confirmButtonText: 'ตกลง'
                                        });
                                    });
                            });
                        }
                    });
                </script>

                <!-- ฟอร์มจัดการบัญชี (เริ่มต้นซ่อน) -->
                <div class="text-flind-setting" id="account-section">
                    <div class="account-form" id="account-form">
                        <form id="updatePasswordForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="input-data">
                                <label>รหัสผ่านเดิม</label>
                                <input type="password" name="oldPassword" placeholder="********" required>
                            </div>
                            <div class="input-data">
                                <label>เปลี่ยนรหัสผ่าน</label>
                                <input type="password" name="password" placeholder="********" required>
                            </div>
                            <div class="input-data">
                                <label>ยืนยันรหัสผ่าน</label>
                                <input type="password" name="password_confirmation" placeholder="********" required>
                            </div>
                            <hr>
                            <div class="btn">
                                <button type="submit">เปลี่ยนรหัสผ่าน</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </body>

    <script>
        function selectMenu(selectedItem) {
            // ลบ class 'active' ออกจากทุก <li>
            document.querySelectorAll("#menu-list li").forEach(li => {
                li.classList.remove("active");
            });

            // เพิ่ม class 'active' ให้กับ li ที่ถูกเลือก
            selectedItem.classList.add("active");

            // ดึงค่าจาก data-target
            let selectedTarget = selectedItem.dataset.target;
            console.log("เลือกเมนู:", selectedTarget); // Debug ดูค่าใน Console

            // ตรวจสอบการแสดงผล
            if (selectedTarget === "account") {
                document.getElementById("account-section").style.display = "block"; // แสดงฟอร์มจัดการบัญชี
                document.getElementById("profile-section").style.display = "none"; // ซ่อนฟอร์มข้อมูลส่วนตัว
            } else {
                document.getElementById("account-section").style.display = "none"; // ซ่อนฟอร์มจัดการบัญชี
                document.getElementById("profile-section").style.display = "block"; // แสดงฟอร์มข้อมูลส่วนตัว
            }
        }

        // ตรวจสอบการแสดงผลเมื่อโหลดเพจ
        document.addEventListener("DOMContentLoaded", function() {
            let activeMenu = document.querySelector("#menu-list li.active");
            if (activeMenu) {
                selectMenu(activeMenu);
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let inputs = document.querySelectorAll(".input-data input");

            function checkInput() {
                inputs.forEach(input => {
                    let label = input.previousElementSibling.querySelector(".required");

                    if (input.value.trim() === "") {
                        label.style.display = "inline"; // แสดง * เป็นสีแดง
                    } else {
                        label.style.display = "none"; // ซ่อน * เมื่อกรอกข้อมูลแล้ว
                    }
                });
            }

            // เรียกใช้เมื่อตรวจสอบค่าเริ่มต้น
            checkInput();

            // ฟังชันตรวจสอบเมื่อผู้ใช้กรอกข้อมูล
            inputs.forEach(input => {
                input.addEventListener("input", checkInput);
            });
        });
    </script>
@endsection

</html>
