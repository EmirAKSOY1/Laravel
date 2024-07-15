@auth
    @extends('layouts.navbar')
    @section('title',"Özel Gereksinim")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Özel Gereksinim Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Özel Gereksinim Başarıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Özel Gereksinim</h1>
                    <hr>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('disabilities.create') }}'">Yeni Gereksinim Düzey Ekle</button>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Kodu</th>
                            <th>Özel Gereksinim</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($disabilities as $disability)
                            <tr>
                                <td>{{ $disability->id }}</td>
                                <td>{{ $disability->name }}</td>
                                <td>

                                    <a  class="btn btn-primary" href="{{ route('disabilities.edit', $disability->id) }}">Düzenle</a>
                                    <form action="{{ route('disabilities.destroy', $disability->id) }}" method="POST" style="display:inline;">
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
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

