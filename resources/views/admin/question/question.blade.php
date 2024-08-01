
@auth
    @extends('layouts.navbar')
    @section('title',"Maddeler")
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
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 style="color:#4070f4">{{$test->test_name}} Maddeleri</h2>
                    <hr>
                    <br>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('question.create',$test->test_id) }}'">Yeni Madde Ekle</button>
                    <a type="button" class="btn btn-success"  onclick="window.location='{{ route('question.create',$test->test_id) }}'"><i class="fas fa-file-excel"></i> Excel Aktar</a>

                    @if(isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Madde Id</th>
                                <th>Madde</th>
                                <th>Alan</th>
                                <th>Kazanım</th>
                                <th>Bilişsel Düzey</th>
                                <th>Parametre(a,b)</th>
                                <th style="text-align: center">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr onclick="window.location='{{ route('question.detail', $question->question_id) }}'">
                                    <td>{{$question->question_id}}</td>
                                    <td>{{Str::limit($question->root_text, 20)}}</td>
                                    <td>{{$question->get_out_comes->subBranch->branch->branch_name}}</td>
                                    <td>{{ Str::limit($question->get_out_comes->learning_outcomes_name, 20) }}</td>
                                    <td>{{$question->get_cognitive->cognitive_name}}</td>
                                    <td>({{$question->parameter_a}},{{$question->parameter_b}})</td>
                                    <td>
                                        <a  href="{{ route('question.detail', $question->question_id) }}" type="button" class="btn btn-secondary"><i class="fa fa-info" aria-hidden="true"></i></a>
                                        <a href="{{ route('question.edit', $question->question_id) }}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('question.destroy', $question->question_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

