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
                            Özel Gereksinim Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 style="color:#4070f4">Alan Düzenle</h2>
                    <form action="{{ route('branches.update', $branch->branch_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="input1" class="form-label">Alan Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="branch_name"  value="{{ $branch->branch_name }}">
                        </div>
                        <div class="form-group">
                            <label for="organisation_level_id">Sınıf Seviyesi</label>
                            <select class="form-control" id="organisation_level_id" name="class_level_id" required>
                                @foreach($class_levels as $classLevel)
                                    <option value="{{ $classLevel->class_id }}" {{ $branch->class_id == $classLevel->class_id ? 'selected' : '' }}>
                                        {{ $classLevel->class_type }} - {{ $classLevel->class_level_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Alan Düzenle</button>
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

