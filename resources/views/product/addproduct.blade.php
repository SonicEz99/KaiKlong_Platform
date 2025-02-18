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
    </style>
</head>

@extends('layouts.page')
@section('content')
<div class="container px-4 mt-2">
    <div class="row">
        <div class="col-12">
            <div class="">              
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <!-- ชื่อสินค้า -->
                        <div class="mb-3">
                            <label for="productName" class="form-label">ชื่อสินค้าที่คุณต้องการลงขาย <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อสินค้า
                            </div>
                        </div>

                        <!-- ประเภทสินค้า -->
                        <div class="mb-3">
                            <label class="form-label">ประเภทของสินค้า <span class="text-danger">*</span></label>
                            <input type="hidden" id="productType" name="productType" required>
                            <div class="custom-dropdown">
                                <div class="dropdown-toggle" id="categoryDropdown">เลือกหมวดหมู่</div>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item" data-value="electronics">อิเล็กทรอนิกส์</li>
                                    <li class="dropdown-item" data-value="clothing">เสื้อผ้า</li>
                                    <li class="dropdown-item" data-value="food">อาหาร</li>
                                    <li class="dropdown-item" data-value="other">อื่นๆ</li>
                                </ul>
                            </div>  
                            <div class="invalid-feedback">
                                กรุณาเลือกประเภทสินค้า
                            </div>
                        </div>
                        <!-- แบรนด์สินค้า -->
                        <div class="mb-3">
                            <label class="form-label">แบรนด์ของสินค้า <span class="text-danger">*</span></label>
                            <input type="hidden" id="productType" name="productType" required>
                            <div class="custom-dropdown">
                                <div class="dropdown-toggle" id="categoryDropdown">เลือกแบรนด์</div>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item" data-value="electronics">i phone</li>
                                </ul>
                            </div>  
                            <div class="invalid-feedback">
                                กรุณาเลือกประเภทสินค้า
                            </div>
                        </div>

                        <!-- รายละเอียดสินค้า -->
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">รายละเอียดของสินค้า <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                กรุณากรอกรายละเอียดสินค้า
                            </div>
                        </div>

                        <!-- ราคาสินค้า -->
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">ราคาสินค้า <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="productPrice" name="productPrice" required min="0" step="0.01">
                                <span class="input-group-text">บาท</span>
                                <div class="invalid-feedback">
                                    กรุณากรอกราคาสินค้า
                                </div>
                            </div>
                        </div>

                        <!-- สภาพ -->
                        <div class="mb-3">
                            <label for="productCondition" class="form-label">สภาพ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productCondition" name="productCondition" required>
                            <div class="invalid-feedback">
                                กรุณากรอกสภาพสินค้า
                            </div>
                        </div>

                        <!-- ที่อยู่สินค้า -->
                        <div class="mb-3">
                            <label for="productLocation" class="form-label">ที่อยู่สินค้า <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productLocation" name="productLocation" required>
                            <div class="invalid-feedback">
                                กรุณากรอกที่อยู่สินค้า
                            </div>
                        </div>

                        <!-- เบอร์โทร -->
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">เบอร์โทรศัพท์ (ที่สามารถติดต่อได้) <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" required>
                            <div class="invalid-feedback">
                                กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง
                            </div>
                        </div>

                        <!-- รูปสินค้า -->
                        <div class="mb-3">
                            <label for="productImages" class="form-label">รูปสินค้า <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="productImages" name="productImages[]" multiple accept="image/*" required>
                            <div class="form-text">สามารถเพิ่มรูปได้หลายรูป (สูงสุด 5 รูป)</div>
                            <div class="invalid-feedback">
                                กรุณาเพิ่มรูปสินค้า
                            </div>
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
document.getElementById('productImages').addEventListener('change', function(e) {
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
</script>
@endsection
</html>