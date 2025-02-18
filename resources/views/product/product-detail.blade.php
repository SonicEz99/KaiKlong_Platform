<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายละเอียดสินค้า</title>
    @vite(['resources/js/app.js'])
    <style>



    </style>
</head>

@extends('layouts.page')
@section('content')

    <body>

        <div class="container">
            <!-- Container สำหรับแสดงรายละเอียดสินค้า -->
            <div id="product-detail">
                <div class="loading-text" style="text-align: center; padding: 20px; color: #666;">กำลังโหลด...</div>
            </div>
        </div>

        <div id="product-detail"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ดึง productId จาก URL
                const urlParts = window.location.pathname.split('/');
                const productId = urlParts[urlParts.length - 1]; // ค่าตัวสุดท้ายจาก URL
        
                console.log(productId); // ตรวจสอบค่า productId
        
                // ดึงข้อมูลสินค้า
                fetch(`/api/product/${productId}`)
                    .then(response => response.json())
                    .then(product => {
                        const productDetailContainer = document.getElementById('product-detail');
                        
                        // ตรวจสอบว่ามีภาพสินค้าหรือไม่
                        const imagePath = (product.product_images?.length > 0) ? 
                            `/${product.product_images[0].image_path}` : 
                            '/path/to/placeholder.jpg';
        
                        // แสดงรายละเอียดสินค้าบนหน้า
                        productDetailContainer.innerHTML = `
                            <div class="product-card">
                                <img class="product-image" src="${imagePath}" alt="${product.product_name}" 
                                    loading="lazy" onerror="this.src='/path/to/placeholder.jpg'" />
                                <div class="product-details">
                                    <b class="product-title">${product.product_name}</b>
                                    <span class="product-price">${new Intl.NumberFormat().format(product.product_price)} บาท</span>
                                    <span class="product-description">${product.product_location || 'ไม่มีข้อมูลที่ตั้ง'}</span>
                                </div>
                                <div class="product-description">
                                    <p><strong>รายละเอียดสินค้า:</strong> ${product.product_description || 'ไม่มีรายละเอียดเพิ่มเติม'}</p>
                                </div>
                            </div>
                        `;
                    })
                    .catch(error => {
                        console.error("Error fetching product detail:", error);
                        document.getElementById('product-detail').innerHTML =
                            '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
                    });
            });
        </script>
        

    </body>
@endsection

</html>
