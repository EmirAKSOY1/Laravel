
@auth
    @extends('layouts.navbar')
    @section('title',"Kurum Ekle")
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
                            Kurum Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 style="color:#4070f4">Kurum Ekle</h2>
                    <form action="{{ route('organisation') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kurum İsmi</label>
                            <input type="text" class="form-control" id="organisation_name" name="organisation_name">
                        </div>

                        <button type="submit" class="btn btn-primary">Kurum Ekle</button>
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
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

