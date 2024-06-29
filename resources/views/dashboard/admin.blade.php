
@auth
    @extends('layouts.navbar')
    @section('title',"Yönetici")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
    <div class="content">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Duyurular</h1>
                <hr>
                @foreach($notices as $announcement)
                    <div>
                        <h2 style="color:#4070f4">{{ $announcement->title }}</h2>
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

