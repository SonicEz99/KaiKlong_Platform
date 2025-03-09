<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kaiklong login😎</title>
    @vite(['resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-weight: bold;
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
        border-radius: 10px;
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

    .box-google {
        width: 100%;
        border: 1px solid rgb(255, 139, 61);
        margin-top: 15px;
        padding: 8px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 14px;

    }

    .text-google {
        text-decoration: none;
        color: rgb(255, 139, 61);
    }
</style>

@extends('layouts.app')
@section('content')

    <body style="background-color: #FFE6C9; font-family: 'Noto Sans Thai', 'Prompt', sans-serif;">
        <div class="container">
            <div class="bg-from">
                <form id="loginForm">
                    <h3 class="color_web text-center mb-3">Kaiklong</h3>
                    <p class=" text text-center mb-3">เข้าสู่ระบบ</p>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="lable form-label">อีเมล</label>
                        <input type="email" id="user_email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="กรอกอีเมล">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="lable form-label">รหัสผ่าน</label>
                        <input type="password" id="user_password" class="text form-control" id="exampleInputPassword1"
                            placeholder="กรอกรหัสผ่าน">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="checkbox" id="exampleCheck1">
                        <label class="text" for="exampleCheck1">จดจำการเข้าสู่ระบบของฉัน</label>
                    </div>
                    <button type="submit" class="btn_web_color w-100">เข้าสู่ระบบ</button>


                    <div class="box-google">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                            viewBox="0 0 50 50">
                            <path fill="#fbc02d"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                            <path fill="#e53935"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                            </path>
                            <path fill="#4caf50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                            </path>
                            <path fill="#1565c0"
                                d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>
                        <a class="text-google" href="{{ route('auth.google') }}">
                            เชื่อมต่อด้วย GOOGLE
                        </a>
                    </div>



                    <a href="/register" class="text-goregister">หากไม่เคยเป็นสมาชิกกับขายคล่อง? <span>สมัครเลย</span></a>

                    <script>
                        document.querySelector('form').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const userEmail = document.getElementById('user_email').value;
                            const userPassword = document.getElementById('user_password').value;
                            axios.post('/api/login', {
                                    user_email: userEmail,
                                    user_password: userPassword,
                                })
                                .then(response => {
                                    console.log(response.data);
                                    localStorage.setItem('token', response.data.token);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ทำการล็อคอินเสร็จสิ้น',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.href = '/home';
                                    });
                                })
                                .catch(error => {
                                    console.error(error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ทำการล็อคอินล้มเหลว',
                                        text: 'โปรดทำการเช็คอีเมลและรหัสผ่านให้ถูกต้อง',
                                        confirmButtonColor: '#f26b0f'
                                    });
                                });
                        });
                    </script>


                </form>
            </div>
        </div>
    </body>
@endsection

</html>
