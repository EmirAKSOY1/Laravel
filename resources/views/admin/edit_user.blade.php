
@auth
    @extends('layouts.navbar')
    @section('title',"Aday Düzenle")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kullanıcı Bilgisi güncellendi.!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        @if(session('error'))
                            <p style="color: red;">{{ session('error') }}</p>
                        @endif
                    <h2 style="color:#4070f4">Kulanıcı Düzenle</h2>
                    <hr>
                        @if(isset($users))
                            <br>
                            <form action="{{route('add_user.update', $users->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Ad:</label>
                                    <input type="text" id="name"  class="form-control" name="name" value="{{ $users->name }}" required>
                                    <input type="hidden" id="name"  class="form-control" name="id" value="{{ $users->id }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Soyad:</label>
                                    <input type="text" id="name"  class="form-control" name="surname" value="{{ $users->surname }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Kullanıcı Adı:</label>
                                    <input type="text" id="email" class="form-control" name="username" value="{{ $users->username }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{ $users->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">TC:</label>
                                    <input type="number" id="email" class="form-control" name="tc" value="{{ $users->tc }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Durum:</label><br>
                                    <input type="radio" id="active_inactive" name="active" value="0" {{ $users->is_active == 0 ? 'checked' : '' }}>
                                    <label for="active_inactive">Pasif</label>
                                    <input type="radio" id="active_active" name="active" value="1" {{ $users->is_active == 1 ? 'checked' : '' }}>
                                    <label for="active_active">Aktif</label>
                                </div>
                                <div class="mb-3">
                                    <label>Rol:</label><br>
                                    <input type="radio" id="active_inactive" name="role" value="1" {{ $users->roles->first()->id == 1 ? 'checked' : '' }}>
                                    <label for="active_inactive">Sistem Yöneticisi</label>
                                    <input type="radio" id="active_active" name="role" value="2" {{ $users->roles->first()->id == 2 ? 'checked' : '' }}>
                                    <label for="active_active">Test Uygulayıcısı</label>
                                </div>

                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </form>
                        @endif
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

