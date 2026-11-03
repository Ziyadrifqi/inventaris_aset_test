@extends('layouts.app')
@section('content')
    <h1 class="h4">Selamat datang, {{ auth()->user()->name }}</h1>
@endsection
