<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .text {
        color: #9AA6B2
    }

    .lable {
        color: rgb(98, 100, 103);
        font-style: bold;
    }

    .color_web {
        color: rgb(255, 139, 61);
    }

    .btn_web_color {
        background-color: rgb(255, 139, 61);
        border: none;
        border-radius: 14px;
        padding: 10px;
        color: white;
    }

    .bg-from {
        background-color: white;
        padding: 50px;
        width: 55%;
        border-radius: 24px;
    }

    form {
        width: 100%;
    }

    .checkbox {
        accent-color: #F26B0F;
        border: 2 solid;
    }

    .text-goregister {
        text-align: center;
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 10px;
        text-decoration: none;
        color: rgb(98, 100, 103);

        span {
            color: rgb(65, 130, 228);
        }
    }

    @media (max-width: 1024px) {
        .bg-from {
            width: 70%;
            padding: 40px;
        }
    }

    @media (max-width: 768px) {
        .bg-from {
            width: 85%;
            padding: 30px;
        }

        .btn_web_color {
            padding: 8px;
        }
    }

    @media (max-width: 576px) {
        .container {
            align-items: flex-start;
            padding-top: 50px;
        }

        .bg-from {
            width: 90%;
            padding: 25px;
        }

        .btn_web_color {
            padding: 8px;
            font-size: 14px;
        }

        .text-goregister {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@extends('layouts.app')
@section('content')

<body style="background-color: #FFE6C9;">
    <div class="container">
        <div class="bg-from">
            <form>
                <h3 class="color_web text-center mb-3">Kaiklong</h3>
                <p class=" text text-center mb-3">สมัครสมาชิก</p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="lable form-label">ชื่อผู้ใช้งาน</label>
                    <input type="text" id="user_name" class="form-control" aria-describedby="emailHelp"
                        placeholder="กรอกชื่อผู้ใช้งานที่ต้องการสร้าง">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="lable form-label">อีเมล</label>
                    <input type="email" id="user_email" class="form-control" aria-describedby="emailHelp"
                        placeholder="example@kaiklong.com">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="lable form-label">รหัสผ่าน</label>
                    <input type="password" id="user_password" class="text form-control"
                        placeholder="ทำการสร้างรหัสผ่าน">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="lable form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" id="confirmPassword" class="text form-control"
                        placeholder="กรอรหัสผ่านเพื่อยืนยัน">
                </div>

                <button type="submit" class="btn_web_color w-100">สมัครสมาชิก</button>
                <a href="/" class="text-goregister">หากคุณเป็นสมาชิกขายคล่องอยู่เเล้ว <span>เข้าสู่ระบบ</span></a>


                <script>
                    document.querySelector('form').addEventListener('submit', function (e) {
                        e.preventDefault(); // ป้องกันการ submit ฟอร์ม
                        try {
                            const userName = document.getElementById('user_name').value;
                            const userEmail = document.getElementById('user_email').value;
                            const userPassword = document.getElementById('user_password').value;
                            const confirmPassword = document.getElementById('confirmPassword').value;

                            // ตรวจสอบรหัสผ่านตรงกันไหม
                            if (userPassword !== confirmPassword) {
                                alert("รหัสผ่านไม่ตรงกัน");
                                return;
                            }

                            console.log(
                                userName, userEmail, userPassword,
                            );
                            // ส่งข้อมูลไปยัง API
                            axios.post('/api/register', {
                                user_name: userName,
                                user_email: userEmail,
                                user_password: userPassword,
                                user_password_confirmation: confirmPassword
                            })
                                .then(response => {
                                    alert(response.data.message);
                                    window.location.href = '/';
                                })
                                .catch(error => {
                                    if (error.response) {
                                        const errors = error.response.data.errors;
                                        alert(errors ? Object.values(errors).join(' ') : 'เกิดข้อผิดพลาด');
                                    } else {
                                        alert('เกิดข้อผิดพลาดในการสมัครสมาชิก');
                                    }
                                });

                        } catch (err) {
                            console.log(err.message);

                        }
                    });
                </script>


            </form>
        </div>
    </div>
</body>
@endsection


</html>