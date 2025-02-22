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
    $user = Auth::user(); ?>

    <body>
        <div class="container">
            <div class="myprofile">
                <div class="container-myprofile" id="container-myprofile">

                </div>
            </div>

            <div class="myproduct">
                <h1>สินค้าประกาศขาย</h1>
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
                border: 1px solid gray;
                text-align: center;
                padding: 8px;
                border-radius: 4px;


                .btn-profile {
                    width: 100%;

                    button {
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
                        text-align: center;

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParts = window.location.pathname.split('/');
    const userId = urlParts[urlParts.length - 1];
    console.log("Fetching user with ID:", userId);

    fetch(`/api/getUser/${userId}`)
        .then(response => response.json())
        .then(response => {
            console.log("User data received:", response);

            // Fix: Extract the user object
            const user = response.user;

            if (!user) {
                console.error("User data is missing in response");
                return;
            }

            const userContainer = document.getElementById('container-myprofile');

            userContainer.innerHTML = `
                <div class="image-profile">
                    <img src="${user.user_pic || '/path/to/default-profile.jpg'}" width="60" height="60" alt="">
                </div>
                <div class="name-profile">
                    <b>${user.user_name || "ไม่ระบุชื่อผู้ใช้"}</b>
                    <p>${user.first_name ? user.first_name : "ยังไม่ได้ตั้งชื่อ"}</p>
                    <p>${user.last_name ? user.last_name : "ยังไม่ได้ตั้งนามสกุล"}</p>
                    <p>หมายเลขสมาชิก kaiklong : ${user.id}</p>
                </div>
                <div class="btn-profile">
                    <button>แชร์</button>
                </div>
            `;
        })
        .catch(error => {
            console.error("Error fetching user details:", error);
            document.getElementById('container-myprofile').innerHTML =
                '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลผู้ใช้</p>';
        });

            fetch(`/api/getProductsByUser/${userId}`)
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
                                <p>${product.product_name}</p>
                                <p>${product.product_location}</p>
                                <p>${new Intl.NumberFormat().format(product.product_price)} บาท</p>
                            </div>
                            <div class="btn">
                                <a class="btn_detail" href="/product-detail/${product.product_id}">ดูสินค้า</a>
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
@endsection

</html>
