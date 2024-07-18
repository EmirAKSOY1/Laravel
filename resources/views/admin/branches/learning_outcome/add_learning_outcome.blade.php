@auth
    @extends('layouts.navbar')
    @section('title',"Alan Ekle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kazanım Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 style="color:#4070f4">{{ $sub_branch->sub_branch_name }} İçin Kazanım Ekle</h2>
                    <form action="{{ route('learningoutcome.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kazanım Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="outcome_name">
                        </div>
                        <input type="hidden" name="sub_branch_id" value="{{$sub_branch->sub_branch_id }}">

                        <br>
                        <button type="submit" class="btn btn-primary">Kazanım Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

