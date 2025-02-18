<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์</title>
    @vite(['resources/js/app.js'])
</head>


<style>
    .header-title{
        color:orange;
    }

    .profile-setting{
        background-color: #E6E6E6;   
        padding: 54px 54px 54px 54px;
        display: flex;
        gap: 5%;
        justify-content: start;
        align-items: center;

        .profile-pic{
            width: 150px;
            height: 150px;
            border-radius: 100%;
        }
        .detail-profile{
            color:grey;
        }
    }

    .management-data-profile{
        margin-top: 24px;
        display:grid;
        grid-template-columns: 1fr 2fr;
        gap: 5%;


        .text-flind-setting{
            display:flex ; 
            flex-direction:column;
            gap:24px;
            border-left: 1px solid #E6E6E6;
        }

        .input-data {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .input-data label {
            width: 100px; 
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
        }

        ul{
            list-style:none;
            text-align:center;
            font-size:18px;

            li{
                margin-bottom:15px;
                padding:10px;
                background-color:orange;
                border-radius:8px;
                color:white;
            }
        }

        .btn{
            button{
                padding: 5px;
                border: none;
                background-color: orange;
                border-radius:8px;
                width: 300px;
                color: white;
            }
        }
    }
    
</style>

<?php
$user = auth()->user();
?>
@extends('layouts.page')
@section('content')
<body>
 <hr>
    <div class="container">
        <h1 class="header-title">ข้อมูลส่วนตัว</h1>
    </div>
    <hr>

    <div class="container">
        <div class="profile-setting">         
                <img class="profile-pic"
                    src="<?php echo $user->user_pic ? $user->user_pic : 'https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg' ?>"
                    alt="">

                    <div class="detail-profile">
                        <h3>ชื่อผู้ใช้ : <?php echo $user->user_name ?></h3>
                        <h3>อีเมล : <?php echo $user->user_email ?></h3>
                    </div>
        </div>

        <div class="management-data-profile">
            <div class="menu-setting">
                <ul>
                    <li>ข้อมูลส่วนตัว</li>
                    <li>จัดการบัญชี</li>
                </ul>
                <hr>
            </div>
            <div class="text-flind-setting">
                    <div class="input-data">
                        <label for="">ชื่อผู้ใช้</label>
                        <input type="text">
                    </div>
                    <div class="input-data">
                        <label for="">ชื่อ*</label>
                        <input type="text">
                    </div>
                    <div class="input-data">
                        <label for="">นามสกุล*</label>
                        <input type="text">
                    </div>

                    <hr>
                    <div class="container">
                    <h5>ข้อมูลการติดต่อ</h4>
                    </div>
                    <div class="input-data">
                        <label for="">เบอร์</label>
                        <input type="text" placeholder="+ เบอร์โทรศัพท์">
                    </div>

                    
                    <div class="btn">
                        <button>บันทึก</button>
                    </div>
                    
                    
            </div>
        </div>
    </div>
</body>
@endsection
</html>