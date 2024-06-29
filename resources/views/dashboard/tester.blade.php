
@auth
    @extends('layouts.navbar')
    @section('title',"Test Uygulayıcısı")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        <ul class="menu_items">
            <div class="menu_title menu_dahsboard"></div>
            <!-- duplicate these li tag if you want to add or remove navlink only -->
            <!-- Start -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-loader-circle"></i>
              </span>
                    <span class="navlink">Çok Aşamalı</span>
                </a>
            </li>
            <!-- End -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-sitemap"></i>
              </span>
                    <span class="navlink">BOBUT</span>
                </a>
            </li>
        </ul>
        <ul class="menu_items">
            <div class="menu_title menu_editor"></div>
            <!-- duplicate these li tag if you want to add or remove navlink only -->
            <!-- Start -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-edit"></i>
              </span>
                    <span class="navlink">Başvuru İşlemleri</span>
                </a>
            </li>
            <!-- End -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-user"></i>
              </span>
                    <span class="navlink">Aday Düzenleme</span>
                </a>
            </li>

        </ul>
        <ul class="menu_items">
            <div class="menu_title menu_setting"></div>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-flag"></i>
              </span>
                    <span class="navlink">Sınıf Düzeyi Ekle</span>
                </a>
            </li>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-medal"></i>
              </span>
                    <span class="navlink">Bilişsel Düzey Ekle</span>
                </a>
            </li>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-spreadsheet"></i>
              </span>
                    <span class="navlink">Alan-Kazanım Ekle</span>
                </a>
            </li>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
                    <span class="navlink">Grup Tanımlama</span>
                </a>
            </li>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
                    <span class="navlink">Okul Tanımlama</span>
                </a>
            </li>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
                    <span class="navlink">Kullanıcı Tanımlama</span>
                </a>
            </li>
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-news"></i>
              </span>
                    <span class="navlink">Duyuru</span>
                </a>
            </li>
        </ul>
    @endsection
    @section('icerik')
        <div class="content">

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1>Duyurular</h1>
                    @foreach($notices as $announcement)
                        <div>
                            <h2>{{ $announcement->title }}</h2>
                            <p>{{ $announcement->content }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

