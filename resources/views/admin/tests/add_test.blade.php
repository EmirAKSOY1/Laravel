@auth
    @extends('layouts.navbar')
    @section('title',"Test Ekle")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Test Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 style="color:#4070f4">Test Ekle</h2>
                    <form action="{{ route('tests.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
                        @csrf
                        <div class="mb-3">
                            <label for="input1" class="form-label">Test Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="test_name">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Test Tarihi</label>
                            <input type="date" class="form-control" id="organisation_name" name="test_date">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Test Başlangıç Saati</label>
                            <input type="time" class="form-control" id="organisation_name" name="test_time">
                        </div>
                        <div class="form-group">
                            <label for="term_id">Dönem:</label>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addTermModal">
                                +
                            </button>
                            <br><br>
                            <select name="term_id" id="term_id" class="form-control" required>
                                @foreach ($terms as $term)
                                    <option value="{{ $term->term_id }}">{{ $term->term_year }}-{{ $term->term_name }}</option>
                                @endforeach
                            </select>

                        </div><br>
                        <div class="form-group">
                            <label for="term_id">Alt Alan:</label>
                            <select name="test_sub_branch" id="term_id" class="form-control" required>
                                @foreach ($subbranchs as $subbranch)
                                    <option value="{{ $subbranch->sub_branch_id }}">{{ $subbranch->sub_branch_name }}</option>
                                @endforeach
                            </select>
                        </div><br>
                        <div class="mb-3">
                            <label>Durum:</label><br>
                            <input type="radio" id="active_inactive" name="active" value="0" required>
                            <label for="active_inactive">Pasif</label>
                            <input type="radio" id="active_active" name="active" value="1">
                            <label for="active_active">Aktif</label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Test Ekle</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Term Modal -->
        <div class="modal fade" id="addTermModal" tabindex="-1" aria-labelledby="addTermModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTermModalLabel">Yeni Dönem Ekle</h5>
                    </div>
                    <div class="modal-body">
                        <form id="addTermForm">
                            @csrf
                            <div class="form-group">
                                <label for="term_year">Dönem Yılı</label>
                                <input type="text" class="form-control" id="term_year" name="term_year" required>
                            </div>
                            <div class="form-group">
                                <label for="term_name">Dönem Adı</label>
                                <input type="text" class="form-control" id="term_name" name="term_name" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Ekle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#addTermForm').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '{{ route("terms.store") }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {

                            if(response.success) {
                                $('#addTermModal').modal('hide');
                                $('#term_id').append('<option value="' + response.term.term_id + '">' + response.term.term_year + '-' + response.term.term_name + '</option>');
                                $('#addTermForm')[0].reset();
                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        },
                        error: function() {
                            alert('Error adding term. Please try again.');
                        }
                    });
                });
            });
        </script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth


