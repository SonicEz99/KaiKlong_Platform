<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายละเอียดสินค้า</title>
    @vite(['resources/js/app.js'])
    <style>
        .product-card {
            display: flex;
            gap: 20px;
            padding: 20px;
            border-radius: 8px;
            flex-wrap: wrap;
        }

        .product-image {
            width: 400px;
            height: 400px;
            max-width: 100%;
            object-fit: cover;
        }

        .image-add {
            flex-direction: column;
        }

        /* รูปภาพเพิ่มเติม */
        .additional-images {
            margin-top: 20px;
            padding: 14px;
        }

        .image-gallery {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .additional-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            width: 60%;
        }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 20px;
            color: black;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .product-seller {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .seller-name {
            color: #FF8C00;
            font-size: 20px;
        }

        .btn-chat {
            width: 50%;
            padding: 4px;
            background-color: #FB8C00;
            color: #ffffff;
            border: 2px solid #FB8C00;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .feature-section {
            margin-top: 20px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0 10px 0;
            padding-bottom: 5px;
        }

        .feature-list {
            list-style-type: disc;
            margin-left: 20px;
        }

        .loading-text {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        .seller-card {
           display: flex;
           gap: 10px;
           justify-content: center;
           align-items: center;
           width: 100%;
        }

        .seller-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .seller-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .seller-name {
            font-weight: bold;

        }

        .btn-call,
        .btn-view-products {
            width: 50%;
            padding: 4px;
            background-color: #ececec;
            color: #000000;
            border: 2px solid #FB8C00;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
    </style>
</head>

@extends('layouts.page')
@section('content')

    <body>
        <div class="container">
            <div id="product-detail">
                <div class="loading-text">กำลังโหลด...</div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParts = window.location.pathname.split('/');
                const productId = urlParts[urlParts.length - 1];
                console.log("Fetching product with ID:", productId);

                fetch(`/api/product/${productId}`)
                    .then(response => response.json())
                    .then(product => {
                        console.log("Product data received:", product);
                        const productDetailContainer = document.getElementById('product-detail');

                        const imagePath = (product.product_images && product.product_images.length > 0) ?
                            `/${product.product_images[0].image_path}` :
                            '/path/to/placeholder.jpg';

                        let productFeature = '';

                        if (product.brand && product.brand.brand_name && product.brand.brand_name.length !== 0) {
                            productFeature = `
                                            <div class="feature-section">
                                                <div class="feature-title">คุณสมบัติ</div>
                                                <p>ยี่ห้อ <i style="color: #FF8C00;">${product.brand.brand_name}</i></p>
                                            </div>
                                        `;
                        } else if (product.type && product.type.type_name) {
                            productFeature = `
                                        <div class="feature-section">
                                            <div class="feature-title">คุณสมบัติ</div>
                                            <p>ประเภท <i style="color: #FF8C00;">${product.type.type_name}</i></p>
                                        </div>
                                    `;
                        }
                        productDetailContainer.innerHTML = `
                                                            <div class="product-card">
                                                                 <div class="image-add">
                                                                    <img class="product-image" src="${imagePath}" alt="${product.product_name}"
                                                                        loading="lazy" onerror="this.src='/path/to/placeholder.jpg'">

                                                                        <div class="additional-images">
                                                                            <div class="image-gallery">
                                                                                ${product.product_images.slice(1).map(img => `
                                                                                                    <img class="additional-image" src="/${img.image_path}" alt="${product.product_name}"
                                                                                                        loading="lazy" onerror="this.src='/path/to/placeholder.jpg'">
                                                                                                `).join('')}
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                <div class="product-details">
                                                                    <div class="product-title">${product.product_name}</div>
                                                                    <div class="product-price">${new Intl.NumberFormat().format(product.product_price)} บาท</div>
                                                                    <div class="product-seller">
                                                                        <strong>ลงขายโดย</strong> <span class="seller-name">${product.user?.user_name || 'ไม่ระบุ'}</span>
                                                                    </div>

                                                                    <button class="btn-chat">คุยกับผู้ขาย</button>

                                                                    ${productFeature}


                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <div class="product-description">
                                                                        <div class="feature-title">รายละเอียดสินค้า</div>
                                                                        <p id="product-details">${product.product_description || "ไม่มีรายละเอียดสินค้า"}</p>
                                                                    </div>

                                                                    <!-- ข้อมูลผู้ขาย -->
                                                                    <div class="seller-card">
                                                                        <img class="seller-image" src="${product.user?.user_pic }"
                                                                            alt="${product.user?.user_name}" loading="lazy">
                                                                        <div class="seller-info">
                                                                            <div class="seller-name">${product.user?.user_name || 'ไม่ระบุ'}</div>
                                                                            <a class="btn-call" href="tel:${product.user?.phone || '#'}">โทร: ${product.user?.phone || ''}</a>
                                                                            <a class="btn-view-products" href="/seller/${product.user?.id || ''}">ดูสินค้าทั้งหมด</a>
                                                                        </div>
                                                                    </div>
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
