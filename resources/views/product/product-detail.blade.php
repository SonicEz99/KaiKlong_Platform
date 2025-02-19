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
            align-items: flex-start;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .product-image {
            width: 300px;
            max-width: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 20px;
            color: #e74c3c;
            margin-bottom: 5px;
        }

        .product-seller {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .btn-chat {
            display: inline-block;
            padding: 8px 16px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .feature-section {
            margin-top: 20px;
        }

        .feature-title {
            font-size: 20px;
            margin: 20px 0 10px 0;
            border-bottom: 1px solid #ddd;
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
            gap: 15px;
            align-items: center;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 400px;
        }

        .seller-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }

        .seller-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .seller-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .btn-call,
        .btn-view-products {
            display: inline-block;
            padding: 8px 12px;
            background-color: #2ecc71;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 5px;
        }

        .btn-view-products {
            background-color: #f39c12;
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

                        productDetailContainer.innerHTML = `
                        <div class="product-card">
                            <img class="product-image" src="${imagePath}" alt="${product.product_name}" 
                                loading="lazy" onerror="this.src='/path/to/placeholder.jpg'">
                            <div class="product-details">
                                <div class="product-title">${product.product_name}</div>
                                <div class="product-price">${new Intl.NumberFormat().format(product.product_price)} บาท</div>
                                <div class="product-seller">
                                    <strong>ผู้ขาย:</strong> ${product.user?.user_name || 'ไม่ระบุ'}
                                </div>
                                <a class="btn-chat" href="https://m.me/${product.user?.google_id || ''}" target="_blank">คุยกับผู้ขาย</a>
                                <div class="feature-section">
                                    <div class="feature-title">คุณสมบัติเด่น</div>
                                    <ul class="feature-list" id="feature-list">
                                        <li>กำลังโหลด...</li>
                                    </ul>
                                </div>
                            </div>
                         <div class="seller-card">
                            <img class="seller-image" src="${product.user?.profile_image || '/path/to/default-profile.jpg'}" alt="${product.user?.user_name}" loading="lazy">
                            <div class="seller-info">
                                <div class="seller-name">${product.user?.user_name || 'ไม่ระบุ'}</div>
                                <a class="btn-call" href="tel:${product.user?.phone || '#'}">โทร: ${product.user?.phone || 'ไม่มีเบอร์'}</a>
                                <a class="btn-view-products" href="/seller/${product.user?.id || ''}">ดูสินค้าทั้งหมด</a>
                            </div>
                        </div>
                        </div>
                    `;

                        fetchFeatureData(product.brand_id, product.type_id);
                    })
                    .catch(error => {
                        console.error("Error fetching product detail:", error);
                        document.getElementById('product-detail').innerHTML =
                            '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
                    });

                function fetchFeatureData(brandId, typeId) {
                    console.log("Fetching feature data for Brand ID:", brandId, "Type ID:", typeId);
                    if (brandId) {
                        fetch(`/api/brands/${brandId}`)
                            .then(response => response.json())
                            .then(brand => {
                                updateFeatureList([brand], 'brand_name');
                            })
                            .catch(() => fetchType(typeId));
                    } else {
                        fetchType(typeId);
                    }
                }

                function fetchType(typeId) {
                    if (typeId) {
                        fetch(`/api/types/${typeId}`)
                            .then(response => response.json())
                            .then(type => {
                                updateFeatureList([type], 'type_name');
                            })
                            .catch(() => showNoData());
                    } else {
                        showNoData();
                    }
                }

                function showNoData() {
                    console.log("No feature data found.");
                    document.getElementById('feature-list').innerHTML = '<li>ไม่พบข้อมูล</li>';
                }

                function updateFeatureList(items, keyName) {
                    console.log("Updating feature list with:", items);
                    const featureListEl = document.getElementById('feature-list');
                    if (!items || items.length === 0) {
                        showNoData();
                        return;
                    }
                    featureListEl.innerHTML = items.map(item => `<li>${item[keyName]}</li>`).join('');
                }
            });
        </script>

        </script>
    </body>
@endsection

</html>
