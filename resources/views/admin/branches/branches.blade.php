
@auth
    @extends('layouts.navbar')
    @section('title',"Alanlar")
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
                            Alan Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Alan Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Aday Başarılıyla Eklendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Aday Başarılıyla Güncellendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Alanlar</h1>
                    <hr>
                                        <br>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('branches.create') }}'">Yeni Alan Ekle</button>
                    @if(isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Alan Adı</th>
                                <th>Sınıf Seviyesi</th>
                                <th>Alt Alan Sayısı</th>
                                <th>Kazanım Sayısı</th>
                                <th style="text-align: center">İşlemler</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{ $branch->branch_name }}</td>
                                    <td>{{ $branch->classLevel->class_type }} {{ $branch->classLevel->class_level_name }}</td>

                                    <td>{{ $branch->subBranches->count() }}</td>
                                    <td>34</td>
                                    <td>
                                        <a href="{{ route('branches.edit', $branch->branch_id) }}" class="btn btn-primary">Düzenle</a>
                                        <form action="{{ route('branches.destroy', $branch->branch_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sil</button>
                                        </form>
                                        <a  href="{{ route('subbranch.show', $branch->branch_id) }}" type="button" class="btn btn-secondary">Alt-Alan</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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

