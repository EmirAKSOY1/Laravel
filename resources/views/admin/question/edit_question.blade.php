@auth
    @extends('layouts.navbar')
    @section('title',"Madde Ekle")
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #textbox-with-radio {
            display: block;
        }
        #textbox-with-radio input[type="text"] {
            display: inline-block;
            width: calc(100% - 30px); /* Radio button için genişlik */
            margin-left: 30px; /* Radio button için boşluk */
        }
        #textbox-with-radio input[type="radio"] {
            margin-right: 10px;
        }
        #textbox-wrapper {
            position: relative;
            margin-bottom: 10px; /* Alt alta dizilme aralığı */
        }
        #textbox-wrapper input[type="radio"] {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Responsive düzenlemeler */
        @media (max-width: 768px) {
            #textbox-with-radio input[type="text"] {
                width: 100%;
                margin-left: 0;
                padding-left: 30px; /* Radio button için boşluk */
            }
            #textbox-wrapper input[type="radio"] {
                position: relative;
                top: auto;
                transform: none;
                margin-right: 10px;
            }
        }

    </style>
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
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 style="color:#4070f4">Madde Düzenle</h2>
                    <form action="{{ route('question.update', $questions->question_id) }}" method="POST" enctype="multipart/form-data" id="addForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="test_id" value="{{$questions->test_id}}">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Madde Kökü</label>
                            <input type="text" class="form-control" id="root_text" name="root_text" value="{{$questions->root_text}}">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Ortak Kök</label>
                            <input type="text" class="form-control" id="common_text" name="common_text"  value="{{$questions->common_text}}">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Sınıf Düzeyi</label>
                            <select name="class" id="class" class="form-control" required>
                                @foreach($classes as $class)
                                    <option value="{{ $class->class_id }}"  {{ $questions->get_out_comes->subBranch->branch->classLevel->class_id == $class->class_id ? 'selected' : '' }}>
                                        {{ $class->class_type }} - {{ $class->class_level_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Alan</label>
                            <select name="branch" id="branch" class="form-control" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_id }}"  {{ $questions->get_out_comes->subBranch->branch->branch_id == $branch->branch_id ? 'selected' : '' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="term_id">Alt Alan:</label>
                            <select name="sub-branch" id="sub-branch" class="form-control" required>
                                @foreach($sub_branches as $sub_branch)
                                    <option value="{{ $sub_branch->sub_branch_id }}"  {{ $questions->get_out_comes->subBranch->sub_branch_id == $sub_branch->sub_branch_id ? 'selected' : '' }}>
                                        {{ $sub_branch->sub_branch_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div><br>
                        <div >
                            <label for="tags">Kazanım:</label>
                            <select name="learning_outcome" id="learning-outcome" class="form-control" required>
                                @foreach($learningOutcome as $outcome)
                                    <option value="{{ $outcome->learning_outcomes_id }}" {{ $questions->learning_out_comes  == $outcome->learning_outcomes_id ? 'selected' : '' }}>{{ $outcome->learning_outcomes_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div >
                            <label for="tags">Bilişsel Düzey:</label>
                            <select name="cognivite_id" id="cognivite_id" class="form-control"  required>
                                @foreach($cognitivies as $cognivity)
                                    <option value="{{ $cognivity->id }}" {{ $questions->cognitive_id  == $cognivity->id ? 'selected' : '' }}>{{ $cognivity->cognitive_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div >
                            <label for="tags">Modül:</label>
                            <input type="text" class="form-control" id="module" name="module" value="{{$questions->module}}">
                        </div>
                        <br>
                        <div class="mb-3" id="textbox-with-radio">
                            <label>Seçenekler:</label><br>
                            <div id="textbox-wrapper">
                                <input type="radio" name="true_option" value="a" {{ $questions->option_true == 'a' ? 'checked' : '' }}>
                                <input type="text" name="a_option"  class="form-control" placeholder="A Şıkkı(*)" value="{{$questions->option_a}}" required>
                            </div>
                            <div id="textbox-wrapper">
                                <input type="radio" name="true_option" value="b" {{ $questions->option_true == 'b' ? 'checked' : '' }}>
                                <input type="text" name="b_option" class="form-control" placeholder="B Şıkkı(*)" value="{{$questions->option_b}}" required>
                            </div>
                            <div id="textbox-wrapper">
                                <input type="radio" name="true_option" value="c" {{ $questions->option_true == 'c' ? 'checked' : '' }}>
                                <input type="text" name="c_option"  class="form-control" placeholder="C Şıkkı" value="{{$questions->option_c}}">
                            </div>
                            <div id="textbox-wrapper">
                                <input type="radio" name="true_option" value="d" {{ $questions->option_true == 'd' ? 'checked' : '' }}>
                                <input type="text" name="d_option" class="form-control" placeholder="D Şıkkı" value="{{$questions->option_d}}">
                            </div>
                            <div id="textbox-wrapper">
                                <input type="radio" name="true_option" value="e" {{ $questions->option_true == 'e' ? 'checked' : '' }}>
                                <input type="text" name="e_option" class="form-control" placeholder="E Şıkkı" value="{{$questions->option_e}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Metin Sentezleyici:</label>
                            <input type="checkbox" id="text_synthesize" name="text_synthesize" {{ $questions->text_synthesize == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="mb-3">
                            <label><u>Hangi Gereksinimlere Uygulanamaz?</u></label><br>
                            @foreach($disabilities as $disability)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="disabilities[]"
                                           value="{{ $disability->id }}"
                                        {{ in_array($disability->id, $questionDisabilities) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $disability->name }}</label>
                                </div>
                            @endforeach
                        </div><br>
                        <div class="mb-3">
                            <label>Madde Parametreleri:</label><br>
                            <label>a</label>
                            <input style="width: 50px" type="number" id="a_parameter" name="a_parameter" step="0.1" value="{{$questions->parameter_a}}" required>
                            <label>b</label>
                            <input style="width: 50px" type="number" id="b_parameter" name="b_parameter"  step="0.1" value="{{$questions->parameter_b}}">
                            <label>c</label>
                            <input style="width: 50px" type="number" id="c_parameter" name="c_parameter"  step="0.1" value="{{$questions->parameter_c}}">
                            <label>d</label>
                            <input style="width: 50px" type="number" id="d_parameter" name="d_parameter"  step="0.1" value="{{$questions->parameter_d}}">
                        </div><br>
                        <div class="mb-3">
                            <label>Medya:</label>
                            <button class="btn btn-primary">Ses Yükle</button>
                            <button class="btn btn-primary">Resim Yükle</button>
                            <button class="btn btn-primary">Video Yükle</button>
                        </div>
                        <div class="mb-3">
                            <label>Durum:</label><br>
                            <input type="radio" id="active_inactive" name="active" value="0" {{ $questions->is_active == 0 ? 'checked' : '' }} >
                            <label for="active_inactive">Pasif</label>
                            <input type="radio" id="active_active" name="active" value="1" {{ $questions->is_active == 1 ? 'checked' : '' }}>
                            <label for="active_active">Aktif</label>
                        </div>
                        <button type="submit" class="btn btn-success">Madde Ekle</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).ready(function() {
                    $('#class').on('change', function() {
                        $('#branch').prop('selectedIndex', -1);
                        $('#sub-branch').prop('selectedIndex', -1);
                        $('#learning-outcome').prop('selectedIndex', -1);
                    });
                });
                $(document).ready(function() {
                    $('#branch').on('change', function() {
                        $('#sub-branch').prop('selectedIndex', -1);
                        $('#learning-outcome').prop('selectedIndex', -1);
                    });
                });
                $(document).ready(function() {
                    $('#sub-branch').on('change', function() {
                        $('#learning-outcome').prop('selectedIndex', -1);
                    });
                });
                $('#class').on('change', function() {
                    var branchID = $(this).val();
                    if(branchID) {
                        $.ajax({
                            url: '{{ route("get-branches") }}',
                            type: "GET",
                            data : { class_id: branchID },
                            dataType: "json",
                            success: function(data) {
                                $('#branch').empty();
                                $('#branch').append('<option value="">Alan Seçiniz</option>');
                                $.each(data, function(key, value) {
                                    console.log(data);
                                    $('#branch').append('<option value="'+ value.branch_id +'">'+ value.branch_name +'</option>');
                                });
                            }
                        });
                    } else {
                        $('#branch').empty();
                        $('#branch').append('<option value="">Alan Seçiniz</option>');
                    }
                });
                $('#branch').on('change', function() {
                    var branchID = $(this).val();
                    if(branchID) {
                        $.ajax({
                            url: '{{ route("get-sub-branches") }}',
                            type: "GET",
                            data : { branch_id: branchID },
                            dataType: "json",
                            success: function(data) {
                                $('#sub-branch').empty();
                                $('#sub-branch').append('<option value="">Alt-Alan Seçiniz</option>');
                                $.each(data, function(key, value) {
                                    $('#sub-branch').append('<option value="'+ value.sub_branch_id +'">'+ value.sub_branch_name +'</option>');
                                });
                            }
                        });
                    } else {
                        $('#sub-branch').empty();
                        $('#sub-branch').append('<option value="">Alt Alan Seçiniz</option>');
                    }
                });
                $('#sub-branch').on('change', function() {
                    var subBranchID = $(this).val();
                    if(subBranchID) {
                        $.ajax({
                            url: '{{ route("learning-outcomes") }}',
                            type: "GET",
                            data : { sub_branch_id: subBranchID },
                            dataType: "json",
                            success: function(data) {
                                $('#learning-outcome').empty();
                                $('#learning-outcome').append('<option value="">Kazanım Seçiniz</option>');
                                $.each(data, function(key, value) {
                                    $('#learning-outcome').append('<option value="'+ value.learning_outcomes_id +'">'+ value.learning_outcomes_name +'</option>');
                                });
                            }
                        });
                    } else {
                        $('#learning-outcome').empty();
                        $('#learning-outcome').append('<option value="">Kazanım Seçiniz</option>');
                    }
                });
            });
        </script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth


