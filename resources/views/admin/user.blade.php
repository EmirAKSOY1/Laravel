
@auth
    @extends('layouts.navbar')
    @section('title',"Kullanıcı")
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
                            Kullanıcı Başarılıyla Silindi!
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
                    <h1>Kullanıcılar</h1>
                    <hr>
                    <form action="{{route('add_user.index')}}" method="GET" class="mb-4">
                        <div class="row">
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
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">Rol</span>
                                    <select id="rol_id" name="rol_id">
                                        <option value="" >Rol Seçiniz</option>
                                            <option value="1" {{ request('role_id') == 1 ? 'selected' : '' }}>Sistem yöneticisi</option>
                                            <option value="2" {{ request('role_id') == 2 ? 'selected' : '' }} >Test Uygulayıcısı</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Filtrele</button>
                    </form>

                    <br>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('candidate.create') }}'">Yeni Kullanıcı Ekle</button>
                    @if(isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Adı</th>
                                <th>Soyadı</th>
                                <th>E-Posta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @if($user->roles->first()->id!=3)
                                <tr>
                                    <td>{{$user->roles->first()->name}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surname}}</td>
                                    <td>
                                        <a  class="btn btn-primary" href="{{ route('candidate.edit',$user->id) }}">Düzenle</a>
                                        <form action="{{ route('add_user.destroy',$user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sil</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    @endif
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

