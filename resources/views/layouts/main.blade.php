<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('tubitak.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <title>@yield('title')</title>
    <style>
        @import url('https://cdn-uicons.flaticon.com/2.4.2/uicons-thin-rounded/css/uicons-thin-rounded.css');
        .menu_content {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .item{
            margin-top:3rem;
        }
    </style>
</head>
<body>
<!-- navbar -->
<nav class="navbar">
    <div class="logo_item" style="cursor: pointer" onclick="goToDashboard()">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <img src="{{asset('tubitak.png')}}" alt=""></i>Universal Test System
    </div>
</nav>
<!-- sidebar -->
<nav class="sidebar">
    <div class="menu_content">

        <ul class="menu_items">

            <!-- duplicate these li tag if you want to add or remove navlink only -->
            <!-- Start -->
            <li class="item">
                <a href="https://evrenseltest.com.tr/" class="nav_link">
              <span class="navlink_icon">
                <i class="fi fi-sr-globe"></i>
              </span>
                    <span class="navlink">Siteyi Gör</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ url('/contact_page') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="fi fi-sr-headset"></i>
              </span>
                    <span class="navlink">İletişim</span>
                </a>
            </li>

            <li class="item">
                <a href="{{ url('/about') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="fi fi-sr-info"></i>
              </span>
                    <span class="navlink">Hakkımızda</span>
                </a>
            </li>

            <li class="item">
                <a href="{{route('login')}}" class="nav_link">
              <span class="navlink_icon">
                <i class="fi fi-tr-sign-in-alt"></i>
              </span>
                    <span class="navlink">Giriş Yap</span>
                </a>
            </li>

        </ul>

    </div>
</nav>
<script>
    const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
    sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

    sidebarClose.addEventListener("click", () => {
        sidebar.classList.add("close", "hoverable");
    });
    sidebarExpand.addEventListener("click", () => {
        sidebar.classList.remove("close", "hoverable");
    });

    sidebar.addEventListener("mouseenter", () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.remove("close");
        }
    });
    sidebar.addEventListener("mouseleave", () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.add("close");
        }
    });

    darkLight.addEventListener("click", () => {
        body.classList.toggle("dark");
        if (body.classList.contains("dark")) {
            document.setI
            darkLight.classList.replace("bx-sun", "bx-moon");
        } else {
            darkLight.classList.replace("bx-moon", "bx-sun");
        }
    });

    submenuItems.forEach((item, index) => {
        item.addEventListener("click", () => {
            item.classList.toggle("show_submenu");
            submenuItems.forEach((item2, index2) => {
                if (index !== index2) {
                    item2.classList.remove("show_submenu");
                }
            });
        });
    });

    if (window.innerWidth < 768) {
        sidebar.classList.add("close");
    } else {
        sidebar.classList.remove("close");
    }
    function goToDashboard() {
        window.location.href = "{{ route('dashboard') }}";
    }
</script>
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @yield('icerik')
        </div>
    </div>
</div>
</body>
</html>
