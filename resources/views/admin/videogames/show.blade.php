@extends('layouts.app')
@section('title', 'Details')
@section('content')
    <div class="container mt-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="card p-4">
                <figure class="text-center">
                    <img src="{{ asset('storage/' . $videogame->image_url) }}" alt="{{ $videogame->title }}">
                </figure>
                <h1 class="mt-4 mb-3">{{ $videogame->title }}</h1>
                <div>{{ $videogame->platform }}</div>
                <p>{{ $videogame->description }}</p>
            </div>
            <a class="btn btn-primary w-25 mt-5" href="{{ route('admin.videogames.index') }}">Indietro</a>
        </div>
    </div>
@endsection
