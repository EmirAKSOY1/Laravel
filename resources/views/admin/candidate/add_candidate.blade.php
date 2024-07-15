@auth
    @extends('layouts.navbar')
    @section('title',"Aday Ekle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">


            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Aday Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 style="color:#4070f4">Aday Ekle</h2>
                    <form action="{{ route('candidate.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="candidate_name" class="form-label">Aday İsmi</label>
                            <input type="text" class="form-control" id="candidate_name" name="candidate_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="candidate_surname" class="form-label">Aday Soyismi</label>
                            <input type="text" class="form-control" id="candidate_surname" name="candidate_surname" required>
                        </div>
                        <div class="mb-3">
                            <label for="candidate_username" class="form-label">Aday Kullanıcı Adı</label>
                            <input type="text" class="form-control" id="candidate_username" name="candidate_username" required>
                        </div>
                        <div class="mb-3">
                            <label for="candidate_tc" class="form-label">Aday TC</label>
                            <input type="text" class="form-control" id="candidate_tc" name="candidate_tc" required>
                        </div>
                        <div class="mb-3">
                            <label for="candidate_email" class="form-label">Aday Mail</label>
                            <input type="email" class="form-control" id="candidate_email" name="candidate_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <div class="input-group">
                                <input type="text" id="password" class="form-control" placeholder="Şifre" name="password" required>
                                <button type="button" class="btn btn-secondary" onclick="generatePassword()">Rastgele Şifre Üret</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="candidate_birthdate" class="form-label">Aday Doğum Tarihi</label>
                            <input type="date" class="form-control" id="candidate_birthdate" name="candidate_birthdate" required>
                        </div>
                        <div class="form-group">
                            <label for="organisation_level_id">Kurum</label>
                            <select class="form-control" id="organisation_level_id" name="organisation_level_id" required>
                                @foreach($organisationLevels as $orgLevel)
                                    <option value="{{ $orgLevel->id }}">
                                        {{ $orgLevel->organisation->organisation_name }} - {{ $orgLevel->level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Cinsiyet:</label><br>
                            <input type="radio" id="gender_male" name="gender" value="0" required>
                            <label for="gender_male">Erkek</label>
                            <input type="radio" id="gender_female" name="gender" value="1">
                            <label for="gender_female">Kadın</label>
                        </div>
                        <div class="form-group">
                            <label>Özel Gereksinimler:</label><br>
                            @foreach($disabilities as $disability)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="disabilities[]"
                                           value="{{ $disability->id }}"
                                    >
                                    <label class="form-check-label">{{ $disability->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="mb-3">
                            <label>Durum:</label><br>
                            <input type="radio" id="active_inactive" name="active" value="0" required>
                            <label for="active_inactive">Pasif</label>
                            <input type="radio" id="active_active" name="active" value="1">
                            <label for="active_active">Aktif</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Aday Ekle</button>
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

