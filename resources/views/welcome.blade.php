@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 class="my-5">BoolGaming Back Office</h1>
        <a class="btn btn-primary" href="{{ route('admin.videogames.index') }}">{{ __('Videogames List') }}</a>
    </div>
</div>
@endsection