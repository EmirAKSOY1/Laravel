@extends('layouts.main')
@section('title','Anasayfa')
@section('menu')
    @auth
        <a href="{{ url('/welcome') }}">Giriş</a><br>
    @else
        <a href="{{ route('login') }}">Giriş Yap</a><br>

    @endauth

@endsection

@section('right-panel')
    <p><strong>Sistemde Ana sayfa duyurusu ekleme alanından yazılan içerik buraya gelir.</strong></p>
@endsection
