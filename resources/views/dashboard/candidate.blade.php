
@auth
    @extends('layouts.navbar')
    @section('title',"Aday")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        <ul class="menu_items">
            <div class="menu_title menu_application"></div>
            <!-- duplicate these li tag if you want to add or remove navlink only -->
            <!-- Start -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-loader-circle"></i>
              </span>
                    <span class="navlink">Başvurularım</span>
                </a>
            </li>
            <!-- End -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-sitemap"></i>
              </span>
                    <span class="navlink">Başvuru Yap</span>
                </a>
            </li>
        </ul>
        <ul class="menu_items">
            <div class="menu_title menu_test"></div>
            <!-- duplicate these li tag if you want to add or remove navlink only -->
            <!-- Start -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-edit"></i>
              </span>
                    <span class="navlink">Geçmiş Testlerim</span>
                </a>
            </li>
            <!-- End -->
            <li class="item">
                <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-user"></i>
              </span>
                    <span class="navlink">Atanan Testler</span>
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

