@extends('layouts.main')

@section('title','Giriş Yap')

@section('icerik')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
    <form action="{{route('login')}}"method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Şifre</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Beni Hatırla</label>
        </div>
        <button type="submit" class="btn btn-primary">Giriş Yap</button>
    </form>
@endsection


