<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaiklong | แพลตฟอร์มซื้อ-ขายสินค้ามือสอง</title>
    @vite(['resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', 'Prompt', sans-serif;
        }

        .search-container {
            font-family: 'Noto Sans Thai', 'Prompt', sans-serif;
            padding: 20px;
            text-align: center;
            margin-bottom: 14px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .search-box {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: none;
        }

        .search-box:focus {
            outline: none;
            border-color: orange;
        }

        .banner {
            text-align: center;
            padding: 50px;
            font-size: 24px;
            font-weight: bold;
            color: #666;
        }

        .ad-container {
            background-image: url('kaiklong.png');
            margin-bottom: 14px;
            height: 350px;
            background-position: center;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #FF8C00;
        }

        .detail-product {
            color: gray;
            font-size: 12px;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
        }

        .product-container a {
            text-decoration: none;
            color: #666;
        }

        .product-container a:hover {
            color: #FF8C00;
        }

        .product {
            text-align: center;
            width: 120px;
            color: #666;
        }

        .product img {
            width: 100px;
            height: 80px;
            display: block;
            margin: 0 auto 10px;
        }

        .highlight {
            font-size: 24px;
            color: #FF8C00;
            font-weight: bold;
            text-align: left;
            padding: 20px;
            margin-top: -50px;
        }

        .product-type {
            font-size: 16px;
            color: #000000;
            font-weight: bold;
            text-align: left;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
            width: 100%;
        }

        .product-type p {
            width: calc(20% - 10px);
            text-align: center;
        }

        .product-type a {
            text-decoration: none;
            color: rgb(39, 39, 39);
        }

        .product-type a:hover {
            color: #FF8C00;
        }

        .title2 {
            font-size: 24px;
            color: #FF8C00;
            font-weight: bold;
            text-align: left;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            margin-bottom: -35px;
            margin-top: -20px;
        }

        #card-product {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            loading: lazy;
        }

        .product-details {
            padding: 15px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 1.2rem;
            color: #e65100;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .btn_detail {
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

        .btn_detail a {
            color: #FF8C00;
            text-decoration: none;
        }

        .btn_detail:hover {
            background-color: #FF8C00;
            color: white;
        }

        .btn_detail:hover a {
            color: white;
        }

        .card-btn {
            color: white;
            padding: 4px;
            transition: background-color 0.3s ease;
        }

        .flex-search {
            background-color: white;
            width: 50%;
            border-radius: 14px;
            border: 1px solid #FF8C00;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px;
        }

        .search-btn {
            border: none;
            background-color: white;
        }

        @media (max-width: 480px) {
            .flex-search {
                width: 100%;
            }

            #card-product {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
                padding: 15px 0;
            }

            .product-image {
                height: 180px;
            }

            .product-title {
                font-size: 1rem;
            }

            .product-price {
                font-size: 1.1rem;
            }

            .product-description {
                font-size: 0.85rem;
            }

            .product-container {
                display: grid;
                grid-template-columns: repeat(120px, 1fr);
                gap: 20px;
                justify-items: center;
                align-items: center;
            }

            .product img {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 10px;
                display: block;
                margin: 0 auto;
            }
        }

        @media (min-width: 486px) {
            .flex-search {
                width: 100%;
            }

            #card-product {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .product-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
        }

        @media (min-width: 768px) {
            .flex-search {
                width: 100%;
            }

            #card-product {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .product-container {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 15px;
            }
        }

        @media (min-width: 1200px) {
            .flex-search {
                width: 100%;
            }

            #card-product {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 15px;
            }

            .product-container {
                display: grid;
                grid-template-columns: repeat(8, 1fr);
                gap: 15px;
            }
        }

        .title2 a {
            color: #666;
            text-decoration: none;
            font-size: 1rem;
        }
        .title2 a:hover {
            color: #666;
            text-decoration: underline;
        }
    </style>
</head>

@extends('layouts.page')
@section('content')

