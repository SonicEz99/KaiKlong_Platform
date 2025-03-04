<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสินค้า</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">แก้ไขข้อมูลสินค้า</h2>
                        <form id="editProductForm" class="needs-validation" novalidate>
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

                            <!-- เบอร์โทรศัพท์ -->
                            <div class="mb-3">
                                <label class="form-label">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="product_phone" 
                                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                    placeholder="099-999-9999" required>
                            </div>

                            <!-- รูปภาพ -->
                            <div class="mb-3">
                                <label class="form-label">รูปภาพสินค้า</label>
                                <input type="file" class="form-control" name="image_path[]" 
                                    accept="image/*" multiple>
                                <div class="mt-3" id="imagePreview">
                                    <!-- รูปภาพจะแสดงที่นี่ -->
                                </div>
                            </div>

                            <!-- หมวดหมู่ -->
                            <div class="mb-3">
                                <label class="form-label">หมวดหมู่ <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" required>
                                    <option value="">เลือกหมวดหมู่</option>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editProductForm');
            
            // Preview images
            const imageInput = document.querySelector('input[name="image_path[]"]');
            const imagePreview = document.getElementById('imagePreview');
            
            imageInput.addEventListener('change', function() {
                imagePreview.innerHTML = '';
                for (let file of this.files) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML += `
                            <img src="${e.target.result}" 
                                 style="max-width: 200px; max-height: 200px; margin: 10px;" 
                                 class="img-thumbnail">
                        `;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Form validation
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!form.checkValidity()) {
                    e.stopPropagation();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกการแก้ไขเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                form.classList.add('was-validated');
            });
        });
    </script>
@endsection

</html>