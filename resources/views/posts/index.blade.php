@extends('layouts.app')
@section('content')
    <h3 class="my-4">Posts</h3>
    <?php $count = 0; ?>
    @if (count($posts) > 0)
      @foreach ($posts as $post)
      <a href="/posts/{{ $post-> id }}">
        <div class="row border border-bottom border-default py-3 px-2 my-3">
          <div class="col-sm-4 col-md-4">
            <img src="/storage/coverImages/{{ $post->cover_image }}" alt="{{$post-> title}}" width="100%">
          </div>
          <div class="col-sm-8 col-md-8">
              <div>
                  <h3>{{ $post -> title }}</h3>
                  <small>Created at: {{ $post -> created_at }} by {{$post->user->name}} </small>
              </div>
          </div>
        </div>
      </a>
      @endforeach
      <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }}
      </div>
    @else
      <p>No Posts Found!</p>
    @endif
@endsection

