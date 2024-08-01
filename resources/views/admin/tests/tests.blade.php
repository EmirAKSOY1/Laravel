
@auth
    @extends('layouts.navbar')
    @section('title',"Alanlar")

    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <style>
            .status-indicator {
                height: 20px;
                width: 20px;
                border-radius: 50%;
                display: inline-block;
            }
            .active {
                background-color: green;
            }
            .inactive {
                background-color: red;
            }
            .sub-branch-container {
                max-width: 200px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .more-info {
                display: inline-block;
                cursor: pointer;
                color: blue;
                font-weight: bold;
            }
        </style>
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Test Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Test Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Test Başarılıyla Eklendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Test Başarılıyla Güncellendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 style="color:#4070f4">Testler</h2>
                    <hr>
                    <br>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('tests.create') }}'">Yeni Test Ekle</button>
                    @if(isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Test Adı</th>
                                <th>Başlanıç Saati</th>
                                <th>Tarih</th>
                                <th>Dönem</th>
                                <th>Durum</th>
                                <th>Alan</th>
                                <th>Sınıf</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)
                                <tr>
                                <tr>
                                    <td>{{ $test->test_name }}</td>
                                    <td>{{ $test->start_time }}</td>
                                    <td>{{ $test->date }}</td>
                                    <td>{{ $test->term->term_name }}</td>
                                    <td><span class="status-indicator {{ $test->active ? 'active' : 'inactive' }}"></span></td>
                                    <td>
                                        <div class="sub-branch-container" data-content="{{ $test->subBranches->pluck('sub_branch_name')->join(', ') }}">
                                            @if ($test->subBranches->count() > 1)
                                                {{ $test->subBranches->first()->sub_branch_name }}<br>
                                                <span class="more-info" title="{{ $test->subBranches->pluck('sub_branch_name')->join(', ') }}">...</span>
                                            @else
                                                {{ $test->subBranches->first()->sub_branch_name }}<br>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($test->subBranches as $subBranch)
                                            {{ $subBranch->branch->classLevel->class_type }}<br>
                                            {{ $subBranch->branch->classLevel->class_level_name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="settingsMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='fas fa-cog' ></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="settingsMenuButton">
                                            <a class="dropdown-item" href="{{ route('question.show',$test->test_id)}}">Maddeler</a>
                                            <a class="dropdown-item" href="/settings/profile">Uygulama Ayarları</a>
                                            <a class="dropdown-item" href="/settings/security">BOBUT Ayarları</a>
                                            <a class="dropdown-item" href="/settings/notifications">Geribildirim ayarları</a>
                                            <a class="dropdown-item" href="/settings/privacy">Karşılama ekranı ayarları</a>
                                            <a class="dropdown-item" href="/settings/privacy">Raporlar/Grafikler</a>
                                        </div>

                                        <a href="{{ route('tests.edit', $test->test_id) }}" class="btn btn-primary">Düzenle</a>
                                        <form action="{{ route('tests.destroy',$test->test_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sil</button>
                                        </form>
                                        <a  href="{{ route('tests.duplicate', $test->test_id) }}" type="button" class="btn btn-secondary"><i class='bx bx-copy' ></i></a>
                                    </td>
                                </tr>


                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

