<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงขายสินค้า</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        option:disabled {
            color: gray !important;
        }

        .btn-orange {
            background-color: #FF8C00;
            border: 2px solid #FF8C00;
            color: white;
            border-radius: 8px;
        }

        .btn-orange:hover {
            background-color: #FFA500;
            border: 2px solid #FFA500;
            color: white;
        }

        .bg-orange {
            background-color: #FF8C00 !important;
        }

        .form-dropdown {
            position: relative;
            width: 100%;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
            transition: border-color 0.3s ease;
        }

        select:focus {
            border-color: #007bff;
            outline: none;
        }

        option {
            padding: 10px;
        }

        body,
        .navbar,
        footer,
        * {
            font-family: 'Noto Sans Thai', 'Prompt', sans-serif !important;
        }

        .image-upload-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .upload-button-container {
            display: flex;
            align-items: center;
        }

        .upload-button {
            width: 150px;
            height: 150px;
            border: 2px dashed #FF8C00;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #FF8C00;
            transition: all 0.3s ease;
        }

        .upload-button:hover {
            background-color: #FFF5E6;
        }

        .upload-button i {
            font-size: 24px;
            margin-bottom: 8px;
        }
    </style>
</head>

@extends('layouts.page')
@section('content')
    <div class="container px-4 mt-2" style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif; padding-top: 5px;">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <!-- ชื่อสินค้า -->
                            <div class="mb-3">
                                <label for="product_name" class="form-label">ชื่อสินค้า <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกชื่อสินค้า
                                </div>
                            </div>
                            <!-- รายละเอียดสินค้า -->
                            <div class="mb-3">
                                <label for="product_description" class="form-label">รายละเอียดสินค้า <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="product_description" name="product_description" required></textarea>
                                <div class="invalid-feedback">
                                    กรุณากรอกรายละเอียดสินค้า
                                </div>
                            </div>
                            <!-- ราคา -->
                            <div class="mb-3">
                                <label for="product_price" class="form-label">ราคา <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="product_price" name="product_price" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกราคา
                                </div>
                            </div>
                            <!-- สภาพสินค้า -->
                            <div class="mb-3">
                                <label for="product_condition" class="form-label">สภาพสินค้า <span
                                        class="text-danger">*</span></label>

                                <select name="product_condition" id="product_condition" class="form-control" required>
                                    <option selected hidden>เลือกสภาพสินค้าที่คุณจะขาย</option>
                                    <option value="มือหนึ่ง">มือหนึ่ง</option>
                                    <option value="มือสอง">มือสอง</option>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณากรอกสภาพสินค้า
                                </div>
                            </div>
                            <!-- ที่อยู่สินค้า -->
                            <div class="mb-3">
                                <label for="product_location" class="form-label">ที่อยู่สินค้า <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product_location" name="product_location"
                                    required>
                                <div class="invalid-feedback">
                                    กรุณากรอกที่อยู่สินค้า
                                </div>
                            </div>
                            <!-- เบอร์โทรศัพท์ -->
                            <?php
                            $user = auth()->user();
                            ?>
                            <div class="mb-3">
                                <label for="product_phone" class="form-label">เบอร์โทรศัพท์ <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product_phone" name="product_phone" required
                                    maxlength="12" placeholder="099-999-9999" value="{{ $user->tel }}">
                                <div class="invalid-feedback">
                                    กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง (10 หลัก)
                                </div>
                            </div>
                            <!-- Replace the existing image upload section with this -->
                            <div class="mb-3">
                                <label class="form-label">รูปภาพสินค้า (สูงสุด 5 รูป)</label>
                                <div class="image-upload-container">
                                    <div class="preview-container" id="imagePreview"></div>
                                    <div class="upload-button-container">
                                        <label for="image_path" class="upload-button">
                                            <i class="fas fa-plus"></i>
                                            <span>เพิ่มรูปภาพ</span>
                                            <input type="file" class="form-control" id="image_path" name="image_path[]"
                                                accept="image/*" multiple style="display: none;">
                                        </label>
                                    </div>
                                </div>
                                <small class="text-muted">คลิกที่ปุ่มเพื่อเพิ่มรูปภาพ (รองรับ .jpg, .jpeg, .png)</small>
                                <div class="invalid-feedback">
                                    กรุณาอัพโหลดรูปภาพที่ถูกต้อง
                                </div>
                            </div>
                            <!-- หมวดหมู่ -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">หมวดหมู่ <span
                                        class="text-danger">*</span></label>
                                <select id="categoryDropdown" name="category_id" onchange="handleCategoryChange()"
                                    required>
                                    <option value="">เลือกหมวดหมู่</option>
                                    <!-- Categories will be populated here -->
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกหมวดหมู่
                                </div>
                            </div>
                            <!-- ประเภท -->
                            <div class="mb-3">
                                <label for="type_id" class="form-label">ประเภท</label>
                                <select id="typeDropdown" name="type_id" disabled>
                                    <option value="">เลือกประเภทของสินค้า</option>
                                    <!-- Brands will be populated here -->
                                </select>
                            </div>
                            <!-- แบรนด์ -->
                            <div class="mb-3">
                                <label for="brand_id" class="form-label">แบรนด์</label>
                                <select id="brandDropdown" name="brand_id" disabled>
                                    <option value="">เลือกแบรนด์ของสินค้า</option>
                                    <!-- Brands will be populated here -->
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn-orange btn-lg">ลงขายสินค้า</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $user = Auth::user(); ?>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            let userId = <?php echo json_encode($user->id); ?>;
            console.log(userId);
            const categoryDropdown = document.getElementById('categoryDropdown');
            const brandDropdown = document.getElementById('brandDropdown');
            const typeDropdown = document.getElementById('typeDropdown');

            let categoryData = {}; // Cache category data

            if (categoryDropdown && brandDropdown) {
                try {
                    const response = await fetch('/api/categoriesBrandAndType');
                    categoryData = await response.json();

                    if (categoryData.categories) {
                        categoryDropdown.innerHTML = '<option value="">เลือกหมวดหมู่</option>' +
                            categoryData.categories.map(category =>
                                `<option value="${category.category_id}">${category.category_name}</option>`
                            ).join('');
                    }
                } catch (error) {
                    console.error('Error fetching categories:', error);
                }

                categoryDropdown.addEventListener('change', handleCategoryChange);
            }

            function handleCategoryChange() {
                const selectedCategoryId = categoryDropdown.value;
                const category = categoryData.categories.find(cat => cat.category_id == selectedCategoryId);

                if (!category) return;

                brandDropdown.innerHTML = '';
                typeDropdown.innerHTML = '';

                if (selectedCategoryId === '1' || selectedCategoryId === '2') {
                    brandDropdown.disabled = false;
                    typeDropdown.disabled = true;
                    brandDropdown.innerHTML = '<option value="">กำลังเลือกเเบรนด์สินค้า</option>' +
                        (category.brands?.map(brand =>
                            `<option value="${brand.brand_id}">${brand.brand_name}</option>`
                        ).join('') || '');
                } else {
                    typeDropdown.disabled = false;
                    brandDropdown.disabled = true;
                    typeDropdown.innerHTML = '<option value="">กำลังเลือกประเภทสินค้า</option>' +
                        (category.types?.map(type =>
                            `<option value="${type.type_id}">${type.type_name}</option>`
                        ).join('') || '');
                }
            }
        });

        // Form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Preview images before upload
        document.getElementById('image_path').addEventListener('change', function(e) {
            if (this.files.length > 5) {
                alert('คุณสามารถอัพโหลดรูปได้สูงสุด 5 รูปเท่านั้น');
                this.value = '';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            let userId = <?php echo json_encode($user->id); ?>;
            console.log(userId);

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

                const formData = new FormData(form);
                formData.append('user_id', userId); // Add user_id to FormData

                fetch('/api/addProduct', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json' // ✅ Forces Laravel to return JSON even on errors

                        }
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(result => {
                        if (result.status === 201) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลงขายสินค้าสำเร็จ!',
                                text: 'กำลังเปลี่ยนหน้า...',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = '/home';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'กรุณากรอกข้อมูลให้ครบ'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาดในการลงขายสินค้า',
                            text: 'กรุณาลองใหม่'
                        });
                    });
            });
        });

        // ตรวจสอบความถูกต้องของเบอร์โทรศัพท์เมื่อกด Submit
        document.addEventListener("DOMContentLoaded", function() {
            const phoneInput = document.getElementById("product_phone");

            if (phoneInput) { // ตรวจสอบว่า input มีอยู่จริง
                phoneInput.addEventListener("input", function(e) {
                    let value = e.target.value.replace(/\D/g, ""); // ลบตัวอักษรที่ไม่ใช่ตัวเลข
                    if (value.length > 10) {
                        value = value.slice(0, 10); // จำกัดให้ไม่เกิน 10 ตัว
                    }

                    // ใส่ "-" อัตโนมัติเป็นรูปแบบ 099-999-9999
                    if (value.length > 3 && value.length <= 6) {
                        value = value.replace(/^(\d{3})(\d+)/, "$1-$2");
                    } else if (value.length > 6) {
                        value = value.replace(/^(\d{3})(\d{3})(\d+)/, "$1-$2-$3");
                    }

                    e.target.value = value; // อัปเดตค่าในช่อง input
                });

                // ตรวจสอบเบอร์โทรศัพท์ก่อนส่งฟอร์ม
                document.querySelector("form").addEventListener("submit", function(event) {
                    let phoneNumber = phoneInput.value.replace(/\D/g, ""); // เอาเฉพาะตัวเลข

                    if (phoneNumber.length !== 10) {
                        event.preventDefault();
                        phoneInput.classList.add("is-invalid"); // แสดง error
                    } else {
                        phoneInput.classList.remove("is-invalid"); // ซ่อน error ถ้ากรอกถูกต้อง
                    }
                });
            } else {
                console.error("❌ ไม่พบ input ที่มี ID 'product_phone'");
            }
        });

        // Add to existing scripts
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image_path');
            const previewContainer = document.getElementById('imagePreview');

            fileInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const existingImages = previewContainer.children.length;

                if (existingImages + files.length > 5) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ขออภัย',
                        text: 'คุณสามารถอัปโหลดได้สูงสุด 5 รูปเท่านั้น'
                    });
                    return;
                }

                files.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const previewDiv = document.createElement('div');
                            previewDiv.className = 'image-preview';
                            previewDiv.innerHTML = `
                        <img src="${event.target.result}" alt="Preview">
                        <button type="button" class="remove-btn">&times;</button>
                    `;

                            // ลบรูปภาพออกจาก preview และอัปเดต input.files
                            previewDiv.querySelector('.remove-btn').addEventListener('click',
                                function() {
                                    previewDiv.remove();

                                    // อัปเดต input.files เพื่อให้เหลือแค่ไฟล์ที่ยังไม่ได้ถูกลบ
                                    const dt = new DataTransfer();
                                    Array.from(fileInput.files).forEach((item, index) => {
                                        if (event.target.result !== URL
                                            .createObjectURL(item)) {
                                            dt.items.add(item);
                                        }
                                    });
                                    fileInput.files = dt.files;
                                });

                            previewContainer.appendChild(previewDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endsection

</html>
