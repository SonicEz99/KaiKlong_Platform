<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าทั้งหมด</title>
    @vite(['resources/js/app.js'])
    <style>
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header-section {
            margin-bottom: 20px;
        }

        .page-title {
            font-weight: 600;
            color: orange;
            margin: 0;
            font-size: 1.2rem;
        }

        .search-filter-container {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            width: 100%;
        }

        .search-box {
            max-width: 80%;
            width: 100%;
            padding: 8px 15px;
            border: 2px solid orange;
            border-radius: 8px;
            font-size: 1rem;
        }

        .search-box:focus {
            outline: none;
            border-color: orange;
        }

        #card-product {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            padding: 20px 0;
        }

        .product-card {
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .product-details {
            padding: 15px;
            flex-grow: 1;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .product-price {
            font-size: 1.2rem;
            color: #e65100;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .product-description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
            display: block;
        }

        .card-btn {
            padding: 0 15px 15px;
        }

        .btn_detail {
            width: 100%;
            padding: 4px;
            background-color: #FFF3E0;
            color: #FB8C00;
            border: 2px solid #FB8C00;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
        }

        .btn_detail:hover {
            background-color: #FB8C00;
            color: white;
        }

        @media (max-width: 1024px) {
            #card-product {
                grid-template-columns: repeat(4, 1fr);
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 15px;
            }

            .search-filter-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .search-box {
                max-width: 100%;
            }

            #card-product {
                grid-template-columns: repeat(4, 1fr);
                gap: 12px;
            }

            .product-image {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .page-container {
                padding: 10px;
            }

            .search-filter-container {
                gap: 10px;
            }

            #card-product {
                grid-template-columns: repeat(1, 1fr);
                gap: 10px;
            }

            .product-image {
                height: 150px;
            }

            .product-details {
                padding: 10px;
            }

            .product-title {
                font-size: 0.9rem;
            }

            .product-price {
                font-size: 1rem;
            }

            .product-description {
                font-size: 0.8rem;
                margin-bottom: 10px;
            }

            .btn_detail {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

@extends('layouts.page')
@section('content')
<body>
    <div class="page-container">
        <div class="header-section">
            <div class="search-filter-container">
                     <p class="page-title">ค้นหากับขายคล่อง</p>
                     <input type="text" class="search-box" placeholder="ค้นหา">
            </div>
        </div>

        <div id="card-product">
            <div class="loading-text" style="text-align: center; padding: 20px; color: #666;">กำลังโหลด...</div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const productsContainer = document.getElementById("card-product");
            
            // Show loading state immediately
            productsContainer.innerHTML = '<div class="loading-text" style="text-align: center; padding: 20px; color: #666;">กำลังโหลด...</div>';

            // Add cache control headers to prevent caching
            const fetchOptions = {
                headers: {
                    'Cache-Control': 'no-cache',
                    'Pragma': 'no-cache'
                }
            };

            // Use Promise.race to implement timeout
            const timeout = new Promise((_, reject) => 
                setTimeout(() => reject(new Error('Request timeout')), 5000)
            );

            Promise.race([
                fetch("/api/product", fetchOptions),
                timeout
            ])
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data.products || data.products.length === 0) {
                    productsContainer.innerHTML = '<div style="text-align: center; padding: 20px; color: #666;">ไม่พบสินค้า</div>';
                    return;
                }

                let productCards = "";
                data.products.forEach(product => {
                    const imagePath = (product.product_images && product.product_images.length > 0)
                        ? `/${product.product_images[0].image_path}`
                        : '/path/to/placeholder.jpg';

                    productCards += `
                      <div class="product-card">
                        <img class="product-image" src="${imagePath}" alt="${product.product_name}" 
                             loading="lazy" onerror="this.src='/path/to/placeholder.jpg'" />
                        <div class="product-details">
                          <b class="product-title">
                            ${product.product_name}
                          </b>
                          <span class="product-price">${new Intl.NumberFormat().format(product.product_price)} บาท</span>
                          <span class="product-description">${product.product_location}</span>
                        </div>
                        <div class="card-btn">
                          <button class="btn_detail">ดูสินค้า</button>
                        </div>
                      </div>
                    `;
                });
                
                productsContainer.innerHTML = productCards;
            })
            .catch(error => {
                console.error("Error fetching products:", error);
                productsContainer.innerHTML = `
                    <div style="text-align: center; padding: 20px; color: #666;">
                        เกิดข้อผิดพลาดในการโหลดข้อมูล กรุณาลองใหม่อีกครั้ง
                    </div>`;
            });
        });
    </script>
</body>
@endsection
</html>