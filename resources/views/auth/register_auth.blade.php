<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <input type="hidden" id="rols" value="1">
                <button type="submit" class="btn_web_color w-100">สมัครสมาชิก</button>
                <a href="/" class="text-goregister">หากคุณเป็นสมาชิกขายคล่องอยู่เเล้ว <span>เข้าสู่ระบบ</span></a>
            </form>
        </div>
    </div>
</body>

</html>