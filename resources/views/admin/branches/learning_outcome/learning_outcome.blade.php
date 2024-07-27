@auth
    @extends('layouts.navbar')
    @section('title',"Alt Alan")
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
                            Alt-Alan Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Alt-Alan Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Alt-Alan Başarılıyla Eklendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Alt-Alan Başarılıyla Güncellendi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2>{{ $sub_branch->sub_branch_name }} Alt Alanı Kazanımları</h2>
                    <hr>
                    <a  href="{{ route('learningoutcome.create', $sub_branch->sub_branch_id) }}" type="button" class="btn btn-success">Yeni Kazanım Ekle</a>
                    <a  href="{{ route('branches.index')}}" type="button" class="btn btn-primary">Alanlara Git</a>
                    <a  href="{{ route('subbranch.show',$sub_branch->branch->branch_id) }}" type="button" class="btn btn-warning">Alt Alanlara Git</a>

                    @if($sub_branch->learningOutcomes->isEmpty())
                        <br>
                        <br>
                        <p><b>{{ $sub_branch->sub_branch_name }}</b> Alt-Alanı için hiç kazanım bulunamadı!</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> Kazanım Kodu</th>
                                <th> Kazanım Adı</th>
                                <th style="text-align: center">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sub_branch->learningOutcomes as $outcome)
                                <tr>
                                    <td>{{ $outcome->learning_outcomes_id }}</td>
                                    <td>{{ $outcome->learning_outcomes_name }}</td>
                                    <td>
                                        <a href="{{ route('learningoutcome.edit',  $outcome->learning_outcomes_id) }}" class="btn btn-primary">Düzenle</a>
                                        <form action="{{ route('learningoutcome.destroy', $outcome->learning_outcomes_id) }}" method="POST" style="display:inline-block;">
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



