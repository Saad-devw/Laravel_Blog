@extends('layouts.app')
@section('content')
    <h1>Edit Post :</h1>
    {!! Form::open(['action' => ['\App\Http\Controllers\PostsController@update', $post->id], 'Method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
      <div class="form-group">
        {{ Form:: label('title', 'Title') }}
        {{ Form:: text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Enter post title']) }}
      </div>
      {{-- <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', $post->body, ['id' => 'editor1', 'class' => 'form-control', 'placeholder' => 'Enter post body']) }}
      </div> --}}
      {{ Form::hidden('_method', 'PUT') }}
      <div class="form-control">
        {{ Form::file('file') }}
      </div>
      <div class="d-flex justify-content-between my-3">
        {{ Form:: submit('Submit', ['class' => 'btn btn-primary']) }}
        <a href="/posts/{{ $post->id }}" class="btn btn-secondary">Cancel</a>
      </div>
    {!! Form::close() !!}
@endsection

