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
        background-color: rgba(255, 255, 255, 0.81);
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
</style>

<body>


    <div class="bg-loadding">
        <div id="loading">
            <h2>Kaiklong</h2>
            <div class="spinner-border" role="status"></div>
        </div>
    </div>

    <div class="navbar">navbar</div>
    <div id="page_content">
        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                document.querySelector(".bg-loadding").style.display = "none";
                document.getElementById("page_content").style.display = "block";
            }, 2000);
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>