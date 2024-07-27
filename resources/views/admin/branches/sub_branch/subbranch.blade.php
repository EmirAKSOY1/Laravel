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
                    <h2>{{ $branch->branch_name }} için Alt-Alan</h2>
                    <hr>
                        <a  href="{{ route('subbranch.create', $branch->branch_id) }}" type="button" class="btn btn-success">Yeni Alt-Alan Ekle</a>
                        <a  href="{{ route('branches.index')}}" type="button" class="btn btn-primary">Alanlara Git</a>


                    @if($branch->subBranches->isEmpty())
                        <br>
                        <br>
                            <p><b>{{ $branch->branch_name }}</b> Alanı için hiç alt-alan bulunamadı</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> Alt-Alan Kodu</th>
                                <th> Alt-Alan Adı</th>
                                <th>Kazanım Sayısı</th>
                                <th style="text-align: center">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branch->subBranches as $subBranch)
                                <tr>
                                    <td>{{ $subBranch->sub_branch_id }}</td>
                                    <td>{{ $subBranch->sub_branch_name }}</td>
                                    <td>{{ $subBranch->learningOutcomes->count() }}</td>
                                    <td>
                                        <a href="{{ route('subbranch.edit',  $subBranch->sub_branch_id) }}" class="btn btn-primary">Düzenle</a>
                                        <form action="{{ route('subbranch.destroy', $subBranch->sub_branch_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sil</button>
                                        </form>
                                        <a  href="{{ route('learningoutcome.show', $subBranch->sub_branch_id) }}" type="button" class="btn btn-secondary">Kazanım</a>
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


