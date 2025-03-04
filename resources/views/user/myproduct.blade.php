<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>สินค้าของฉัน</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
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

    .detail-item-status {
        font-size: 1rem;
        color: #666;
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

    .btn-edit {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fffca0;
        color: #918c00;
        border: 1px solid #ded91a;
        padding: 8px 10px;
        border-radius: 5px;
        width: 95%;
        height: 40px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin: 0 auto 10px auto;
        text-decoration: none;
    }

    .btn-edit:hover {
        background-color: #ded91a;
        color: black !important;
    }

    .btn-delete {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #ffebee;
        color: #ff0000;
        border: 1px solid #ff4343;
        padding: 8px 10px;
        border-radius: 5px;
        width: 95%;
        height: 40px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin: 0 auto 10px auto;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background-color: #ff0000;
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
                <div class="container-myprofile">
                    <div class="image-profile">
                        <img src="<?php echo $user->user_pic; ?>" width="60" height="60" alt="">
                    </div>
                    <div class="name-profile">
                        <p class="name-profliename"><?php echo $user->user_name; ?></p>
                        <p class="name-profilefullname">
                            <?php 
                                echo ($user->first_name ?? "ยังไม่ได้ตั้งชื่อ") . " " . ($user->last_name ?? "ยังไม่ได้ตั้งนามสกุล"); 
                            ?>
                        </p>
                        
                        <p class="name-profileuserid">หมายเลขสมาชิก kaiklong-00-<?php echo $user->id; ?></p>
                    </div>
                    <div class="btn-profile">
                        <button id="share-profile-btn">แชร์</button>
                    </div>
                </div>
            </div>
            <div class="myproduct">
                <div class="product-header">
                    <h1>สินค้าประกาศขาย</h1>
                    <div class="sort-dropdown">
                        <select onchange="sortProducts(this.value)">
                            <option value="oldest">ลงขายนานสุด</option>
                            <option value="newest" selected>ลงขายล่าสุด</option>
                            <option value="lowest">ราคาถูกสุด</option>
                            <option value="highest">ราคาแพงสุด</option>
                        </select>
                    </div>
                </div>
                <div class="product-item" id="product-item"></div>
            </div>
        </div>
    </body>

    <script>
        let products = [];

        document.addEventListener('DOMContentLoaded', function() {
            const urlParts = window.location.pathname.split('/');
            const userId = urlParts[urlParts.length - 1];
            console.log("Fetching user with ID:", userId);
            const criteria = 'newest';
            sortProducts(criteria);

            fetch(`/api/getProductsByUser/<?php echo $user->id; ?>`)
                .then(response => response.json())
                .then(products => {
                    console.log("Product data received:", products);
                    const productDetailContainer = document.getElementById('product-item');

                    // Clear previous content if any
                    productDetailContainer.innerHTML = '';
                    products.forEach(product => {
                        const imagePath = (product.product_images && product.product_images.length > 0) ?
                            `/${product.product_images[0].image_path}` :
                            '/path/to/placeholder.jpg';
                        productDetailContainer.innerHTML += `
                        <div class="item">
                            <img width="200" height="200"
                                src="${imagePath}" alt="${product.product_name}">
                            <div class="detail-item">
                                <p class="detail-item-name">${product.product_name}</p>
                                <p class="detail-item-location">${product.product_location}</p>
                                <p class="detail-item-price">${new Intl.NumberFormat().format(product.product_price)} บาท</p>
                                <p class="detail-item-status">สถานะ <strong style="color: ${product.product_approve === 'ไม่อนุมัติ' ? 'red' : 'green'};">${product.product_approve}</strong></p>
                            </div>
                            <div class="btn">
                                <a class="btn-detail" href="/product-detail/${product.product_id}">ดูสินค้า</a>
                                <a class="btn-edit" href="/product/${product.product_id}/edit">แก้ไขสินค้า</a>
                                <button class="btn-delete" onclick="deleteProduct(${product.product_id})">ลบสินค้า</button>
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

            // Add event listener to the share button
            document.getElementById('share-profile-btn').addEventListener('click', function() {
                const url = "http://127.0.0.1:8000/product-listing/<?php echo $user->id; ?>";
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

            fetch(`/api/getProductsByUser/<?php echo $user->id; ?>`)
                .then(response => response.json())
                .then(data => {
                    console.log("Product data received:", data);
                    products = data;
                    displayProducts(products);
                })
                .catch(error => {
                    console.error("Error fetching product detail:", error);
                    document.getElementById('product-item').innerHTML =
                        '<p style="text-align:center;padding:20px;color:#666;">ไม่พบข้อมูลสินค้า</p>';
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
                            <p class="detail-item-status">สถานะ <strong style="color: ${product.product_approve === 'ไม่อนุมัติ' ? 'red' : 'green'};">${product.product_approve}</strong></p>
                        </div>
                        <div class="btn">
                            <a class="btn-detail" href="/product-detail/${product.product_id}">ดูสินค้า</a>
                            <a class="btn-edit" href="/editProduct/${product.product_id}">แก้ไขสินค้า</a>
                            <button class="btn-delete" onclick="deleteProduct(${product.product_id})">ลบสินค้า</button>
                        </div>
                    </div>
                `;
            });
        }

        function sortProducts(criteria) {
            let sortedProducts = [...products];
            if (criteria === 'oldest') {
                sortedProducts.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            } else if (criteria === 'newest') {
                sortedProducts.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (criteria === 'lowest') {
                sortedProducts.sort((a, b) => a.product_price - b.product_price);
            } else if (criteria === 'highest') {
                sortedProducts.sort((a, b) => b.product_price - a.product_price);
            }
            displayProducts(sortedProducts);
        }

        function deleteProduct(productId) {
            Swal.fire({
                title: 'ยืนยันการลบสินค้า',
                text: "คุณต้องการลบสินค้านี้ใช่หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/api/deleteProduct/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบสินค้าเรียบร้อย',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถลบสินค้าได้'
                        });
                    });
                }
            });
        }
    </script>
@endsection

</html>