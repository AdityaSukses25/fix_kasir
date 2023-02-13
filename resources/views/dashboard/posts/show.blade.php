@extends('dashboard.layout.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
        <h2>{{ $post->title }}</h2>

        <a href="/dashboard/posts" class="btn btn-success"><span  data-feather="arrow-left"></span> Back to my posts</a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span  data-feather="edit"></span> Edit</a>
        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('are you sure?')"><span data-feather="x-circle"></span> Delete</a></button>
                  </form>
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