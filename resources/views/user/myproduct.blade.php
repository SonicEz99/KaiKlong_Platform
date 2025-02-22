<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าของฉัน</title>
</head>
@vite(['resources/js/app.js'])
@extends('layouts.page')
@section('content')
    <?php
    $user = Auth::user();
                                                            ?>

    <body>
        <div class="container">
            <div class="myprofile">
                <div class="container-myprofile">
                    <div class="image-profile">
                        <img src="<?php echo $user->user_pic ?>" width="60" height="60" alt="">
                    </div>
                    <div class="name-profile">
                        <b><?php echo $user->user_name ?></b>
                        <p>ผู้ค้าดีเด่น ประจำขายคล่อง</p>
                        <p>หมายเลขสมาชิก kaiklong-00-<?php echo $user->id ?></p>
                    </div>
                    <div class="btn-profile">
                        <button>แชร์</button>
                    </div>
                </div>
            </div>

            <div class="myproduct">
                <h1>สินค้าประกาศขาย</h1>


                <div class="product-item">
                    <div class="item">
                        <img width="200" height="200"
                            src="https://www.istudio.store/cdn/shop/files/iPhone_13_Midnight_PDP_Position-1A_Midnight_Color__TH.jpg?v=1707275346&width=1445"
                            alt="">
                        <div class="detail-item">
                            <p>i phone 12 (สีดำ ไม่เก็บเเบค)</p>
                            <p>บุรีรัมย์</p>
                            <p>$8,990</p>
                        </div>
                        <div class="btn">
                            <button>ดูสินค้า</button>
                        </div>
                    </div>

                    <div class="item">
                        <img width="200" height="200"
                            src="https://www.istudio.store/cdn/shop/files/iPhone_13_Midnight_PDP_Position-1A_Midnight_Color__TH.jpg?v=1707275346&width=1445"
                            alt="">
                        <div class="detail-item">
                            <p>i phone 12 (สีดำ ไม่เก็บเเบค)</p>
                            <p>บุรีรัมย์</p>
                            <p>$8,990</p>
                        </div>
                        <div class="btn">
                            <button>ดูสินค้า</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <style>
            .container {
                display: flex;
                gap: 25px;
            }

            .myprofile {
                background-color: white;
                width: 30%;

            }

            .container-myprofile {
                border: 1px solid gray;
                text-align: center;
                padding: 8px;
                border-radius: 4px;


                .btn-profile{
                    width: 100%;

                    button{
                        border: solid 2px orange;
                        width: 200px;
                        border-radius: 4px;
                    }
                }
            }

            .myproduct {
                padding: 4px;
                width: 100%;

                .product-item {
                    display: grid;
                    grid-template-columns: repeat(4, 4fr);
                    gap: 4px;
                    padding: 4px;

                    .item {
                        border-radius: 8px;
                        border: 1px solid gray;

                        img {
                            background-size: cover;
                            border-radius: 16px;
                        }

                        .detail-item {
                            margin: 0 20px 0 20px;

                            p {
                                color: gray;
                            }
                        }

                        .btn {
                            display: flex;
                            justify-content: center;


                            button {
                                width: 250px;
                                border-radius: 4px;
                                border: 2px solid orange;
                            }
                        }

                    }
                }
            }
        </style>
    </body>

@endsection

</html>