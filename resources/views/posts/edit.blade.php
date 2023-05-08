@extends('layouts.app')
@section('content')
    <h1>Modifier Fichier :</h1>
    {!! Form::open(['action' => ['\App\Http\Controllers\PostsController@update', $post->id], 'Method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}
      <div class="form-group">
        {{ Form:: label('title', 'Titre') }}
        {{ Form:: text('title', $post->title, ['class' => 'form-control shadow-none', 'placeholder' => 'Enter post title']) }}
      </div>
      {{-- <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', $post->body, ['id' => 'editor1', 'class' => 'form-control', 'placeholder' => 'Enter post body']) }}
      </div> --}}
      {{ Form::hidden('_method', 'PUT') }}
      <div class="form-group">
        {{ Form:: label('file', 'Fichier') }}
        {{ Form::file('file', ['class' => 'form-control shadow-none']) }}
      </div>
      {{-- <div class="my-3">
        <embed src="/storage/files/{{$post->file}}" type="application/pdf" width="100%" height="700px">
      </div> --}}
      <div class="d-flex justify-content-between my-3"> 
        {{ Form:: submit('Submit', ['class' => 'btn btn-primary']) }}
        <a href="/posts/{{ $post->id }}" class="btn btn-secondary">Annuler</a>
      </div>
    {!! Form::close() !!}
@endsection

