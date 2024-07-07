
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
                <h1 style="color:#4070f4">Duyurular</h1>
                <hr>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($notices as $announcement)

                    <div class="col">
                        <div class="card h-100">
                            @if($announcement->image_path)
                                <img  class="card-img-top" style="height:200px;width:220px" src="{{ asset('images/'.$announcement->image_path) }}" alt="{{ $announcement->title }}">
                            @else
                                <img src="https://placehold.co/280x250" style="height:200px;width:225px"  class="card-img-top"class="card-img-top" alt="Placeholder Resmi">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title" style="color:#4070f4">{{ $announcement->title }}</h5>
                                <p class="card-text">{!!   $announcement->content !!}</p>
                            </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary">{{ $announcement->created_at }}</small>
                                </div>
                        </div>
                    </div>

                @endforeach
            </div>
            </div>
        </div>
    </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

