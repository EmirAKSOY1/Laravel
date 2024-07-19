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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <title>@yield('title')</title>
</head>
<body>
<!-- navbar -->
<nav class="navbar">
    <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <div style="cursor:pointer" onclick="goToDashboard()">
            <img src="{{asset('tubitak.png')}}" alt=""></i>Universal Test System
        </div>
    </div>
    <div class="navbar_content">
        <span>{{auth()->user()->username}}</span>
        <span>({{auth()->user()->roles->first()->name}})</span>
        <i class='bx bx-sun' id="darkLight"></i>
        <i class='bx bx-bell' ></i>
    </div>
</nav>
<!-- sidebar -->
<nav class="sidebar">
    <div class="menu_content">
        @yield('sidebar_permission')
        <ul class="menu_items">
        <div class="menu_title menu_profile"></div>
        <!-- duplicate these li tag if you want to add or remove navlink only -->
        <!-- Start -->
            <li class="item">
                <a href="{{route('contact.index')}}" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bxs-id-card'></i>
              </span>
                    <span class="navlink">İletişim Bilgileri</span>
                </a>
            </li>
        <li class="item">
            <a href="{{ route('changepasswordshow') }}" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-user-circle'></i>
              </span>
                <span class="navlink">Şifre değiştir</span>
            </a>
        </li>

        </ul>
        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
            <div class="bottom expand_sidebar">
                <span> Expand</span>
                <i class='bx bx-log-in' ></i>
            </div>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="bottom collapse_sidebar" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span> Çıkış Yap</span>
                <i class='bx bx-log-out'></i>
            </div>
        </div>
    </div>
</nav>
<script>
    // Sayfa yüklendikten sonra 3 saniye bekle ve alert'i gizle
    setTimeout(function() {
        var alertElement = document.getElementById('successAlert');
        if (alertElement) {
            alertElement.classList.remove('show');
            alertElement.classList.add('fade');
            window.location.reload()
        }
    }, 2000);
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
@yield('icerik')
</body>
</html>
