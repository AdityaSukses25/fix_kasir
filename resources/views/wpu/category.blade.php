
@extends('layout.main')

@section('container')
    <h1 class="mb-5">Post Category : {{ $category }}</h1>

    @foreach ( $posts as $post )

        <h2> 
            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
        <h4>{{ $post->name }}</h4>
        <p>{{ $post->excerpt }}</p>

    @endforeach

@endsection