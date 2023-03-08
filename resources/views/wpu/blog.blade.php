
@extends('layout.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/blog">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('user'))
                <input type="hidden" name="user" value="{{ request('user') }}">
            @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
                    <button class="input-group-text" id="basic-addon2" type="submit">Search</button>
                </div>
        </form>
        </div>
    </div>
    @if ($posts->count())
    <div class="card mb-3">
        @if ($posts[0]->image)
            <div class="img" style="max-height: 350px; overflow: hidden;">
                <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="" class="img-fluid">
            </div>
        @else
            <div class="img">
                <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" alt="" class="img-fluid">
            </div>
        @endif

    <div class="card-body text-center">
        <h5 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
        <p>
            <small class="text-muted">
            By, <a href=/blog?user={{ $posts[0]->user->username }} class="text-decoration-none">{{   $posts[0]->user->name   }}</a>  in <a href='/blog?category={{ $posts[0]->category->slug  }}' class='text-decoration-none'>{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
            </small>
        </p>
        <p class="card-text">{{ $posts[0]->excerpt }}</p>
        <a href="/posts/{{ $posts[0]->slug }}" class='text-decoration-none btn btn-primary'>Read more</a>
    </div>
    </div>
    
    
    <div class="container justify-content-center">
        <div class="row">
            @foreach( $posts->skip(1) as $post )
            <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
            <div class="card">
                    <div class=" px-3 py-2 text-white bg-dark position-absolute" style="background-color: rgba(0, 0, 0, 0.6)"><a href="/blog?category={{ $post->category->slug  }}" class="text-decoration-none text-white">{{ $post->category->name }}</a></div>
                    @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-fluid">
                    @else
                        <div class="img">
                            <img src="https://source.unsplash.com/500x500?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                        </div>
                    @endif

                </div>
            
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p>
                    <small class="text-muted">
                    By, <a href=/blog?user={{ $post->user->username }} class="text-decoration-none">{{   $post->user->name   }}</a> {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{{ $post["excerpt"] }}</p>
                <a href="/posts/{{ $post->slug }}" class='text-decoration-none btn btn-primary'>Read more</a>
            </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
        <p class="text-center fs-4">No post found.</p>
    @endif

    <div class="page d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    
@endsection