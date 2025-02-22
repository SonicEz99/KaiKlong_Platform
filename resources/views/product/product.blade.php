<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าทั้งหมด</title>
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            background-color: #FF8C00;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .pagination button:hover {
            background-color: #FFA500;
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
                display: flex;
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

        .category {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            justify-content: center;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .category-item {
            flex: 0 0 200px;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .category-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .category-name {
            font-size: 16px;
            color: #333;
            margin: 0;
        }
    </style>
</head>

@extends('layouts.page')
@section('content')

    <body style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif;">
        <div class="page-container">
            <div class="header-section">
                <div class="search-filter-container">
                    <p class="page-title">ค้นหากับขายคล่อง</p>
                    <input type="text" class="search-box" placeholder="ค้นหา">
                </div>
            </div>

            <div class="category" id="categories-container">

            </div>

            <div id="card-product">
                <div class="loading-text" style="text-align: center; padding: 20px; color: #666;">กำลังโหลด...</div>
            </div>

            <div class="pagination" id="pagination-container"></div>
        </div>

        <script>
            let currentPage = 1;
            const itemsPerPage = 24;

            document.addEventListener("DOMContentLoaded", function() {
                const searchBox = document.querySelector(".search-box");
                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get("q") || ""; // Get search query from URL

                if (searchQuery) {
                    searchBox.value = searchQuery; // Keep previous search text in box
                }

                searchBox.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        const searchValue = searchBox.value.trim();
                        if (searchValue != "") {
                            window.location.href = `/product-all?q=${encodeURIComponent(searchValue)}`;
                            fetch(`/get24productsearch?q=${encodeURIComponent(searchValue)}`)
                                .then(response => response.json())
                                .then(data => {
                                    // Handle the search results (display them in your page)
                                    console.log(data);
                                })
                                .catch(error => {
                                    console.error('Error searching products:', error);
                                });
                        } else {
                            window.location.href = `/product-all`;
                        }
                    }
                });

                fetchProducts(1);
                fetchCategories();
            });

            // document.addEventListener("DOMContentLoaded", function() {
            //     fetchProducts(currentPage);
            //     fetchCategories();
            // });

            function fetchProducts(page) {
                const productsContainer = document.getElementById("card-product");
                const paginationContainer = document.getElementById("pagination-container");

                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get("q") || ""; // Get search query

                productsContainer.innerHTML =
                    '<div class="loading-text" style="text-align: center; padding: 20px; color: #666;">กำลังโหลด...</div>';

                // ✅ Use correct API endpoint for search
                fetch(`/api/get24productsearch?page=${page}&limit=${itemsPerPage}&q=${encodeURIComponent(searchQuery)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.data || data.data.length === 0) {
                            productsContainer.innerHTML =
                                '<div style="text-align: center; padding: 20px; color: #666;">ไม่พบสินค้า</div>';
                            return;
                        }

                        let productCards = "";
                        data.data.forEach(product => {
                            const imagePath = (product.product_images && product.product_images.length > 0) ?
                                `/${product.product_images[0].image_path}` :
                                '/path/to/placeholder.jpg';

                            productCards += `
                    <div class="product-card">
                        <img class="product-image" src="${imagePath}" alt="${product.product_name}"
                            loading="lazy" onerror="this.src='/path/to/placeholder.jpg'" />
                        <div class="product-details">
                            <b class="product-title">${product.product_name}</b>
                            <span class="product-price">${new Intl.NumberFormat().format(product.product_price)} บาท</span>
                            <span class="product-description">${product.product_location || 'ไม่มีข้อมูลที่ตั้ง'}</span>
                        </div>
                        <div class="card-btn">
                            <button class="btn_detail">ดูสินค้า</button>
                        </div>
                    </div>
                `;
                        });

                        productsContainer.innerHTML = productCards;
                        paginationContainer.innerHTML = createPaginationButtons(data.last_page, page);
                    })
                    .catch(error => {
                        console.error("Error fetching products:", error);
                        productsContainer.innerHTML = `<div style="text-align: center; padding: 20px; color: #666;">
                เกิดข้อผิดพลาดในการโหลดข้อมูล กรุณาลองใหม่อีกครั้ง
            </div>`;
                    });
            }


            // ✅ ฟังก์ชันสร้างปุ่มเปลี่ยนหน้า
            function createPaginationButtons(totalPages, currentPage) {
                let buttons = '';

                if (currentPage > 1) {
                    buttons += `<button onclick="fetchProducts(${currentPage - 1})">« ก่อนหน้า</button>`;
                }

                for (let i = 1; i <= totalPages; i++) {
                    buttons += `<button onclick="fetchProducts(${i})" ${i === currentPage ? 'disabled' : ''}>${i}</button>`;
                }

                if (currentPage < totalPages) {
                    buttons += `<button onclick="fetchProducts(${currentPage + 1})">ถัดไป »</button>`;
                }

                return buttons;
            }

            function fetchCategories() {
                fetch('/api/getFourBrand')
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('categories-container');
                        if (data.brands && Array.isArray(data.brands)) {
                            data.brands.forEach(brand => {
                                const categoryElement = createCategoryElement(brand);
                                container.appendChild(categoryElement);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching categories:', error));
            }

            function createCategoryElement(brand) {
                const div = document.createElement('div');
                div.className = 'category-item';
                div.innerHTML = `
                <a href="http://127.0.0.1:8000/product-all?q=${brand.brand_name}" target="_blank" style="text-decoration: none;">
                        <img src="${brand.brand_pic_path}" alt="${brand.brand_name}" class="category-image">
                        <p class="category-name">${brand.brand_name}</p>
                    </a>
                `;
                div.addEventListener('click', () => {
                    console.log('Category clicked:', brand.brand_name);
                });
                return div;
            }
        </script>

    </body>
@endsection

</html>
