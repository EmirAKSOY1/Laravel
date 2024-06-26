
@auth
    @extends('layouts.navbar')
    @section('title',"Kullanıcı Ekle")
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
                <a href="{{ route('organisation') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
                    <span class="navlink">Okul Tanımlama</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('add_user') }}" class="nav_link">
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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kullanıcı Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 style="color:#4070f4">Kullanıcı Ekle</h2>
                    <form action="{{ route('add_user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kullanıcı İsmi</label>
                            <input type="text" class="form-control" id="organisation_name" name="user_name">
                        </div>

                        <div class="mb-3">
                            <label for="input1" class="form-label">Kullanıcı Soyismi</label>
                            <input type="text" class="form-control" id="organisation_name" name="user_surname">
                        </div>


                        <div class="mb-3">
                            <label for="input1" class="form-label">Kullanıcı Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="username">
                        </div>

                        <div class="mb-3">
                            <label for="input1" class="form-label">Kullanıcı Mail</label>
                            <input type="email" class="form-control" id="organisation_name" name="user_mail">
                        </div>

                        <div class="mb-3">
                            <label for="input1" class="form-label">Kullanıcı TC</label>
                            <input type="number" class="form-control" id="organisation_name" name="user_tc">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <div class="input-group">
                                <input type="text" id="password" class="form-control" placeholder="Şifre" name="password">
                                <button type="button" class="btn btn-secondary" onclick="generatePassword()">Rastgele Şifre Üret</button>
                            </div>

                            <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="3" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Aday
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="flexRadioDefault2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Test Yöneticisi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="flexRadioDefault3" >
                            <label class="form-check-label" for="flexRadioDefault3">
                                Admin
                            </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Kullanıcı Ekle</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Sayfa yüklendikten sonra 3 saniye bekle ve alert'i gizle
            setTimeout(function() {
                var alertElement = document.getElementById('successAlert');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade');
                }
            }, 2000); // 3000 milisaniye = 3 saniye
            function generatePassword() {
                var length = 8;
                var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                var password = "";
                for (var i = 0, n = charset.length; i < length; ++i) {
                    password += charset.charAt(Math.floor(Math.random() * n));
                }
                document.getElementById('password').value = password;
            }
            </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

