<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายละเอียดสินค้า</title>
    @vite(['resources/js/app.js'])
    <style>
        /* สไตล์สำหรับการจัด layout */
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
    </style>
</head>
@extends('layouts.page')
@section('content')

    <body>
        <div class="container">
            <!-- Container สำหรับแสดงรายละเอียดสินค้า -->
            <div id="product-detail">
                <div class="loading-text">กำลังโหลด...</div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParts = window.location.pathname.split('/');
                const productId = urlParts[urlParts.length - 1];
                console.log("productId:", productId);

                fetch(`/api/product/${productId}`)
                    .then(response => response.json())
                    .then(product => {
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
        </div>
      `;

                        fetchData(product.category?.category_id);
                    })
                    .catch(error => {
                        console.error("Error fetching product detail:", error);
                        document.getElementById('product-detail').innerHTML =
                            '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
                    });

                function fetchData(categoryId) {
                    if (categoryId) {
                        fetch(`/api/types/category/${categoryId}`)
                            .then(response => response.json())
                            .then(types => {
                                if (types.length > 0) {
                                    updateFeatureList(types, 'type_name');
                                } else {
                                    throw new Error("No types found");
                                }
                            })
                            .catch(() => {
                                fetch(`/api/getFourBrand`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.brands.length > 0) {
                                            updateFeatureList(data.brands, 'brand_name');
                                        } else {
                                            throw new Error("No brands found");
                                        }
                                    })
                                    .catch(() => {
                                        fetch(`/api/getCategory`)
                                            .then(response => response.json())
                                            .then(data => {
                                                updateFeatureList(data.categories, 'category_name');
                                            })
                                            .catch(() => {
                                                document.getElementById('feature-list').innerHTML =
                                                    '<li>ไม่พบข้อมูล</li>';
                                            });
                                    });
                            });
                    } else {
                        fetch(`/api/getFourBrand`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.brands.length > 0) {
                                    updateFeatureList(data.brands, 'brand_name');
                                } else {
                                    throw new Error("No brands found");
                                }
                            })
                            .catch(() => {
                                fetch(`/api/getCategory`)
                                    .then(response => response.json())
                                    .then(data => {
                                        updateFeatureList(data.categories, 'category_name');
                                    })
                                    .catch(() => {
                                        document.getElementById('feature-list').innerHTML =
                                            '<li>ไม่พบข้อมูล</li>';
                                    });
                            });
                    }
                }

                function updateFeatureList(items, keyName) {
                    const featureListEl = document.getElementById('feature-list');
                    if (!items || items.length === 0) {
                        featureListEl.innerHTML = '<li>ไม่พบข้อมูล</li>';
                        return;
                    }
                    featureListEl.innerHTML = items.map(item => `<li>${item[keyName]}</li>`).join('');
                }
            });
        </script>
    </body>
@endsection

</html>
