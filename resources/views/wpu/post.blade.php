@extends('layout.main')

@section('container')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>{{ $post->title }}</h2>
            <p class="">By, {{ $post->user->name }} in <a href=/categories/{{ $post->category->slug }}>{{ $post->category->name }}</a></p>
            @if ($post->image)
            <div class="img" style="max-height: 350px; overflow: hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-fluid">
            </div>
            @else
            <div class="img">
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="" class="img-fluid">
            </div>
            @endif
            <article>
            {!!  $post->body !!}
        </article>
        <a href="/blog">Back to the moon</a>
        </div>
    </div>
</div>

@endsection

