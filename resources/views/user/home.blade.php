<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<style>
    body {
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .search-container {
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

    .product-container {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
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

    .title2 {
        font-size: 24px;
        color: #FF8C00;
        font-weight: bold;
        text-align: left;
        padding: 20px;
    }

    .card-product {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding-left: 20px;
        justify-content: center;
        margin-top: -20px;
    }

    .btn_detail {
        background: #fff1df;
        color: #FF8C00;
        border: 1px solid #FF8C00;
        padding: 4px 15px;
        margin-top: 10px;
        border-radius: 5px;
        width: 100%;
    }

    .card {
        background-color: #fff;
        border-radius: 14px;
        padding: 5px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .image-item {
        border-radius: 10px;
    }

    .text-detail {
        text-align: left;
        padding: 14px;
    }

    .card-btn {
        color: white;
        padding: 4px;

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

        .card-product {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            /* ทำให้ขนาดสมมาตร */
            gap: 20px;
            /* ระยะห่าง */
            justify-items: center;
            /* จัดให้อยู่ตรงกลาง */
            align-items: center;
        }

        .product img {
            width: 100px;
            /* ขนาดมาตรฐาน */
            height: 100px;
            /* ใช้ความสูงเท่ากับความกว้าง */
            object-fit: cover;
            /* ทำให้รูปภาพไม่บิดเบี้ยว */
            border-radius: 10px;
            /* เพิ่มมุมโค้งเล็กน้อย */
            display: block;
            margin: 0 auto;
        }

    }

    @media (min-width: 486px) {
        .flex-search {
            width: 100%;
        }

        .card-product {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2px;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
        }
    }

    @media (min-width: 768px) {
        .flex-search {
            width: 100%;
        }

        .card-product {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 1200px) {
        .flex-search {
            width: 100%;
        }

        .card-product {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
        }
    }
</style>


@extends('layouts.page')
@section('content')

    <body>
        <div style="background-color: #FFE5CC">
            <div class="search-container container">
                <div class="flex-search">
                    <input type="text" class="search-box" placeholder="คุณกำลังมองหาอะไรอยู่?">
                    <button class="search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" width="32" height="32" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
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

            <div class="product-container">

            </div>

            <div class="highlight">
                <p>หาง่ายขึ้น! เลือกเลย!!!</p>
                <div class="product-type">
                    <p id="product-name">กำลังโหลด...</p>
                </div>
            </div>

            <div class="title2">
                <p>การประกาศขายล่าสุด</p>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    fetch("/api/products")
                        .then(response => response.json())
                        .then(data => {
                            const productsContainer = document.getElementById("products-container");
                            data.products.forEach(product => {
                                const productCard = `
                                    <div class="card-product">
                                        <div class="card border rounded-lg shadow-md p-4">
                                            <img class="image-item w-full h-40 object-cover" src="${product.image}" alt="${product.name}" />
                                            <div class="text-detail mt-2">
                                                <b class="text-gray-700">${product.name} <br /> ${product.location} <br /> ${new Intl.NumberFormat().format(product.price)}</b>
                                            </div>
                                            <div class="card-btn mt-2">
                                                <button class="btn_detail bg-blue-500 text-white px-4 py-2 rounded-md">ดูสินค้า</button>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                productsContainer.innerHTML += productCard;
                            });
                        })
                        .catch(error => console.error("Error fetching products:", error));
                });
            </script>


        </div>
    </body>

    <script>
        document.getElementById('logout-button')?.addEventListener('click', function() {
            axios.post("{{ route('logout') }}", {}, {
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => {
                    alert(response.data.message);
                    window.location.href = response.data.redirect;
                })
                .catch(error => {
                    console.error('Logout failed:', error);
                });
        });


        // fetch api categories 
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => {
                const container = document.querySelector('.product-container');
                console.log(data.categories);
                data = data.categories;

                data.forEach(category => {
                    const productDiv = document.createElement('div');
                    productDiv.classList.add('product');

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

                    productDiv.appendChild(img);
                    productDiv.appendChild(p);
                    container.appendChild(productDiv);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        // new sale fetch
    </script>


    {{-- fecth quicksearch --}}
    <script>
        async function fetchFirstTenTypes() {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/types/first-ten");
                const data = await response.json();

                const container = document.querySelector('.product-type');
                if (!container) return; // ป้องกัน error ถ้า container ไม่เจอ

                let typeNames = data.map(type => `<p>${type.type_name}</p>`).join(''); // รวม type_name เป็น HTML
                container.innerHTML = typeNames; // อัปเดตเนื้อหาโดยไม่ลบ `<div>`

            } catch (error) {
                console.error("เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
                document.getElementById("product-name").innerText = "โหลดข้อมูลล้มเหลว";
            }
        }

        document.addEventListener("DOMContentLoaded", fetchFirstTenTypes);
    </script>
@endsection

</html>
