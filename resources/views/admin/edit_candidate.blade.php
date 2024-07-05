
@auth
    @extends('layouts.navbar')
    @section('title',"Aday Düzenle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Aday Başarılıyla Güncellendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Aday Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Aday Düzenle</h1>
                        <hr>
                        <form action="{{ route('candidate.update', $candidates->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Aday Adı</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $candidates->user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Aday Soyadı</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{ $candidates->user->surname }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id" class="form-label">Aday No</label>
                                <input type="text" class="form-control" id="id" name="candidate_id" value="{{ $candidates->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tc" class="form-label">Aday Tc</label>
                                <input type="text" class="form-control" id="tc" name="tc" value="{{ $candidates->user->tc }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Aday Mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $candidates->user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Aday Doğum Tarihi</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $candidates->birthdate }}" required>
                            </div>

                            <div class="form-group">
                                <label for="organisation_level_id">Kurum</label>
                                <select class="form-control" id="organisation_level_id" name="organisation_level_id">
                                    @foreach($organisationLevels as $orgLevel)
                                        <option value="{{ $orgLevel->id }}"
                                                @if($orgLevel->id == $candidates->organisation_level_id)
                                                    selected
                                            @endif
                                        >
                                            {{ $orgLevel->organisation->organisation_name }} - {{ $orgLevel->level->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Cinsiyet:</label><br>
                                <input type="radio" id="gender_male" name="gender" value="0" {{ $candidates->gender == 0 ? 'checked' : '' }}>
                                <label for="gender_male">Erkek</label>
                                <input type="radio" id="gender_female" name="gender" value="1" {{ $candidates->gender == 1 ? 'checked' : '' }}>
                                <label for="gender_female">Kadın</label>
                            </div>
                            <div class="mb-3">
                                <label>Durum:</label><br>
                                <input type="radio" id="active_inactive" name="active" value="0" {{ $candidates->user->is_active == 0 ? 'checked' : '' }}>
                                <label for="active_inactive">Pasif</label>
                                <input type="radio" id="active_active" name="active" value="1" {{ $candidates->user->is_active == 1 ? 'checked' : '' }}>
                                <label for="active_active">Aktif</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Aday Güncelle</button>
                        </form>


                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

