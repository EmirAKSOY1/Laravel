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

                    <h2 style="color:#4070f4">Kazanım Düzenle</h2>
                    <form action="{{ route('learningoutcome.update', $learnOutcome->learning_outcomes_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kazanım Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="learning_outcomes_name" value="{{$learnOutcome->learning_outcomes_name}}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Kazanım Güncelle</button>
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

