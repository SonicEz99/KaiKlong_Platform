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
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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

        .custom-dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown-toggle {
            width: 100%;
            padding: 10px 15px;
            background: white;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dropdown-toggle:hover {
            border-color: #FFA500;
        }

        .dropdown-toggle::after {
            content: '';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #666;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
            padding: 0;
            list-style: none;
            z-index: 1000;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 10px 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #FFF5E6;
            color: #FF8C00;
        }

        .dropdown-item:not(:last-child) {
            border-bottom: 1px solid #eee;
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

        .navbar {
            font-family: 'Noto Sans Thai', 'Prompt', sans-serif;
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

                                <select name="product_condition" id="product_condition" class="form-control" required
                                    >
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
                            <div class="mb-3">
                                <label for="product_phone" class="form-label">เบอร์โทรศัพท์ <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product_phone" name="product_phone" required
                                    maxlength="12" placeholder="099-999-9999">
                                <div class="invalid-feedback">
                                    กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง (10 หลัก)
                                </div>
                            </div>
                            <!-- รูปภาพ -->
                            <div class="mb-3">
                                <label for="image_path" class="form-label">รูปภาพ</label>
                                <input type="file" class="form-control" id="image_path" name="image_path[]"
                                    accept="image/product_pic/*" multiple>
                                <div class="invalid-feedback">
                                    กรุณาอัพโหลดรูปภาพที่ถูกต้อง
                                </div>
                            </div>
                            <!-- หมวดหมู่ -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">หมวดหมู่ <span
                                        class="text-danger">*</span></label>
                                <select id="categoryDropdown" name="category_id" onchange="handleCategoryChange()" required>
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

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
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

        // Dropdown functionality
        const dropdown = document.querySelector('.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        // Toggle dropdown
        dropdown.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                dropdownMenu.classList.remove('show');
            }
        });

        // Handle item selection
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                const value = this.dataset.value;
                const text = this.textContent;

                // Update hidden input and dropdown text
                document.getElementById('productType').value = value;
                dropdown.textContent = text;

                // Close dropdown
                dropdownMenu.classList.remove('show');

                // Remove invalid feedback if present
                document.getElementById('productType').classList.remove('is-invalid');
            });
        });

        // Add validation for category selection
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!document.getElementById('productType').value) {
                event.preventDefault();
                document.getElementById('productType').classList.add('is-invalid');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

                const formData = new FormData(form);

                fetch('/api/addProduct', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(result => {
                        if (result.status === 201) { // ตรวจสอบว่า API ตอบกลับด้วย Status 201
                            alert('🎉 ลงขายสินค้าสำเร็จ! กำลังเปลี่ยนหน้า...');
                            window.location.href = '/home'; // ไปที่หน้า home
                        } else {
                            alert('❌ เกิดข้อผิดพลาด: ' + result.body.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('เกิดข้อผิดพลาดในการลงขายสินค้า');
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
    </script>
@endsection

</html>
