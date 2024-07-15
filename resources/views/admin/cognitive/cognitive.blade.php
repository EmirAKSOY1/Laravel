@auth
    @extends('layouts.navbar')
    @section('title',"Bilişsel Düzey")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Bilişsel Düzey Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Bilişsel Düzey Başarıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Bilişsel Düzey</h1>
                    <hr>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('cognitive.create') }}'">Yeni Bilişsel Düzey Ekle</button>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Kodu</th>
                            <th>Taksonomi</th>
                            <th>Düzey Adı</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cognitives as $cognitive)
                            <tr>
                                <td>{{ $cognitive->id }}</td>
                                <td>{{ $cognitive->taksonomi_name }}</td>
                                <td>{{ $cognitive->cognitive_name }}</td>
                                <td>

                                    <a  class="btn btn-primary" href="{{ route('cognitive.edit', $cognitive->id) }}">Düzenle</a>
                                    <form action="{{ route('cognitive.destroy', $cognitive->id) }}" method="POST" style="display:inline;">
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

