<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสินค้า</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        option:disabled {
            color: gray !important;
        }

        .btn-orange {
            background-color: #FF8C00 !important;
            border: 2px solid #FF8C00;
            color: white !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            width: 100%;
            padding: 10px;
            font-size: 18px;
            font-weight: 500;
        }

        .btn-orange:hover {
            background-color: #FFA500 !important;
            color: white;
        }

        .bg-orange {
            background-color: #FF8C00 !important;
        }

        .form-control:focus {
            border-color: #FF8C00;
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
        }

        body,
        .navbar,
        footer,
        * {
            font-family: 'Noto Sans Thai', 'Prompt', sans-serif !important;
        }
    </style>
</head>

@extends('layouts.page')
@section('content')
    <div class="container px-4 mt-2" style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif; padding-top: 5px;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">แก้ไขข้อมูลสินค้า</h2>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const urlParts = window.location.pathname.split('/');
                                const productId = urlParts[urlParts.length - 1]; // Extract product ID from URL
                                console.log(productId);

                                // Define the base URL for the update route
                                const form = document.getElementById('sureEditProductForm');
                                if (form) {
                                    form.action = `/api/updateProduct/${productId}`; // Adjust this based on your actual route
                                }
                            });
                        </script>

                        <form id="sureEditProductForm" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <!-- ชื่อสินค้า -->
                            <div class="mb-3">
                                <label class="form-label">ชื่อสินค้า <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_name" required>
                            </div>

                            <!-- รายละเอียดสินค้า -->
                            <div class="mb-3">
                                <label class="form-label">รายละเอียดสินค้า <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="product_description" rows="4" required></textarea>
                            </div>

                            <!-- ราคา -->
                            <div class="mb-3">
                                <label class="form-label">ราคา <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="product_price" required>
                            </div>

                            <!-- สภาพสินค้า -->
                            <div class="mb-3">
                                <label class="form-label">สภาพสินค้า <span class="text-danger">*</span></label>
                                <select class="form-control" name="product_condition" required>
                                    <option value="มือหนึ่ง">มือหนึ่ง</option>
                                    <option value="มือสอง">มือสอง</option>
                                </select>
                            </div>

                            <!-- ที่อยู่สินค้า -->
                            <div class="mb-3">
                                <label class="form-label">ที่อยู่สินค้า <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_location" required>
                            </div>

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

                            <!-- รูปภาพ -->
                            <div class="mb-3">
                                <label class="form-label">รูปภาพสินค้า</label>
                                <input type="file" class="form-control" name="image_path[]" accept="image/*" multiple>
                                <div class="mt-3" id="imagePreview">
                                    <!-- รูปภาพจะแสดงที่นี่ -->
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

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-orange btn-lg">บันทึกการแก้ไข</button>
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
            const urlParts = window.location.pathname.split('/');
            const productId = urlParts[urlParts.length - 1];
            console.log(productId);
            let oldProductData = {};

            async function getOldData(productId) {
                try {
                    const response = await fetch(`/api/product/${productId}`);
                    oldProductData = await response.json();
                    console.log('this is oldProductData', oldProductData);

                    // Populate the form with old data
                    document.querySelector('input[name="product_name"]').value = oldProductData
                    .product_name;
                    document.querySelector('textarea[name="product_description"]').value = oldProductData
                        .product_description;
                    document.querySelector('input[name="product_price"]').value = parseInt(oldProductData
                        .product_price, 10);
                    document.querySelector('select[name="product_condition"]').value = oldProductData
                        .product_condition;
                    document.querySelector('input[name="product_location"]').value = oldProductData
                        .product_location;
                    document.querySelector('input[name="product_phone"]').value = oldProductData
                        .product_phone;
                    document.querySelector('select[name="category_id"]').value = oldProductData.category_id;
                    document.querySelector('select[name="type_id"]').value = oldProductData.type_id;
                    document.querySelector('select[name="brand_id"]').value = oldProductData.brand_id;

                    await fetchCategoriesAndPopulateDropdowns(oldProductData.category_id, oldProductData
                        .type_id, oldProductData.brand_id);
                } catch (error) {
                    console.error('Error fetching old product data:', error);
                }
            }

            getOldData(productId);

            async function fetchCategoriesAndPopulateDropdowns(selectedCategoryId, selectedTypeId,
                selectedBrandId) {
                try {
                    const response = await fetch('/api/categoriesBrandAndType');
                    const categoryData = await response.json();

                    const category = categoryData.categories
                    

                    if (categoryData.categories) {
                        const categoryDropdown = document.getElementById('categoryDropdown');
                        categoryDropdown.innerHTML = '<option value="">เลือกหมวดหมู่</option>' +
                            categoryData.categories.map(category =>
                                `<option value="${category.category_id}">${category.category_name}</option>`
                            ).join('');

                        categoryDropdown.value = selectedCategoryId;

                        await handleCategoryChangeUpdate(selectedCategoryId, selectedTypeId,
                            selectedBrandId);
                    }
                } catch (error) {
                    console.error('Error fetching categories:', error);
                }
            }

            async function handleCategoryChangeUpdate(selectedCategoryId, selectedTypeId, selectedBrandId) {
                const categoryDropdown = document.getElementById('categoryDropdown');
                const brandDropdown = document.getElementById('brandDropdown');
                const typeDropdown = document.getElementById('typeDropdown');

                const category = categoryData.categories.find(cat => cat.category_id == selectedCategoryId);

                console.log("this is cat:",selectedCategoryId)
                console.log("this is Type:",selectedTypeId)
                console.log("this is Brand:",selectedBrandId)

                if (!category) return;

                brandDropdown.innerHTML = '';
                typeDropdown.innerHTML = '';

                if (selectedCategoryId === '1' || selectedCategoryId === '2' || selectedTypeId === null ) {
                    brandDropdown.disabled = false;
                    typeDropdown.disabled = true;
                    brandDropdown.innerHTML = '<option value="">กำลังเลือกเเบรนด์สินค้า</option>' +
                        (category.brands?.map(brand =>
                            `<option value="${brand.brand_id}">${brand.brand_name}</option>`
                        ).join('') || '');
                    brandDropdown.value = selectedBrandId;
                } else {
                    typeDropdown.disabled = false;
                    brandDropdown.disabled = true;
                    typeDropdown.innerHTML = '<option value="">กำลังเลือกประเภทสินค้า</option>' +
                        (category.types?.map(type =>
                            `<option value="${type.type_id}">${type.type_name}</option>`
                        ).join('') || '');
                    typeDropdown.value = selectedTypeId;
                }
            }

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

            async function handleCategoryChange() {
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

            document.getElementById('sureEditProductForm').addEventListener('submit', async function(event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(this);
                formData.append('product_id', productId); // Add product_id to FormData

                try {
                    const response = await fetch(`/api/updateProduct/${productId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json' // Forces Laravel to return JSON even on errors
                        }
                    });

                    const result = await response.json();

                    if (response.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสินค้าสำเร็จ!',
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
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาดในการแก้ไขข้อมูลสินค้า',
                        text: 'กรุณาลองใหม่'
                    });
                }
            });
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
