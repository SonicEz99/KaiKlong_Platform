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
</style>

<body>


    <div class="bg-loadding">
        <div id="loading">
            <h2>Kaiklong</h2>
            <div class="spinner-border" role="status"></div>
        </div>
    </div>




    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <button class="menu-ham navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="row-nav collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="menu-nav navbar-nav">
                    <div class="menu-nav-small">
                        <li class="nav-item">
                            <a class="logo nav-link active" aria-current="page" href="#">
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
                                src="https://e7.pngegg.com/pngimages/533/648/png-clipart-person-thought-people-thinking-desktop-wallpaper-glasses-thumbnail.png"
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                document.querySelector(".bg-loadding").style.display = "none";
                document.getElementById("page_content").style.display = "block";
            }, 1000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
