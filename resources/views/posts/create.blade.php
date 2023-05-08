@extends('layouts.app')
@section('content')
    <h1>Create New Post :</h1>
    {!! Form::open(['action' => '\App\Http\Controllers\PostsController@store', 'Method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
      <div class="form-group">
        {{ Form:: label('title', 'Title') }}
        {{ Form:: text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter post title']) }}
      </div>
      {{-- <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['id' => 'editor1', 'class' => 'form-control', 'placeholder' => 'Enter post body']) }}
      </div> --}}
      <div class="form-control my-2">
        {{ Form::file('file') }}
      </div>
      {{ Form:: submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection