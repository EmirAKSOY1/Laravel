
@auth
    @extends('layouts.navbar')
    @section('title',"Maddeler")
    <style>
        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .question-title {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .question-info {
            margin-bottom: 20px;
        }

        .options {
            margin-bottom: 20px;
        }

        .option {
            margin-bottom: 10px;
        }

        @media (max-width: 600px) {
            .question-title {
                font-size: 1.5em;
            }
        }

    </style>
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 style="color:#4070f4">Madde Detayları</h2>
                    <div class="container mt-4">

                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Soru ID: {{ $question->question_id }}</h5>
                                <p><strong>Test Adı:</strong> {{ $question->get_test->test_name }}</p>
                                <p><strong>Ortak Metin:</strong> {{ $question->common_text ?? '-'}}</p>
                                <p><strong>Madde Kökü:</strong> {{ $question->root_text }}</p>
                                <p><strong>A Şıkkı:</strong> {{ $question->option_a ?? '-' }} </p>
                                <p><strong>B Şıkkı:</strong> {{ $question->option_b ?? '-' }}</p>
                                <p><strong>C Şıkkı:</strong> {{ $question->option_c ?? '-' }}</p>
                                <p><strong>D Şıkkı:</strong> {{ $question->option_d ?? '-' }}</p>
                                <p><strong>E Şıkkı:</strong> {{ $question->option_e ?? '-' }}</p>
                                <p><strong>Doğru Şık:</strong> {{ $question->option_true }}</p>
                                <p><strong>Metin Sentezleyici Aktif mi?:</strong> {{ $question->text_synthesize ? 'Evet' : 'Hayır' }}</p>
                                <p><strong>Durum:</strong> {{ $question->is_active ? 'Aktif' : 'Pasif' }}</p>
                                <p><strong>Kazanım:</strong> {{ $question->get_out_comes->learning_outcomes_name }}</p>
                                <p><strong>Bilişsel Düzey:</strong> {{ $question->get_cognitive->taksonomi_name }},{{ $question->get_cognitive->cognitive_name }}</p>
                                <p><strong>Modül:</strong> {{ $question->module }}</p>
                                <h6><strong>Parametreler:</strong></h6>
                                <ul>
                                <li><strong>Parametre A:</strong> {{ $question->parameter_a ?? '-' }}</li>
                                <li><strong>Parametre B:</strong> {{ $question->parameter_b ?? '-' }}</li>
                                <li><strong>Parametre C:</strong> {{ $question->parameter_c ?? '-' }}</li>
                                <li><strong>Parametre D:</strong> {{ $question->parameter_d ?? '-' }}</li>
                                </ul>
                                <h6><strong>Hangi Gruplarda Gösterilemez:</strong></h6>
                                <ul>
                                    @foreach($question_disabilities as $disability)
                                        <li>{{$disability->get_disability->name}}</li>

                                    @endforeach
                                </ul>

                                <a href="{{ route('question.edit', $question->question_id) }}" class="btn btn-primary">Madde Düzenle</a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

