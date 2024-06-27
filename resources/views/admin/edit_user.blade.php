
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
                    <h2 style="color:#4070f4">Aday Düzenle</h2>
                    <form action="{{ route('fetch_user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kullanıcı TC</label>
                            <input type="text" class="form-control" id="organisation_name" name="tc">
                        </div>

                        <button type="submit" class="btn btn-primary">Kullanıcı Getir</button>
                    </form>
                        @if(isset($user))
                            <br>
                            <form action="{{ route('update_user') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Ad:</label>
                                    <input type="text" id="name"  class="form-control" name="name" value="{{ $user->name }}" required>
                                    <input type="hidden" id="name"  class="form-control" name="id" value="{{ $user->id }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Soyad:</label>
                                    <input type="text" id="name"  class="form-control" name="surname" value="{{ $user->surname }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Kullanıcı Adı:</label>
                                    <input type="text" id="email" class="form-control" name="username" value="{{ $user->username }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">TC:</label>
                                    <input type="number" id="email" class="form-control" name="tc" value="{{ $user->tc }}" required disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Şifre:</label>
                                    <input type="text" id="email" class="form-control" name="password" value="{{ $user->password }}" required>
                                </div>

                                <!-- Diğer inputlar -->
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </form>
                        @endif

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

