@auth
    @extends('layouts.navbar')
    @section('title',"Duyuru Ekle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">


            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Duyuru Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 style="color:#4070f4">Duyuru Ekle</h2>
                    <form action="{{ route('notice') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Duyuru Başlığı</label>
                            <input type="text" class="form-control" id="organisation_name" name="notice_title">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Duyuru Başlangıç Tarihi</label>
                            <input type="date" class="form-control" id="organisation_name" name="notice_start_date">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Duyuru Bitiş Tarihi</label>
                            <input type="date" class="form-control" id="organisation_name" name="notice_end_date">
                        </div>

                        <!--
                        <div class="mb-3">
                            <label for="input1" class="form-label">Duyuru İçeriği</label>
                            <input type="text" class="form-control" id="organisation_name" name="notice_content">
                        </div>-->
                        <div class="mb-3">
                        <label for="input1" class="form-label">Duyuru İçeriği</label>
                        <textarea name="notice_content" id="editor">
                            &lt;p&gt;&lt;/p&gt;
                        </textarea>
                        </div>
                        <label for="input1" class="form-label">Fotoğraf</label>
                        <input type="file" class="form-control" id="organisation_name" name="image" accept="image/png, image/jpeg, image/jpg">
                        <br>
                        <button type="submit" class="btn btn-primary">Duyuru Ekle</button>
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

