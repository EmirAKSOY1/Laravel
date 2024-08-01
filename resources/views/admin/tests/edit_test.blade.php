@auth
    @extends('layouts.navbar')
    @section('title',"Test Ekle")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <head>
        <style>
            .select2-container {
                width: 300px !important; /* !important ekleyerek varsayılan genişliği geçersiz kılar */
            }

            .select2-selection {
                width: 100% !important; /* İçerik alanının genişliğinin %100 olması */
            }

            .select2-search__field {
                width: 100% !important; /* Arama alanının genişliğinin %100 olması */
            }
            /* Select2 elementlerinin stilini iyileştirmek için ek stil */
            .select2-container--default .select2-selection--multiple {
                background-color: #f7f7f7;
                border: 1px solid #ced4da;
                border-radius: 4px;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #007bff;
                border: 1px solid #007bff;
                border-radius: 2px;
                padding: 0 0.5rem;
                color: #fff;
                margin-top: 0.375rem;


            }
            .select2-container--focus{
                width: 300px;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                color: #fff;
                margin-right: 0.5rem;
                cursor: pointer;
            }
            .custom-textarea {
                width: 300px; /* Genişliği tam olarak form elemanının genişliğine ayarlar */
                height: 150px; /* Yüksekliği ayarlar */
                resize: vertical; /* Yalnızca dikey olarak yeniden boyutlandırmaya izin verir */
                padding: 0.5rem; /* İç boşluk ekler */
                font-size: 1rem; /* Yazı tipi boyutunu ayarlar */
            }
        </style>
    </head>
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Test Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h2 style="color:#4070f4">Test Güncelle</h2>
                    <form action="{{ route('tests.update', $tests->test_id) }}" method="POST" enctype="multipart/form-data" id="addForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="input1" class="form-label">Test Adı</label>
                            <input type="text" class="form-control" id="organisation_name" name="test_name" value="{{$tests->test_name}}">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Test Tarihi</label>
                            <input type="date" class="form-control" id="organisation_name" name="test_date" value="{{$tests->date}}">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Test Başlangıç Saati</label>
                            <input type="time" class="form-control" id="organisation_name" name="test_time" value="{{$tests->start_time}}">
                        </div>
                        <div class="form-group">
                            <label for="term_id">Dönem:</label>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addTermModal">
                                +
                            </button>
                            <br><br>
                            <select name="term_id" id="term_id" class="form-control" required>
                                @foreach ($terms as $term)
                                    <option value="{{ $term->term_id }}" {{ $tests->term_id == $term->term_id ? 'selected' : '' }}>
                                        {{ $term->term_year }} - {{ $term->term_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div><br>
                        <div class="form-group">
                            <label for="tags">Alt-Alan:</label>
                            <select name="tags[]" id="tags" multiple="multiple">

                            </select>
                        </div><br>
                        <div class="mb-3">
                            <label>Durum:</label><br>
                            <input type="radio" id="active_inactive" name="active" value="0" {{ $tests->active == 0 ? 'checked' : '' }} required>
                            <label for="active_inactive">Pasif</label>
                            <input type="radio" id="active_active" name="active" value="1" {{ $tests->active == 1 ? 'checked' : '' }}>
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


                // Mevcut etiketleri seçili yap
                var existingTags = @json($existingTags);
                console.log(existingTags);

                existingTags.forEach(function(tag) {
                    console.log(tag);
                    var option = new Option(tag.sub_branch_name, tag.sub_branch_id, true, true);
                    $('#tags').append(option).trigger('change');
                });

                $('#tags').select2({

                    placeholder: 'Select or search tags',
                    ajax: {
                        url: '{{ route('tests.search') }}',
                        type: 'POST',
                        dataType: 'json',
                        delay: 250,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function(params) {

                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {

                            console.log(data);
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,
                    tags: true
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth


