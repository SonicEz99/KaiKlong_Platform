<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าของฉัน</title>
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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


    .btn-detail-unapprove {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #ffc7c7;
        color: #ff0000;
        border: 1px solid #ff4343;
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

    .btn-detail-unapprove:hover {
        background-color: #fb0000;
        color: white;
        position: relative;
    }

    .btn-detail-approve {
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

    .btn-detail-approve:hover {
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
                    <div class="image-profile">
                        <img src="https://cdn-icons-png.flaticon.com/512/9703/9703596.png" width="60" height="60"
                            alt="">
                    </div>
                    <div class="name-profile">
                        <p class="name-profliename">สวัสดี</p>
                        <p class="name-profilefullname">Admin สุดหล่อ</p>
                        <p class="name-profileuserid">ได้โปรดอนุมัติโพสต่างๆ</p>
                    </div>
                    <div class="btn-profile">
                        <button>แชร์</button>
                    </div>
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
            fetch(`api/getUnApprove`)
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
                        <a href="javascript:void(0)" class="btn-detail-approve" onClick="approve(${product.product_id})">อนุมัติโพส</a>
                        <a href="javascript:void(0)" class="btn-detail-unapprove" onClick="deleteProduct(${product.product_id})">ลบโพส</a>
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

        function approve(product_id) {
            fetch(`/api/approve/${product_id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        fetchUnapprovedProducts();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                });
        }

        function deleteProduct(product_id) {
            console.log(`Deleting product with ID: ${product_id}`); // Log to check the product ID

            fetch(`/api/deleteProduct/${product_id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Delete response:", data); // Log the response from the server
                    fetchUnapprovedProducts();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                });
        }

        // This function fetches the updated list of unapproved products
        function fetchUnapprovedProducts() {
            fetch('api/getUnApprove')
                .then(response => response.json())
                .then(data => {
                    console.log("Updated product data received:", data);
                    products = data;
                    displayProducts(products); // Re-render the updated product list
                })
                .catch(error => {
                    console.error("Error fetching product detail:", error);
                    document.getElementById('product-item').innerHTML =
                        '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
                });
        }
    </script>
@endsection

</html>
