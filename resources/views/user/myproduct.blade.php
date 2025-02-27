<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าของฉัน</title>
    @vite(['resources/js/app.js'])
</head>
<?php
$user = Auth::user(); ?>
@extends('layouts.page')
@section('content')

    <body>
        <div class="container">
            <div class="myprofile">
                <div class="container-myprofile">
                    <div class="image-profile">
                        <img src="<?php echo $user->user_pic; ?>" width="60" height="60" alt="">
                    </div>
                    <div class="name-profile">
                        <div style="display: grid; grid-template-rows: auto;">
                            <b style="font-size: 24px; font-weight: bold; margin-top: 8px;"><?php echo $user->user_name; ?></b>
                            <p style="margin: 0; color:#7b7b7b">ผู้ค้าดีเด่น ประจำขายคล่อง</p>
                            <p style="margin: 0; color:#7b7b7b">หมายเลขสมาชิก kaiklong-00-<?php echo $user->id; ?></p>
                        </div>
                    </div>
                    <div class="btn-profile">
                        <button style="margin: 4px;">แชร์</button>
                    </div>
                </div>
            </div>

            <div class="myproduct">
                <b style="font-size: 30px; font-weight: bold;">สินค้าที่ประกาศขาย</b>
                <div class="product-item" id="product-item">
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
                text-align: center;
                padding: 8px;
                box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);

                .btn-profile {
                    width: 100%;
                    padding: 0 15px 0;

                    button {
                        font-size: 14px;
                        color: #FF8C00;
                        background-color: #ffffff;
                        border: 1px solid #FF8C00;
                        border-radius: 5px;
                        padding: 8px 16px;
                        text-decoration: none;
                        font-weight: bold;
                        display: inline-block;
                        transition: 0.3s;
                        width: 100%;
                    }
                }
            }

            .myproduct {
                padding: 4px;
                width: 100%;

                .product-item {
                    display: grid;
                    grid-template-columns: repeat(4, 4fr);
                    gap: 14px;
                    padding: 4px;

                    .item {
                        background: white;
                        border-radius: 10px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        transition: transform 0.2s, box-shadow 0.2s;
                        overflow: hidden;
                        display: flex;
                        flex-direction: column;
                        border: #c8c7c7 solid 1px;

                        img {
                            width: 100%;
                            background-size: cover;
                            border-radius: 10px 10px 0px 0px;
                        }

                        .detail-item {
                            margin: 0 20px 0 20px;


                            p {
                                color: black;
                            }
                        }

                        .btn {
                            display: flex;
                            justify-content: center;
                            width: 100%;
                            /* background-color: red; */
                            padding: 4px;

                            button {
                                width: 250px;
                                border-radius: 1px;
                                border: 2px solid #FF8C00;
                            }

                            .btn_detail {
                                font-size: 14px;
                                color: #FF8C00;
                                background-color: #fff1df;
                                border: 1px solid #FF8C00;
                                border-radius: 5px;
                                padding: 4px 1px 4px 1px ;
                                text-decoration: none;
                                font-weight: bold;
                                display: inline-block;
                                transition: 0.3s;
                                width: 100%;
                            }

                            .btn_detail:hover {
                                background-color: #FF8C00;
                                color: white;
                            }
                        }

                    }
                }
            }
        </style>
    </body>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParts = window.location.pathname.split('/');
        const userId = urlParts[urlParts.length - 1];
        console.log("Fetching user with ID:", userId);

        fetch(`/api/getProductsByUser/<?php echo $user->id; ?>`)
            .then(response => response.json())
            .then(products => {
                console.log("Product data received:", products);
                const productDetailContainer = document.getElementById('product-item');

                // Clear previous content if any
                productDetailContainer.innerHTML = '';

                products.forEach(product => {
                    const imagePath = (product.product_images && product.product_images.length >
                            0) ?
                        `/${product.product_images[0].image_path}` :
                        '/path/to/placeholder.jpg';

                    productDetailContainer.innerHTML += `
                        <div class="item">
                            <img width="200" height="200"
                                src="${imagePath}" alt="${product.product_name}">
                            <div class="detail-item">
                                <p style="margin: 0;">${product.product_name}</p>
                                <p style="font-size: 12px; margin: 0;">${product.product_location}</p>
                                <p style="margin: 0;">${new Intl.NumberFormat().format(product.product_price)} บาท</p>
                            </div>
                            <div class="btn">
                                <button class="btn_detail " href="/product-detail/${product.product_id}">ดูสินค้า</button>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => {
                console.error("Error fetching product detail:", error);
                document.getElementById('product-item').innerHTML =
                    '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
            });
    });
</script>


</html>
