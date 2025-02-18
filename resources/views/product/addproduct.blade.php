<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงสินค้าใหม่</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
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
    </style>
</head>

@extends('layouts.page')
@section('content')
<div class="container px-4 mt-2">
    <div class="row">
        <div class="col-12">
            <div class="">              
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <!-- ชื่อสินค้า -->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">ชื่อสินค้า <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อสินค้า
                            </div>
                        </div>
                        <!-- รายละเอียดสินค้า -->
                        <div class="mb-3">
                            <label for="product_description" class="form-label">รายละเอียดสินค้า <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="product_description" name="product_description" required></textarea>
                            <div class="invalid-feedback">
                                กรุณากรอกรายละเอียดสินค้า
                            </div>
                        </div>
                        <!-- ราคา -->
                        <div class="mb-3">
                            <label for="product_price" class="form-label">ราคา <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="product_price" name="product_price" required>
                            <div class="invalid-feedback">
                                กรุณากรอกราคา
                            </div>
                        </div>
                        <!-- สภาพสินค้า -->
                        <div class="mb-3">
                            <label for="product_condition" class="form-label">สภาพสินค้า <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_condition" name="product_condition" required placeholder="มือหนึ่ง / มือสอง">
                            <div class="invalid-feedback">
                                กรุณากรอกสภาพสินค้า
                            </div>
                        </div>
                        <!-- ที่อยู่สินค้า -->
                        <div class="mb-3">
                            <label for="product_location" class="form-label">ที่อยู่สินค้า <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_location" name="product_location" required>
                            <div class="invalid-feedback">
                                กรุณากรอกที่อยู่สินค้า
                            </div>
                        </div>
                        <!-- เบอร์โทรศัพท์ -->
                        <div class="mb-3">
                            <label for="product_phone" class="form-label">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_phone" name="product_phone" required>
                            <div class="invalid-feedback">
                                กรุณากรอกเบอร์โทรศัพท์
                            </div>
                        </div>
                        <!-- รูปภาพ -->
                        <div class="mb-3">
                            <label for="image_path" class="form-label">รูปภาพ</label>
                            <input type="file" class="form-control" id="image_path" name="image_path[]" accept="image/product_pic/*" multiple>
                            <div class="invalid-feedback">
                                กรุณาอัพโหลดรูปภาพที่ถูกต้อง
                            </div>
                        </div>
                        <!-- หมวดหมู่ -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">หมวดหมู่ <span class="text-danger">*</span></label>
                            <select id="categoryDropdown" name="category_id" onchange="handleCategoryChange()" required>
                                <option value="">เลือกประเภทของสินค้า</option>
                                <!-- Categories will be populated here -->
                            </select>
                            <div class="invalid-feedback">
                                กรุณาเลือกหมวดหมู่
                            </div>
                        </div>
                        <!-- ประเภท -->
                        <div class="mb-3">
                            <label for="type_id" class="form-label">ประเภท</label>
                            <input type="number" class="form-control" id="type_id" name="type_id">
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
    document.addEventListener('DOMContentLoaded', function() {
        const categoryDropdown = document.getElementById('categoryDropdown');
        const brandDropdown = document.getElementById('brandDropdown');

        if (categoryDropdown && brandDropdown) {
            fetch('/api/categoriesBrandAndType')
                .then(response => response.json())
                .then(data => {
                    console.log(data.categories);
                    data.categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.category_id;
                        option.textContent = category.category_name;
                        categoryDropdown.appendChild(option);
                    });
                });

            categoryDropdown.addEventListener('change', handleCategoryChange);
        }
    });

    function handleCategoryChange() {
        const categoryDropdown = document.getElementById('categoryDropdown');
        const brandDropdown = document.getElementById('brandDropdown');
        const selectedCategoryId = categoryDropdown.value;

        if (selectedCategoryId) {
            brandDropdown.disabled = false;
            fetch(`/api/categoriesBrandAndType?category_id=${selectedCategoryId}`)
                .then(response => response.json())
                .then(data => {
                    brandDropdown.innerHTML = '<option value="">กำลังเลือกดเเบรนด์สินค้า</option>';
                    data.categories.find(cat => cat.category_id == selectedCategoryId).brands.forEach(brand => {
                        const option = document.createElement('option');
                        option.value = brand.brand_id;
                        option.textContent = brand.brand_name;
                        brandDropdown.appendChild(option);
                    });
                });
        } else {
            brandDropdown.disabled = true;
            brandDropdown.innerHTML = '<option value="">ไม่มีเเบรนด์สินค้า</option>';
        }
    }

    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
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
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(form);

            fetch('/api/addProduct', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
              window.location.href= '/addproduct'
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the product.');
            });
        });
    });
</script>
@endsection
</html>