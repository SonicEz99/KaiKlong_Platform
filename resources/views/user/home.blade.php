<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .search-container {
            background-color: #FFE5CC;
            padding: 20px;
            text-align: center;
            margin-bottom: 14px
        }

        .search-box {
            width: 60%;
            padding: 10px;
            border: 1px solid #FF8C00;
            border-radius: 5px;
            font-size: 16px;
        }

        .banner {
            text-align: center;
            padding: 50px;
            font-size: 24px;
            font-weight: bold;
            color: #666;
        }

        .ad-container {
            background-color: #DCDCDC;
            padding: 50px;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #FF8C00;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .product {
            text-align: center;
            margin: 10px;
            width: 150px;
        }

        .product img {
            width: 100px;
            height: 100px;
            display: block;
            margin: 0 auto 10px;
        }

        .highlight {
            color: #FF8C00;
            font-weight: bold;
            text-align: left;
            padding: 20px;
        }

        .product-type {
            color: #000000;
            font-weight: bold;
            text-align: left;
        }

        .title2 {
            color: #FF8C00;
            font-weight: bold;
            text-align: left;
            padding: 20px;
        }

        .card-product {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
            justify-content: center;

            && .card {
                background-color: #fff;
                border-radius: 14px;
                padding: 5px;
                text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);


                && .image-item {
                    border-radius: 10px;
                }

                && .text-detail {
                    text-align: left;
                    padding: 14px;
                }
            }

            && .card-btn {
                color: white;
                padding: 4px
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
        }

        @media (max-width: 480px) {
            .search-box {
                width: 90%;
            }

            .product-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
    </head>

    <body>
        <div style="background-color: white">
            <div class="search-container">
                <input type="text" class="search-box" placeholder="คุณกำลังมองหาอะไรอยู่?">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="32" height="32" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>              
            </div>
        </div>

        <div class="container">

            <div class="ad-container">
                <h2>พื้นที่โฆษณา</h2>
                <p>โฆษณาสินค้าของคุณที่นี่! ติดต่อเราสำหรับรายละเอียดเพิ่มเติม</p>
            </div>

            <div class="title">
                <p>รวมสินค้าที่ดี มีคุณภาพ ครบครันและหลากหลายที่สุดของประเทศ</p>
            </div>

            <div class="product-container">
                <div class="product">
                    <img width="300" height="300"
                        src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg" alt="รถมือสอง">
                    <p>รถมือสอง</p>
                </div>
                <div class="product">
                    <img width="300" height="300"
                        src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg" alt="รถมือสอง">
                    <p>รถมือสอง</p>
                </div>
                <div class="product">
                    <img width="300" height="300"
                        src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg" alt="รถมือสอง">
                    <p>รถมือสอง</p>
                </div>
                <div class="product">
                    <img width="300" height="300"
                        src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg" alt="รถมือสอง">
                    <p>รถมือสอง</p>
                </div>
                <div class="product">
                    <img width="300" height="300"
                        src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg" alt="รถมือสอง">
                    <p>รถมือสอง</p>
                </div>
            </div>

            <div class="highlight">
                <p>หาง่ายขึ้น! เลือกเลย!!!</p>
                <div class="product-type">
                    <p>นาฬิกา <span class="count">(20)</span></p>
                </div>
            </div>

            <div class="title2">
                <p>การประกาศขายล่าสุด</p>
            </div>

            <div class="card-product">
                <div class="card">
                    <img class="image-item" src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg"
                        alt="รถมือสอง">
                    <div class="text-detail">
                        <b style="color:rgb(81, 81, 81)">รถมือสอง <br> บุรีรัมย์ <br> 980,980</b>
                    </div>
                    <div class="card-btn">
                        <button class="btn_detail">ดูสินค้า</button>
                    </div>
                </div>
                <div class="card">
                    <img class="image-item" src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg"
                        alt="รถมือสอง">
                    <div class="text-detail">
                        <b style="color:rgb(81, 81, 81)">รถมือสอง <br> บุรีรัมย์ <br> 980,980</b>
                    </div>
                    <div class="card-btn">
                        <button class="btn_detail">ดูสินค้า</button>
                    </div>
                </div>
                <div class="card">
                    <img class="image-item" src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg"
                        alt="รถมือสอง">
                    <div class="text-detail">
                        <b style="color:rgb(81, 81, 81)">รถมือสอง <br> บุรีรัมย์ <br> 980,980</b>
                    </div>
                    <div class="card-btn">
                        <button class="btn_detail">ดูสินค้า</button>
                    </div>
                </div>
                <div class="card">
                    <img class="image-item" src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg"
                        alt="รถมือสอง">
                    <div class="text-detail">
                        <b style="color:rgb(81, 81, 81)">รถมือสอง <br> บุรีรัมย์ <br> 980,980</b>
                    </div>
                    <div class="card-btn">
                        <button class="btn_detail">ดูสินค้า</button>
                    </div>
                </div>
                <div class="card">
                    <img class="image-item" src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg"
                        alt="รถมือสอง">
                    <div class="text-detail">
                        <b style="color:rgb(81, 81, 81)">รถมือสอง <br> บุรีรัมย์ <br> 980,980</b>
                    </div>
                    <div class="card-btn">
                        <button class="btn_detail">ดูสินค้า</button>
                    </div>
                </div>
                <div class="card">
                    <img class="image-item" src="https://media.cdn-jaguarlandrover.com/api/v2/images/55880/w/680.jpg"
                        alt="รถมือสอง">
                    <div class="text-detail">
                        <b style="color:rgb(81, 81, 81)">รถมือสอง <br> บุรีรัมย์ <br> 980,980</b>
                    </div>
                    <div class="card-btn">
                        <button class="btn_detail">ดูสินค้า</button>
                    </div>
                </div>
            </div>


        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
    </script>

</html>
