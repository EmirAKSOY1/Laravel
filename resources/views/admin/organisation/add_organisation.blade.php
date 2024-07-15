@auth
    @extends('layouts.navbar')
    @section('title',"Kurum Ekle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Kurum Başarılıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 style="color:#4070f4">Kurum Ekle</h2>
                    <form action="{{ route('organisation.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Kurum İsmi</label>
                            <input type="text" class="form-control" id="organisation_name" name="organisation_name">
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Düzey</label>
                            <select class="form-control" id="level" name="level_id">
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Kurum Ekle</button>
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

