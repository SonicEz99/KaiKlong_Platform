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
                <p class=" text text-center mb-3">เข้าสู่ระบบ</p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="lable form-label">ชื่อผู้ใช้งาน / อีเมล</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="กรอกชื่อผู้ใช้งาน / อีเมล">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="lable form-label">รหัสผ่าน</label>
                    <input type="password" class="text form-control" id="exampleInputPassword1"
                        placeholder="กรอกรหัสผ่าน">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="checkbox" id="exampleCheck1">
                    <label class="text" for="exampleCheck1">จดจำการเข้าสู่ระบบของฉัน</label>
                </div>
                <button type="submit" class="btn_web_color w-100">เข้าสู่ระบบ</button>
                <a href="/resigter" class="text-goregister">หากไม่เคยเป็นสมาชิกกับขายคล่อง? <span>สมัครเลย</span></a>
            </form>
        </div>
    </div>
</body>
@endsection

</html>