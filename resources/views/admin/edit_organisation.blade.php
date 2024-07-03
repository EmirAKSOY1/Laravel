
@auth
    @extends('layouts.navbar')
    @section('title',"Duyuru Düzenle")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kurum Başarılıyla Güncellendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kurum Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Kurum Düzenle</h1>
                    <form action="{{ route('organisation.update', $organisation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="input1" class="form-label">Kurum Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="organisation_name" value="{{ $organisation->organisation_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kurum Seviyesi</label>
                            <select id="level_id" name="level_id">
                                @foreach($levelModel as $level)
                                    <option value="{{ $level->id }}" {{ $levelll == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <br>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary">Kurum Güncelle</button>
                    </form>

                </div>
            </div>
        </div>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
            // Sayfa yüklendikten sonra 3 saniye bekle ve alert'i gizle
            setTimeout(function() {
                var alertElement = document.getElementById('successAlert');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade');
                }
            }, 2000); // 3000 milisaniye = 3 saniye
        </script>

    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

