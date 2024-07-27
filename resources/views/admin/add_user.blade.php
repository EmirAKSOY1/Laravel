@auth
    @extends('layouts.navbar')
    @section('title',"Kullanıcı Ekle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
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
                    <form action="{{ route('add_user.store') }}" method="POST">
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

                        <div class="form-group">
                            <label for="organisation_level_id">Kurum</label>
                            <select class="form-control" id="organisation_level_id" name="organisation_level_id">
                                @foreach($organisationLevels as $orgLevel)
                                    <option value="{{ $orgLevel->id }}">
                                        {{ $orgLevel->organisation->organisation_name }} - {{ $orgLevel->level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <div class="input-group">
                                <input type="text" id="password" class="form-control" placeholder="Şifre" name="password">
                                <button type="button" class="btn btn-secondary" onclick="generatePassword()">Rastgele Şifre Üret</button>
                            </div>
                        </div>

                            <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="flexRadioDefault2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Test Yöneticisi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="flexRadioDefault3" >
                            <label class="form-check-label" for="flexRadioDefault3">
                                Sistem Yöneticisi
                            </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Kullanıcı Ekle</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
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
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

