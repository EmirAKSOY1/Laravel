
@auth
    @extends('layouts.navbar')
    @section('title',"Duyuru Ekle")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
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
                    <form action="{{ route('notice') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Duyuru Başlığı</label>
                            <input type="text" class="form-control" id="organisation_name" name="notice_title">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Duyuru İçeriği</label>
                            <input type="text" class="form-control" id="organisation_name" name="notice_content">
                        </div>

                        <button type="submit" class="btn btn-primary">Duyuru Ekle</button>
                    </form>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

