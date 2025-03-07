<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าผู้อื่น</title>
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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
        background: white;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: -40px;
        text-align: center;
        padding: 8px;
        border-radius: 2px;
        z-index: 10;
    }

    .btn-profile {
        width: 100%;
    }

    .btn-profile button {
        background: #fff1df;
        color: #FF8C00;
        border: 1px solid #FF8C00;
        padding: 4px 15px;
        margin-top: 10px;
        border-radius: 5px;
        width: 100%;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-profile button:hover {
        background-color: #FB8C00;
        color: white;
        position: relative;
    }

    .myproduct {
        padding: 4px;
        width: 100%;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .product-item {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        padding: 20px 0;
    }

    .item {
        background: white;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .item:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .item img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .detail-item {
        padding: 15px;
    }

    .detail-item-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .detail-item-location {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 15px;
        display: block;
    }

    .detail-item-price {
        font-size: 1.2rem;
        color: #e65100;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .btn-detail {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff1df;
        color: #FF8C00;
        border: 1px solid #FF8C00;
        padding: 8px 10px;
        border-radius: 5px;
        width: 95%;
        height: 40px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin: 10px auto;
        margin-top: auto;
        margin-bottom: 5px;
        text-decoration: none;
    }

    .btn-detail:hover {
        background-color: #FB8C00;
        color: white;
        position: relative;
    }

    .name-profliename {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .name-profilefullname {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 10px;
    }

    .name-profileuserid {
        font-size: 1rem;
        color: #666;
        margin-bottom: 10px;
    }

    .orange-banner {
        width: 100%;
        height: 120px;
        background-color: #FF8C00;
        margin-bottom: 20px;
    }

    .sort-dropdown select {
        color: #FF8C00;
        border: 1px solid #FF8C00;
        width: 100%;
        height: 40px;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
    }

    .sort-dropdown select:hover {
        background-color: #FB8C00;
        color: white;
    }
</style>

@extends('layouts.page')
@section('content')
    <?php
    $user = Auth::user(); ?>

    <body style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif;">
        <div class="orange-banner"></div>
        <div class="container">
            <div class="myprofile">
                <div class="container-myprofile" id="container-myprofile">
                </div>
            </div>
            <div class="myproduct">
                <div class="product-header">
                    <h1>สินค้าประกาศขาย</h1>
                    <div class="sort-dropdown">
                        <select onchange="sortProducts(this.value)">
                            <option value="newest">ลงขายล่าสุด</option>
                            <option value="oldest">ลงขายนานสุด</option>
                            <option value="lowest">ราคาถูกสุด</option>
                            <option value="highest">ราคาแพงสุด</option>
                        </select>
                    </div>
                </div>
                <div class="product-item" id="product-item">

                </div>
            </div>
        </div>
    </body>

    <script>
        let products = [];

        document.addEventListener('DOMContentLoaded', function() {
            const urlParts = window.location.pathname.split('/');
            const userId = urlParts[urlParts.length - 1];
            console.log("Fetching user with ID:", userId);

            fetch(`/api/getUser/${userId}`)
                .then(response => response.json())
                .then(response => {
                    console.log("User data received:", response);

                    const user = response.user;

                    if (!user) {
                        console.error("User data is missing in response");
                        return;
                    }

                    const userContainer = document.getElementById('container-myprofile');

                    const baseURL = window.location.origin; 
                    const profilePic = user.user_pic ? `${baseURL}/${user.user_pic}` : "https://cdn-icons-png.flaticon.com/512/9203/9203764.png";


                    userContainer.innerHTML = `
                <div class="image-profile">
                    <img width="60" height="60" src="${profilePic}" alt="${user.user_name}" loading="lazy">
                </div>
                <div class="name-profile">
                    <p class="name-profliename">${user.user_name || "ไม่ระบุชื่อผู้ใช้"}</p>
                    <p class="name-profilefullname">${user.first_name ? user.first_name : "ยังไม่ได้ตั้งชื่อ"} ${user.last_name ? user.last_name : "ยังไม่ได้ตั้งนามสกุล"}</p>
                    <p class="name-profileuserid">หมายเลขสมาชิก kaiklong : ${user.id}</p>
                </div>
                <div class="btn-profile">
                    <button id="share-profile-btn">แชร์</button>
                </div>
            `;

                    // Add event listener to the share button
                    document.getElementById('share-profile-btn').addEventListener('click', function() {
                        const url = window.location.href;
                        navigator.clipboard.writeText(url).then(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'ทำการคัดลอกโปรไฟล์เสร็จสิ้น',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }, function(err) {
                            console.error('Could not copy text: ', err);
                        });
                    });
                })
                .catch(error => {
                    console.error("Error fetching user details:", error);
                    document.getElementById('container-myprofile').innerHTML =
                        '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลผู้ใช้</p>';
                });

            fetch(`/api/getProductsByUser/${userId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Product data received:", data);
                    products = data;
                    displayProducts(products);
                })
                .catch(error => {
                    console.error("Error fetching product detail:", error);
                    document.getElementById('product-item').innerHTML =
                        '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
                });
        });

        function displayProducts(products) {
            const productDetailContainer = document.getElementById('product-item');
            productDetailContainer.innerHTML = '';

            products.forEach(product => {
                const imagePath = (product.product_images && product.product_images.length > 0) ?
                    `/${product.product_images[0].image_path}` :
                    '/path/to/placeholder.jpg';

                productDetailContainer.innerHTML += `
                    <div class="item">
                        <img width="200" height="200" src="${imagePath}" alt="${product.product_name}">
                        <div class="detail-item">
                            <p class="detail-item-name">${product.product_name}</p>
                            <p class="detail-item-location">${product.product_location}</p>
                            <p class="detail-item-price">${new Intl.NumberFormat().format(product.product_price)} บาท</p>
                        </div>
                        <a class="btn-detail" href="/product-detail/${product.product_id}">ดูสินค้า</a>
                    </div>
                `;
            });
        }

        function sortProducts(criteria) {
            let sortedProducts = [...products];
            if (criteria === 'newest') {
                sortedProducts.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (criteria === 'oldest') {
                sortedProducts.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            } else if (criteria === 'lowest') {
                sortedProducts.sort((a, b) => a.product_price - b.product_price);
            } else if (criteria === 'highest') {
                sortedProducts.sort((a, b) => b.product_price - a.product_price);
            }
            displayProducts(sortedProducts);
        }
    </script>
@endsection

</html>
