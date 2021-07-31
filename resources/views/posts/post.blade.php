@extends('layouts.app')
  @section('content')
      <a href="/posts" class="btn btn-secondary my-4"> Back </a>
      <h3> {{$post->title}} </h3>
      <div class="col-md-12 text-center my-3">
        <img src="/storage/coverImages/{{ $post -> cover_image }}" alt="{{$post->title}}" class="img-fluid" width="70%">
      </div>
      <div class="col-md-12">
        <p id="post-body" class="text-muted" style="width:100%;"> {!! $post -> body !!} </p>
        <small class="text-right form-text">Created at: {{ $post -> created_at }} by {{ $post->user->name }}</small>
      </div>
      <hr>
      @if (!Auth::guest())
        @if (Auth::user()->id == $post -> user_id)
          <div class="d-flex justify-content-between">
              <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>

              {!! Form::open(['action' =>['App\Http\Controllers\PostsController@destroy', $post-> id], 'method'=> 'POST', 'class'=> 'float-end']) !!}
                {{ Form::submit('Delete', ['class'=> 'btn btn-danger']) }}
                {{ Form::hidden('_method', 'DELETE') }}
              {!! Form::close() !!}
          </div>
        @endif
      @endif
  @endsection
