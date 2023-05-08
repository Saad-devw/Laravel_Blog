@extends('layouts.app')
  @section('content')
      <a href="/posts" class="btn btn-secondary my-4"> Retour </a>
      <h3 class="text-center my-2 title"> {{$post->title}} </h3>
      <div class="col-md-12 text-center my-3">
        <embed src="/storage/files/{{$post->file}}" type="application/pdf" width="100%" height="700px">
      </div>
      <div class="col-md-12">
        <small class="text-right form-text">Créé le: {{ $post -> created_at }} Par {{ $post->user->name }}</small>
      </div>
      <hr>
      @if (!Auth::guest())
        @if (Auth::user()->id == $post -> user_id)
          <div class="d-flex justify-content-between">
              <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Modifier</a>

              {!! Form::open(['action' =>['App\Http\Controllers\PostsController@destroy', $post-> id], 'method'=> 'POST', 'class'=> 'float-end']) !!}
                {{ Form::submit('Supprimer', ['class'=> 'btn btn-danger']) }}
                {{ Form::hidden('_method', 'DELETE') }}
              {!! Form::close() !!}
          </div>
        @endif
      @endif
  @endsection
