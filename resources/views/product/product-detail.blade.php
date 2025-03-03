<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายละเอียดสินค้า</title>
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .product-card {
            display: flex;
            gap: 20px;
            padding: 20px;
            border-radius: 8px;
            flex-wrap: wrap;
            margin-bottom: 80px;
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

        /* ปรับสไตล์ image-gallery สำหรับเลื่อนภาพ */
        .image-gallery {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            overflow-x: auto;
            scroll-behavior: smooth;
            position: relative;
            padding-bottom: 10px;
            cursor: pointer;
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

        .product-price {
            font-size: 40px;
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
            height: 40px;
            background-color: #FB8C00;
            color: #ffffff;
            border: 2px solid #FB8C00;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-chat:hover {
            background-color: #ffffff;
            color: #FB8C00;
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
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 90px;
            background-color: #ECECEC;
            border-radius: 4px;
        }

        .seller-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
        }

        .seller-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .seller-name {
            color: #000000;
        }

        .btn-call,
        .btn-view-products {
            width: 120px;
            padding: 8px;
            text-align: center;
            border: 2px solid #FB8C00;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #000000;
            margin-right: 10px;
        }

        .btn-call:hover {
            background-color: #FB8C00;
            color: #ffffff;
            stroke: #ffffff;
        }

        .btn-view-products:hover {
            background-color: #FB8C00;
            color: #ffffff;
            stroke: #ffffff;
        }

        .seller-contact {
            margin-left: auto;
        }

        /* กำหนด container เพื่อรองรับการซูม */
        .product-image-container {
            position: relative;
            overflow: hidden;
            width: 400px;
            height: 400px;
        }

        /* กำหนดให้รูปภาพซูมได้ */
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s ease-in-out;
            cursor: zoom-in;
        }

        svg {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        .switch-btn {
            background: #fff7ee;
            border: none;
            color: white;
            font-size: 18px;
            padding: 5px 10px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 50;
        }

        #prev-btn {
            left: -20px;
            opacity: 0;
            height: 800px;
            width: 100px;
        }

        #next-btn {
            right: -20px;
            opacity: 0;
            height: 800px;
            width: 100px;
        }

        .product-image-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-share {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .btn-share svg {
            width: 35px;
            height: 35px;
        }

        .btn-share:hover svg {
            fill: #FF8C00;
        }

        .btn-favorite {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            margin-left: auto;
            padding-bottom: 7px;
        }

        .btn-favorite svg {
            width: 35px;
            height: 35px;
        }

        .btn-favorite.active svg {
            fill: #FF8C00;
        }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

@extends('layouts.page')
@section('content')

    <body style="font-family: 'Prompt', sans-serif;">
        <div class="container">
            <div id="product-detail">
                <div class="loading-text">กำลังโหลด...</div>
            </div>
        </div>

        <script>
            let id_customer = <?php echo auth()->id(); ?>
            
            function favorites(id_product) {
                console.log("Product : ", id_product, "Customer : ", id_customer);

                fetch(`/api/addFavorite`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            user_id: id_customer,
                            product_id: id_product
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Response:", data);
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            }

            function chatSale(id_saler) {
                console.log(id_saler, id_customer);
                window.location.href = `chatsale/${id_saler}/${id_customer}`
            }


            document.addEventListener('DOMContentLoaded', function() {
                const urlParts = window.location.pathname.split('/');
                const productId = urlParts[urlParts.length - 1];
                console.log("Fetching product with ID:", productId);

                fetch(`/api/product/${productId}`)
                    .then(response => response.json())
                    .then(product => {
                        console.log("Product data received");
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

                        let images = product.product_images?.map(img => `/${img.image_path}`) || [
                            '/path/to/placeholder.jpg'
                        ];
                        let currentImageIndex = 0;

                        productDetailContainer.innerHTML = `
                        <div class="product-card">
                            <div class="image-add">
                                <div class="product-image-container">
                                    <button id="prev-btn" class="switch-btn">⭠</button>
                                    <img class="product-image" src="${imagePath}" alt="${product.product_name}"
                                        loading="lazy" onerror="this.src='/path/to/placeholder.jpg'">
                                    <button id="next-btn" class="switch-btn">⭢</button>
                                </div>

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
                                <div class="product-title">
                                    {{ $product->product_name }}

                                    <button class="btn-favorite" onClick="favorites(${product.product_id})">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="#FB8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </button>

                                    <button class="btn-share" onclick="shareProduct()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FB8C00" viewBox="0 0 30 30" width="40" height="40">
                                            <path d="M18 16.08C17.24 16.08 16.56 16.38 16.05 16.88L8.91 12.7C8.96 12.47 9 12.24 9 12C9 11.76 8.96 11.53 8.91 11.3L15.96 7.22C16.5 7.72 17.22 8 18 8C19.66 8 21 6.66 21 5C21 3.34 19.66 2 18 2C16.34 2 15 3.34 15 5C15 5.24 15.04 5.47 15.09 5.7L8.04 9.78C7.5 9.28 6.78 9 6 9C4.34 9 3 10.34 3 12C3 13.66 4.34 15 6 15C6.78 15 7.5 14.72 8.04 14.22L15.18 18.4C15.13 18.63 15.09 18.86 15.09 19.1C15.09 20.76 16.43 22.1 18.09 22.1C19.75 22.1 21.09 20.76 21.09 19.1C21.09 17.44 19.75 16.1 18.09 16.1Z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="product-price">${new Intl.NumberFormat().format(product.product_price)} บาท</div>
                                <div class="product-seller">
                                    <strong>ลงขายโดย</strong> <span class="seller-name" style="color: #FF8C00;
                                                                font-size: 22px;">${product.user?.user_name || 'ไม่ระบุ'}</span>
                                </div>

                                <button class="btn-chat" onClick="chatSale(${product.user_id})">คุยกับผู้ขาย</button>

                                ${productFeature}

                                <!-- รายละเอียดสินค้า -->
                                <div class="product-description">
                                    <div class="feature-title">รายละเอียดสินค้า</div>
                                    <p id="product-details">${product.product_description || "ไม่มีรายละเอียดสินค้า"}</p>
                                </div>

                                <!-- ข้อมูลผู้ขาย -->
                                <div class="seller-card">
                                    <img class="seller-image" src="${product.user?.user_pic ?? "https://cdn-icons-png.flaticon.com/512/9203/9203764.png"}"
                                        alt="${product.user?.user_name}" loading="lazy">

                                    <div class="seller-info">
                                        <div class="seller-name">${product.user?.user_name || 'ไม่ระบุ'}</div>
                                    </div>

                                    <div class="seller-contact">
                                        <a class="btn-call" href="tel:${product.user?.phone || '#'}"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.1007 13.359L15.5719 12.8272H15.5719L16.1007 13.359ZM16.5562 12.9062L17.085 13.438H17.085L16.5562 12.9062ZM18.9728 12.5894L18.6146 13.2483L18.9728 12.5894ZM20.8833 13.628L20.5251 14.2869L20.8833 13.628ZM21.4217 16.883L21.9505 17.4148L21.4217 16.883ZM20.0011 18.2954L19.4723 17.7636L20.0011 18.2954ZM18.6763 18.9651L18.7459 19.7119H18.7459L18.6763 18.9651ZM8.81536 14.7266L9.34418 14.1947L8.81536 14.7266ZM4.00289 5.74561L3.2541 5.78816L3.2541 5.78816L4.00289 5.74561ZM10.4775 7.19738L11.0063 7.72922H11.0063L10.4775 7.19738ZM10.6342 4.54348L11.2346 4.09401L10.6342 4.54348ZM9.37326 2.85908L8.77286 3.30855V3.30855L9.37326 2.85908ZM6.26145 2.57483L6.79027 3.10667H6.79027L6.26145 2.57483ZM4.69185 4.13552L4.16303 3.60368H4.16303L4.69185 4.13552ZM12.0631 11.4972L12.5919 10.9654L12.0631 11.4972ZM16.6295 13.8909L17.085 13.438L16.0273 12.3743L15.5719 12.8272L16.6295 13.8909ZM18.6146 13.2483L20.5251 14.2869L21.2415 12.9691L19.331 11.9305L18.6146 13.2483ZM20.8929 16.3511L19.4723 17.7636L20.5299 18.8273L21.9505 17.4148L20.8929 16.3511ZM18.6067 18.2184C17.1568 18.3535 13.4056 18.2331 9.34418 14.1947L8.28654 15.2584C12.7186 19.6653 16.9369 19.8805 18.7459 19.7119L18.6067 18.2184ZM9.34418 14.1947C5.4728 10.3453 4.83151 7.10765 4.75168 5.70305L3.2541 5.78816C3.35456 7.55599 4.14863 11.144 8.28654 15.2584L9.34418 14.1947ZM10.7195 8.01441L11.0063 7.72922L9.9487 6.66555L9.66189 6.95073L10.7195 8.01441ZM11.2346 4.09401L9.97365 2.40961L8.77286 3.30855L10.0338 4.99296L11.2346 4.09401ZM5.73263 2.04299L4.16303 3.60368L5.22067 4.66736L6.79027 3.10667L5.73263 2.04299ZM10.1907 7.48257C9.66189 6.95073 9.66117 6.95144 9.66045 6.95216C9.66021 6.9524 9.65949 6.95313 9.659 6.95362C9.65802 6.95461 9.65702 6.95561 9.65601 6.95664C9.65398 6.95871 9.65188 6.96086 9.64972 6.9631C9.64539 6.96759 9.64081 6.97245 9.63599 6.97769C9.62634 6.98816 9.61575 7.00014 9.60441 7.01367C9.58174 7.04072 9.55605 7.07403 9.52905 7.11388C9.47492 7.19377 9.41594 7.2994 9.36589 7.43224C9.26376 7.70329 9.20901 8.0606 9.27765 8.50305C9.41189 9.36833 10.0078 10.5113 11.5343 12.0291L12.5919 10.9654C11.1634 9.54499 10.8231 8.68059 10.7599 8.27309C10.7298 8.07916 10.761 7.98371 10.7696 7.96111C10.7748 7.94713 10.7773 7.9457 10.7709 7.95525C10.7677 7.95992 10.7624 7.96723 10.7541 7.97708C10.75 7.98201 10.7451 7.98759 10.7394 7.99381C10.7365 7.99692 10.7335 8.00019 10.7301 8.00362C10.7285 8.00534 10.7268 8.00709 10.725 8.00889C10.7241 8.00979 10.7232 8.0107 10.7223 8.01162C10.7219 8.01208 10.7212 8.01278 10.7209 8.01301C10.7202 8.01371 10.7195 8.01441 10.1907 7.48257ZM11.5343 12.0291C13.0613 13.5474 14.2096 14.1383 15.0763 14.2713C15.5192 14.3392 15.8763 14.285 16.1472 14.1841C16.28 14.1346 16.3858 14.0763 16.4658 14.0227C16.5058 13.9959 16.5392 13.9704 16.5663 13.9479C16.5799 13.9367 16.5919 13.9262 16.6024 13.9166C16.6077 13.9118 16.6126 13.9073 16.6171 13.903C16.6194 13.9008 16.6215 13.8987 16.6236 13.8967C16.6246 13.8957 16.6256 13.8947 16.6266 13.8937C16.6271 13.8932 16.6279 13.8925 16.6281 13.8923C16.6288 13.8916 16.6295 13.8909 16.1007 13.359C15.5719 12.8272 15.5726 12.8265 15.5733 12.8258C15.5735 12.8256 15.5742 12.8249 15.5747 12.8244C15.5756 12.8235 15.5765 12.8226 15.5774 12.8217C15.5793 12.82 15.581 12.8183 15.5827 12.8166C15.5862 12.8133 15.5895 12.8103 15.5926 12.8074C15.5988 12.8018 15.6044 12.7969 15.6094 12.7929C15.6192 12.7847 15.6265 12.7795 15.631 12.7764C15.6403 12.7702 15.6384 12.773 15.6236 12.7785C15.5991 12.7876 15.501 12.8189 15.3038 12.7886C14.8905 12.7253 14.02 12.3853 12.5919 10.9654L11.5343 12.0291ZM9.97365 2.40961C8.95434 1.04802 6.94996 0.83257 5.73263 2.04299L6.79027 3.10667C7.32195 2.578 8.26623 2.63181 8.77286 3.30855L9.97365 2.40961ZM4.75168 5.70305C4.73201 5.35694 4.89075 4.9954 5.22067 4.66736L4.16303 3.60368C3.62571 4.13795 3.20329 4.89425 3.2541 5.78816L4.75168 5.70305ZM19.4723 17.7636C19.1975 18.0369 18.9029 18.1908 18.6067 18.2184L18.7459 19.7119C19.4805 19.6434 20.0824 19.2723 20.5299 18.8273L19.4723 17.7636ZM11.0063 7.72922C11.9908 6.7503 12.064 5.2019 11.2346 4.09401L10.0338 4.99295C10.4373 5.53193 10.3773 6.23938 9.9487 6.66555L11.0063 7.72922ZM20.5251 14.2869C21.3429 14.7315 21.4703 15.7769 20.8929 16.3511L21.9505 17.4148C23.2908 16.0821 22.8775 13.8584 21.2415 12.9691L20.5251 14.2869ZM17.085 13.438C17.469 13.0562 18.0871 12.9616 18.6146 13.2483L19.331 11.9305C18.2474 11.3414 16.9026 11.5041 16.0273 12.3743L17.085 13.438Z" fill="#ff8652"></path> </g></svg>โทร</a>
                                        <a class="btn-view-products" href="/product-listing/${product.user?.id || ''}"><svg xmlns="http://www.w3.org/2000/svg" fill="#FB8C00" viewBox="0 0 24 24"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 4H6v-4h6v4z"></path></g></svg>ดูสินค้าทั้งหมด</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;


                        // เพิ่มฟังก์ชันคลิกที่ภาพเพิ่มเติมเพื่อเปลี่ยนภาพหลัก
                        const productImage = document.querySelector('.product-image'); // รูปหลัก
                        const imageGallery = document.querySelector('.image-gallery'); // container ของภาพเพิ่มเติม
                        const additionalImages = document.querySelectorAll(
                            '.additional-image'); // รูปเพิ่มเติมทั้งหมด

                        const prevBtn = document.getElementById('prev-btn');
                        const nextBtn = document.getElementById('next-btn');

                        // Previous image
                        prevBtn.addEventListener('click', function() {
                            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                            productImage.src = images[currentImageIndex];
                        });

                        // Next image
                        nextBtn.addEventListener('click', function() {
                            currentImageIndex = (currentImageIndex + 1) % images.length;
                            productImage.src = images[currentImageIndex];
                        });

                        // Click on additional images to switch main image
                        document.querySelectorAll('.additional-image').forEach((img, index) => {
                            img.addEventListener('click', function() {
                                currentImageIndex = index + 1;
                                productImage.src = images[currentImageIndex];
                            });
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching product detail:", error);
                        document.getElementById('product-detail').innerHTML =
                            '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';


                        additionalImages.forEach(img => {
                            img.addEventListener('click', function() {
                                productImage.src = img.src - 1;
                            });
                        });

                        // ฟังก์ชันเลื่อนภาพซ้าย-ขวา
                        function scrollGallery(direction) {
                            const scrollAmount = 100; // จำนวนพิกเซลที่เลื่อน
                            imageGallery.scrollBy({
                                left: direction * scrollAmount,
                                behavior: 'smooth'
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching product detail:", error);
                        document.getElementById('product-detail').innerHTML =
                            '<p style="text-align:center;padding:20px;color:#666;">เกิดข้อผิดพลาดในการโหลดข้อมูลสินค้า</p>';
                    });


            });
            setTimeout(() => {
                const productImage = document.querySelector('.product-image');
                const productContainer = document.querySelector('.product-image-container');
                if (productImage && productContainer) {

                    productContainer.addEventListener('mousemove', function(e) {
                        const rect = productContainer.getBoundingClientRect();
                        const x = ((e.clientX - rect.left) / rect.width) * 100;
                        const y = ((e.clientY - rect.top) / rect.height) * 100;

                        productImage.style.transformOrigin = `${x}% ${y}%`;
                        productImage.style.transform = 'scale(2)';
                    });

                    productContainer.addEventListener('mouseleave', function() {
                        productImage.style.transform = 'scale(1)';
                    });
                } else {
                    console.log("Image or container not found again!");
                }
            }, 2000); // รอ 2 วินาทีให้ DOM โหลดก่อน
            function shareProduct() {
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'คัดลอกลิงก์เสร็จสิ้น',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                });
            }

            function toggleFavorite() {
                const favoriteButton = document.querySelector('.btn-favorite');
                const isActive = favoriteButton.classList.toggle('active');
                Swal.fire({
                    icon: isActive ? 'success' : 'info',
                    title: isActive ? 'เพิ่มสินค้าไปยังรายการโปรดแล้ว' : 'นำสินค้าออกจากรายการโปรดแล้ว',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>
    </body>
@endsection

</html>
