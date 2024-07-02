
@auth
    @extends('layouts.navbar')
    @section('title',"Duyuru Ekle")
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
                            Duyuru Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        @if (session('delete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                                Duyuru Başarılıyla Silindi!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h1>Duyurular</h1>

                        <button type="button" class="btn btn-success"  onclick="window.location='{{ route('notices.create') }}'">Yeni Duyuru Ekle</button>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>İçerik</th>
                                <th>Başlangıç Tarihi</th>
                                <th>Bitiş Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notices as $announcement)
                                <tr>
                                    <td>{{ $announcement->title }}</td>
                                    <td>{!! Str::limit( $announcement->content , 20, ' ...') !!}</td>
                                    <td>{{ $announcement->start_date }}</td>
                                    <td>{{ $announcement->end_date }}</td>

                                    <td>

                                        <a  class="btn btn-primary" href="{{ route('notices.edit', $announcement->id) }}">Düzenle</a>
                                        <form action="{{ route('notices.destroy', $announcement->id) }}" method="POST" style="display:inline;">
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

