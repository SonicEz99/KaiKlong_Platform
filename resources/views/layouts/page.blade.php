<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My Laravel App')</title>

    @vite(['resources/js/app.js'])
</head>

<style>
    .bg-loadding {
        color: rgb(255, 139, 61);
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        width: 50%;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 999;
        backdrop-filter: blur(5px);
    }

    #loading {
        background-color: rgb(255, 255, 255);
        box-shadow: black;
        padding: 70px 200px;
        border-radius: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        text-align: center;
    }

    @media (max-width: 1024px) {
        #loading {
            padding: 60px 150px;
        }
    }

    @media (max-width: 768px) {
        #loading {
            padding: 50px 100px;
        }
    }

    @media (max-width: 576px) {
        #loading {
            padding: 40px 50px;
            width: 90%;
            text-align: center;
        }
    }

    .row-nav {
        display: flex;

        align-items: center;
    }

    .menu-nav-small {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .menu-nav {
        display: flex;
        align-items: center;
        gap: 24px;
        justify-content: space-between;
        width: 100%;
    }

    .navbar {
        padding: 25px;
    }

    .menu {
        color: rgb(255, 139, 61);
        font-weight: bold;

    }

    .menu-bar {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .logo h1 {
        font-weight: bold;
        color: rgb(255, 139, 61);
    }

    .menu-part {
        font-weight: bold;
        display: flex;
        gap: 14px;
    }

    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 100%;
        /* background-color: red; */
    }

    .menu-ham:focus {
        border: none;
    }

    .menu-ham {
        border-radius: 4px;
        padding: 4px;
        color: rgb(255, 139, 61);
        border: none;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .btn-sale button {
        padding: 10px;
        background-color: coral;
        color: white;
        border-radius: 4px;
        border: none;
        width: 120px;
    }


    @media (max-width: 768px) {

        .menu-nav,
        .menu-nav-small,
        .profile {
            display: flex;
            flex-direction: column;
        }

    }

    @media (max-width: 576px) {

        .menu-nav,
        .menu-nav-small,
        .profile {
            display: flex;
            flex-direction: column;
        }
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        margin-top: 50px;
        border-top: 1px solid #dee2e6;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: end;
        align-items: flex-start;
    }

    .footer-section {
        flex: 1;
        padding: 0 15px;
    }

    .footer-title {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .footer-contact {
        font-size: 12px;
        color: #666;
        line-height: 1.6;
    }

    .footer-social {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .social-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .social-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .footer-copyright {
        text-align: right;
        font-size: 12px;
        color: #666;
    }

    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .footer-social {
            justify-content: center;
        }

        .footer-copyright {
            text-align: center;
            margin-top: 20px;
        }
    }
</style>

<body>


    <div class="bg-loadding">
        <div id="loading">
            <h2>Kaiklong</h2>
            <div class="spinner-border" role="status"></div>
        </div>
    </div>

    <?php
$user = Auth::user();

    ?>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <button class="menu-ham navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="row-nav collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="menu-nav navbar-nav">
                    <div class="menu-nav-small">
                        <li class="nav-item">
                            <a class="logo nav-link active" aria-current="page" href="home">
                                <h1>Kaiklong</h1>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="menu nav-link" href="#">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu nav-link" href="#">เกี่ยวกับเรา</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu nav-link" href="#">เริ่มต้นยังไง?</a>
                        </li>
                    </div>
                    <div class="profile">
                        <div class="profile-pic">
                            <img class="profile-pic"
                                src="<?php echo $user->user_pic ? $user->user_pic : 'https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg' ?>"
                                alt="">
                        </div>
                        <div class="btn-sale">
                            <button>ลงขาย</button>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>



    <div id="page_content">
        @yield('content')
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-title">ติดต่อเรา</div>
                <div class="footer-contact">
                    เลขที่ 1 ถนนเทศบาลรังสฤษดิ์เหนือ เเขวงลาดยาว เขตจตุจักร<br>
                    กรุงเทพมหานคร 10900<br>
                    Tel : 02-123-4567<br>
                </div>
            </div>
            <div class="footer-section">
                <div class="footer-title">ศูนย์ช่วยเหลือ</div>
                <div class="footer-contact">
                    โทร
                </div>
            </div>
            <div class="footer-section">
                <div class="footer-title">ติดตามเรา</div>
                <div class="footer-social">
                    <a href="#" class="social-icon">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/600px-Facebook_Logo_%282019%29.png" alt="Facebook">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/800px-YouTube_full-color_icon_%282017%29.svg.png" alt="YouTube">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/LINE_logo.svg/2048px-LINE_logo.svg.png" alt="Line">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-content" style="margin-top: 20px;">
            <div class="footer-copyright">
                &copy;บริษัท ขายคล่อง บริษัทในกลุ่มดี จำกัด
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const startTime = performance.now();

            window.onload = function () {
                document.querySelector(".bg-loadding").style.display = "none";
                document.getElementById("page_content").style.display = "block";
            };
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>