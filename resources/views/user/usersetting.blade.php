<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์</title>
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<style>
    .header-title {
        color: orange;
    }

    .profile-setting {
        background-color: #E6E6E6;
        padding: 54px 54px 54px 54px;
        display: flex;
        gap: 5%;
        justify-content: start;
        align-items: center;

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 100%;
        }

        .detail-profile {
            color: grey;
        }
    }

    .management-data-profile {

        hr {
            margin-left: 15px;
        }

        margin-top: 24px;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 5%;
        padding-bottom:60px;

        .text-flind-setting {
            display: flex;
            flex-direction: column;
            gap: 24px;
            border-left: 1px solid #E6E6E6;
        }

        .input-data {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-data label {
            width: 120px;
            font-weight: bold;
            margin-right: 15px;
            margin-left: 15px;
        }

        .input-data input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }


        ul {
            list-style: none;
            text-align: center;
            font-size: 18px;
            padding: 0;
        }

        ul li {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        ul li.active {
            background-color: orange;
            color: white;
        }

        .btn {
            button {
                padding: 5px;
                border: none;
                background-color: orange;
                border-radius: 4px;
                width: 300px;
                height: 40px;
                color: white;
            }
        }

        .required {
            color: red;
            font-weight: bold;
            margin-left: 5px;
        }

        .account-form {
            width: 100%;
        }

    }

    #uploadModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content1 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        /* Set a fixed width */
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .modal-header1 {
        margin-bottom: 20px;
        text-align: center;
    }

    .modal-header1 h2 {
        color: orange;
        margin: 0;
        font-size: 1.5rem;
    }

    .file-upload-container {
        margin-bottom: 25px;
    }

    .file-upload-container label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .file-input-wrapper {
        position: relative;
        width: 100%;
        height: 40px;
        border: 2px dashed #ccc;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        overflow: hidden;
        background-color: #f9f9f9;
        transition: border-color 0.3s;
    }

    .file-input-wrapper:hover {
        border-color: orange;
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-input-placeholder {
        color: #777;
        font-size: 0.9rem;
    }

    .selected-file-name {
        margin-top: 5px;
        font-size: 0.8rem;
        color: #666;
        text-align: center;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .preview-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .image-preview {
        width: 120px;
        height: 120px;
        border-radius: 100%;
        object-fit: cover;
        border: 2px solid #eee;
    }

    .modal-footer {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .modal-btn {
        padding: 8px 0;
        border: none;
        border-radius: 4px;
        width: 45%;
        height: 40px;
        color: white;
        font-weight: 500;
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .modal-btn:hover {
        opacity: 0.9;
    }

    .save-btn {
        background-color: orange;
    }

    .cancel-btn {
        background-color: #666;
    }
</style>

<?php
$user = auth()->user();
?>
@extends('layouts.page')
@section('content')

    <body style="font-family: 'Prompt', sans-serif;">

        <div class="container" style="margin-top: 10px;">
            <h1 class="header-title">ข้อมูลส่วนตัว</h1>
        </div>
        <hr>

        <div class="container">
            <div class="profile-setting">
                <img onclick="openModal()" class="profile-pic"
                    src="{{ $user->user_pic ? $user->user_pic : 'https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg' }}"
                    alt="">

                <div class="detail-profile">
                    <h3>ชื่อผู้ใช้ : {{ $user->user_name }}</h3>
                    <h3>อีเมล : {{ $user->user_email }}</h3>
                </div>
            </div>

            <div id="uploadModal" style="display:none;">
                <div class="modal-content1">
                    <div class="modal-header1">
                        <h2>อัปโหลดรูปโปรไฟล์</h2>
                    </div>

                    <div class="preview-container">
                        <img id="imagePreview" class="image-preview"
                            src="{{ $user->user_pic ? $user->user_pic : 'https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg' }}"
                            alt="Preview">
                    </div>

                    <div class="file-upload-container">
                        <label for="fileInput">เลือกรูปภาพ</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="fileInput" accept="image/*" />
                            <div class="file-input-placeholder">คลิกเพื่อเลือกไฟล์</div>
                        </div>
                        <div id="selectedFileName" class="selected-file-name"></div>
                    </div>

                    <div class="modal-footer">
                        <button onclick="uploadProfilePic()" class="modal-btn save-btn">บันทึก</button>
                        <button onclick="closeModal()" class="modal-btn cancel-btn">ยกเลิก</button>
                    </div>
                </div>
            </div>

            <div class="management-data-profile">
                <div class="menu-setting">
                    <ul id="menu-list">
                        <li class="active" onclick="selectMenu(this)" data-target="profile">ข้อมูลส่วนตัว</li>
                        <?php $user = Auth::user(); ?>

                        <?php if ($user->google_id == null) { ?>
                        <li onclick="selectMenu(this)" data-target="account">จัดการบัญชี</li>
                        <?php } ?>
                    </ul>
                    <hr>
                </div>


                <div class="text-flind-setting" id="profile-section">
                    <form id="updateUserForm" method="POST" class="needs-validation" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="input-data">
                            <label for="">ชื่อผู้ใช้</label>
                            <input type="text" name="user_name" value="{{ $user->user_name }}">
                        </div>
                        <div class="input-data">
                            <label for="">ชื่อ <span class="required">*</span></label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}"
                                placeholder="ยังไม่ได้ตั้งค่าชื่อ">
                        </div>
                        <div class="input-data">
                            <label for="">นามสกุล <span class="required">*</span></label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}"
                                placeholder="ยังไม่ได้ตั้งค่านามสกุล">
                        </div>
                        <hr>
                        <div class="input-data">
                            <label for="">เบอร์โทร <span class="required">*</span></label>
                            <input type="text" name="tel" value="{{ $user->tel }}" placeholder="+ เบอร์โทรศัพท์">
                        </div>
                        <hr>
                        <div class="btn">
                            <button type="submit">บันทึก</button>
                        </div>
                    </form>
                </div>

                <!-- ฟอร์มจัดการบัญชี (เริ่มต้นซ่อน) -->
                <div class="text-flind-setting" id="account-section">
                    <div class="account-form" id="account-form">
                        <form id="updatePasswordForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="input-data">
                                <label>รหัสผ่านเดิม</label>
                                <input type="password" name="oldPassword" placeholder="********" required>
                            </div>
                            <div class="input-data">
                                <label>เปลี่ยนรหัสผ่าน</label>
                                <input type="password" name="password" placeholder="********" required>
                            </div>
                            <div class="input-data">
                                <label>ยืนยันรหัสผ่าน</label>
                                <input type="password" name="password_confirmation" placeholder="********" required>
                            </div>
                            <hr>
                            <div class="btn">
                                <button type="submit">เปลี่ยนรหัสผ่าน</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openModal() {
            document.getElementById("uploadModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("uploadModal").style.display = "none";
            location.reload();
        }

        function uploadProfilePic() {
            let fileInput = document.getElementById('fileInput');
            let file = fileInput.files[0];

            if (!file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No File Selected',
                    text: 'Please select an image file before uploading!',
                });
                return;
            }

            let formData = new FormData();
            formData.append("user_pic", file);

            fetch("/api/updateProfile/<?php echo $user->id; ?>", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: JSON.stringify(data.error),
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Updated!',
                            text: 'Your profile picture has been updated successfully.',
                            showConfirmButton: false,
                            timer: 2000 // Closes after 2 seconds
                        }).then(() => {
                            location.reload(); // Refresh the page
                        });
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        text: 'Please try again later.',
                    });
                });
        }
    </script>

    <!-- ข้อมูลส่วนตัว -->
    <?php $user = Auth::user(); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById("fileInput").addEventListener("change", function(event) {
            let file = event.target.files[0]; // Get the selected file
            let preview = document.getElementById("imagePreview"); // Get the preview image element
            let selectedFileName = document.getElementById("selectedFileName"); // Get the file name display

            if (file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Set preview image to the selected file
                };

                reader.readAsDataURL(file); // Convert file to base64 for preview

                selectedFileName.textContent = "📂 " + file.name; // Show selected file name
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('updateUserForm');

            if (form) {
                form.action = "/api/updateUser/{{ $user->id }}"; // Set action URL

                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const formData = new FormData(form);

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json(); // Convert response to JSON
                            }
                            throw new Error('Failed to update');
                        })
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกสำเร็จ!',
                                text: 'ข้อมูลของคุณถูกอัปเดตเรียบร้อยแล้ว',
                                confirmButtonText: 'ตกลง'
                            }).then(() => {
                                location.reload(); // Refresh the page
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถอัปเดตข้อมูลได้ กรุณาลองอีกครั้ง',
                                confirmButtonText: 'ตกลง'
                            });
                            console.error(error);
                        });
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('updatePasswordForm');

            if (form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const formData = new FormData(form);

                    fetch("/api/resetPassword", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                    text: 'รหัสผ่านของคุณถูกอัปเดตเรียบร้อยแล้ว',
                                    confirmButtonText: 'ตกลง'
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                throw new Error(data.error || 'ไม่สามารถเปลี่ยนรหัสผ่านได้');
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: error.message || 'โปรดลองอีกครั้ง',
                                confirmButtonText: 'ตกลง'
                            });
                        });
                });
            }
        });
    </script>

    <script>
        function selectMenu(selectedItem) {
            // ลบ class 'active' ออกจากทุก <li>
            document.querySelectorAll("#menu-list li").forEach(li => {
                li.classList.remove("active");
            });

            // เพิ่ม class 'active' ให้กับ li ที่ถูกเลือก
            selectedItem.classList.add("active");

            // ดึงค่าจาก data-target
            let selectedTarget = selectedItem.dataset.target;
            console.log("เลือกเมนู:", selectedTarget); // Debug ดูค่าใน Console

            // ตรวจสอบการแสดงผล
            if (selectedTarget === "account") {
                document.getElementById("account-section").style.display = "block"; // แสดงฟอร์มจัดการบัญชี
                document.getElementById("profile-section").style.display = "none"; // ซ่อนฟอร์มข้อมูลส่วนตัว
            } else {
                document.getElementById("account-section").style.display = "none"; // ซ่อนฟอร์มจัดการบัญชี
                document.getElementById("profile-section").style.display = "block"; // แสดงฟอร์มข้อมูลส่วนตัว
            }
        }

        // ตรวจสอบการแสดงผลเมื่อโหลดเพจ
        document.addEventListener("DOMContentLoaded", function() {
            let activeMenu = document.querySelector("#menu-list li.active");
            if (activeMenu) {
                selectMenu(activeMenu);
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let inputs = document.querySelectorAll(".input-data input");

            function checkInput() {
                inputs.forEach(input => {
                    let label = input.previousElementSibling.querySelector(".required");

                    if (input.value.trim() === "") {
                        label.style.display = "inline"; // แสดง * เป็นสีแดง
                    } else {
                        label.style.display = "none"; // ซ่อน * เมื่อกรอกข้อมูลแล้ว
                    }
                });
            }

            // เรียกใช้เมื่อตรวจสอบค่าเริ่มต้น
            checkInput();

            // ฟังชันตรวจสอบเมื่อผู้ใช้กรอกข้อมูล
            inputs.forEach(input => {
                input.addEventListener("input", checkInput);
            });
        });
    </script>
@endsection

</html>
