
@auth
    @extends('layouts.navbar')
    @section('title',"Kurumlar")
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
                            Kurum Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kurum Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Kurumlar</h1>
                        <form method="GET" action="{{ route('organisation.index') }}">
                            <input type="text" name="search" placeholder="Kurum İsmi Giriniz..." value="{{ request('search') }}">
                            <button class="btn btn-secondary" type="submit">Ara</button>
                        </form>
                        <br>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('organisation.create') }}'">Yeni Kurum Ekle</button>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Kodu</th>
                            <th>Adı</th>
                            <th>Düzey</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organisations as $organisation)
                            <tr>
                                <td>{{ $organisation->id }}</td>
                                <td>{{$organisation->organisation_name}}</td>
                                <td>                @if($organisation->levels->isNotEmpty())
                                        @foreach($organisation->levels as $level)
                                            {{ $level->name }}
                                        @endforeach
                                    @else
                                        <span>Kayıt Yok</span>
                                    @endif</td>

                                <td>
                                    <a  class="btn btn-primary" href="{{ route('organisation.edit', $organisation->id) }}">Düzenle</a>
                                    <form action="{{ route('organisation.destroy', $organisation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

