
@auth
    @extends('layouts.navbar')
    @section('title',"Adaylar")
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
                            Aday Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Aday Başarılıyla Silindi!
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
                    <h1>Adaylar</h1>
                        <hr>
                        <form action="{{ route('candidate.index') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Aday No</span>
                                        <input type="text" class="form-control" name="candidate_id" value="{{ request('candidate_id') }}" placeholder="Aday No">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Adı</span>
                                        <input type="text" class="form-control" name="name" value="{{ request('name') }}" placeholder="Adı">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Soyadı</span>
                                        <input type="text" class="form-control" name="surname" value="{{ request('surname') }}" placeholder="Soyadı">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">TC No</span>
                                        <input type="text" class="form-control" name="tc" value="{{ request('tc') }}" placeholder="TC Numarası">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Filtrele</button>
                        </form>

                        <br>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('candidate.create') }}'">Yeni Aday Ekle</button>
                        @if(isset($message))
                            <p>{{ $message }}</p>
                        @else
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Aday No</th>
                            <th>Adı</th>
                            <th>Soyadı</th>
                            <th>E-Posta</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->id }}</td>
                                <td>{{$candidate->user->name}}</td>
                                <td>{{$candidate->user->surname}}</td>
                                <td>{{$candidate->user->email}}</td>

                                <td>
                                    <a  class="btn btn-primary" href="{{ route('candidate.edit', $candidate->id) }}">Düzenle</a>
                                    <form action="{{ route('candidate.destroy', $candidate->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </form>
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

