
@auth
    @extends('layouts.navbar')
    @section('title',"Duyuru Düzenle")
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
                            Duyuru Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Duyuru Başarılıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Duyuru Düzenle</h1>
                        <form action="{{ route('notices.update', $notices->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="input1" class="form-label">Duyuru Başlığı</label>
                                <input type="text" class="form-control" id="organisation_name" name="notice_title" value="{{ $notices->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="input1" class="form-label">Duyuru Başlangıç Tarihi</label>
                                <input type="date" class="form-control" id="organisation_name" name="notice_start_date" value="{{ $notices->start_date }}">
                            </div>
                            <div class="mb-3">
                                <label for="input1" class="form-label">Duyuru Bitiş Tarihi</label>
                                <input type="date" class="form-control" id="organisation_name" name="notice_end_date" value="{{ $notices->end_date }}" >
                            </div>

                            <div class="mb-3">
                                <label for="input1" class="form-label">Duyuru İçeriği</label>
                                <textarea name="notice_content" id="editor">
                            {{ $notices->content }}
                        </textarea>
                            </div>
                            <label for="input1" class="form-label">Fotoğraf</label><br>
                            @if($notices->image_path)
                                <img style="width: 300px;height: 200px;" src="{{ asset('images/'.$notices->image_path) }}" alt="{{ $notices->title }}">
                            @else
                                <img src="https://placehold.co/300x200" alt="Placeholder Resmi">
                            @endif
                            <br>
                            <br>
                            <input type="file" class="form-control" id="organisation_name" name="image" accept="image/png, image/jpeg, image/jpg">
                            <br>
                            <button type="submit" class="btn btn-primary">Duyuru Güncelle</button>
                        </form>

                </div>
            </div>
        </div>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );

        </script>

    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