<body style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif;">
    <div style="background-color: #FFE5CC">
        <div class="search-container container">
            <div class="flex-search">
                <input type="text" class="search-box" placeholder="คุณกำลังมองหาอะไรอยู่?">
                <button class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="32" height="32" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="ad-container"></div>
        <div class="title">
            <p>รวมสินค้าที่ดี มีคุณภาพ ครบครันและหลากหลายที่สุดของประเทศ</p>
        </div>
        <div class="product-container"></div>
        <div class="highlight">
            <p>หาง่ายขึ้น! เลือกเลย!!!</p>
            <div class="product-type"></div>
        </div>
        <div class="title2">
            <p>การประกาศขายล่าสุด</p>
            <a href="product-all">ดูทั้งหมด ></a>
        </div>
        <div id="card-product"></div>

        @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "🎉 สำเร็จ!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "ตกลง"
                });
            });
        </script>
        @endif

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                fetch("/api/product")
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        const productsContainer = document.getElementById("card-product");
                        if (!productsContainer) {
                            console.error("ไม่พบ element ที่มี id 'card-product'");
                            return;
                        }

                        const latestProducts = data.products.sort((a, b) => new Date(b.created_at) - new Date(a.created_at)).slice(0, 4);

                        let productCards = "";
                        latestProducts.forEach(product => {
                            const imagePath = (product.product_images && product.product_images.length > 0) ? `/${product.product_images[0].image_path}` : '/path/to/placeholder.jpg';

                            productCards += `
                                <div class="product-card">
                                    <img class="product-image" src="${imagePath}" alt="${product.product_name}" loading="lazy" />
                                    <div class="product-details">
                                        <b class="product-title">${product.product_name} <br /></b>
                                        <span class="product-price">${new Intl.NumberFormat().format(product.product_price)}</span> <br />
                                        <span class="product-description">${product.product_location}</span>
                                    </div>
                                    <div class="card-btn">
                                        <button class="btn_detail" onclick="gotoDetail(${product.product_id})">ดูสินค้า</button>
                                    </div>
                                </div>
                            `;
                        });
                        productsContainer.innerHTML = productCards;
                    })
                    .catch(error => console.error("Error fetching products:", error));
            });

            function gotoDetail(id) {
                window.location.href = `/product-detail/${id}`;
            }

            document.addEventListener("DOMContentLoaded", function() {
                const searchBox = document.querySelector(".search-box");
                const urlParams = new URLSearchParams(window.location.search);
                const searchQuery = urlParams.get("q") || "";

                if (searchQuery) {
                    searchBox.value = searchQuery;
                }

                searchBox.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        const searchValue = searchBox.value.trim();
                        if (searchValue != "") {
                            window.location.href = `/product-all?q=${encodeURIComponent(searchValue)}`;
                            fetch(`/get24productsearch?q=${encodeURIComponent(searchValue)}`)
                                .then(response => response.json())
                                .then(data => {
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
            });

            fetch('/api/categories', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    credentials: 'include'
                })
                .then(response => response.json())
                .then(data => {
                    const container = document.querySelector('.product-container');
                    console.log(data.categories);
                    data = data.categories;

                    data.forEach(category => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product');

                        const link = document.createElement('a');
                        link.href = `/product-all?q=${category.category_name}`;

                        link.addEventListener('click', (event) => {
                            event.preventDefault();
                            window.location.href = link.href;
                        });

                        const img = document.createElement('img');
                        img.src = category.category_pic_path;
                        img.alt = category.category_name;
                        img.style.width = "100px";
                        img.style.height = "100px";
                        img.style.objectFit = "contain";
                        img.style.borderRadius = "10px";

                        const p = document.createElement('p');
                        p.textContent = category.category_name;
                        p.style.textAlign = "center";

                        link.appendChild(img);
                        link.appendChild(p);
                        productDiv.appendChild(link);
                        container.appendChild(productDiv);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));

            async function fetchFirstTenTypes() {
                try {
                    const response = await fetch("/api/types/first-ten");
                    const data = await response.json();

                    const container = document.querySelector('.product-type');
                    if (!container) return;

                    let typeLinks = data.map(type =>
                        `<p>
                            <a href="/product-all?q=${type.type_name}">
                                ${type.type_name}
                            </a>
                        </p>`
                    ).join('');

                    container.innerHTML = typeLinks;

                } catch (error) {
                    console.error("เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
                    document.getElementById("product-name").innerText = "โหลดข้อมูลล้มเหลว";
                }
            }

            document.addEventListener("DOMContentLoaded", fetchFirstTenTypes);
        </script>
    </div>
</body>
@endsection

</html>