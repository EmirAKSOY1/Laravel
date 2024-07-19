
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
                    <h1>Testler</h1>
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
                                        @foreach ($test->subBranches as $subBranch)
                                            {{ $subBranch->sub_branch_name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($test->subBranches as $subBranch)
                                            {{ $subBranch->branch->classLevel->class_type }}<br>
                                            {{ $subBranch->branch->classLevel->class_level_name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a  href="{{ route('subbranch.show', $test->test_id) }}" type="button" class="btn btn-secondary"><i class='bx bx-search' ></i></a>
                                        <a href="{{ route('tests.edit', $test->test_id) }}" class="btn btn-primary">Düzenle</a>
                                        <form action="{{ route('tests.destroy',$test->test_id) }}" method="POST" style="display:inline-block;">
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

