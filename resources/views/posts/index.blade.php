@extends('layouts.app')
@section('content')
    <h3 class="my-4">Tout Les Fichiers :</h3>
    <?php $count = 0; ?>
    @if (count($posts) > 0)
    <div class="row justify-content-center py-3 px-2 my-3 files">
      @foreach ($posts as $post)
      <a href="/storage/files/{{$post->file}}" download="{{$post->file}}" class="col-sm-3 m-2 border shadow-sm">
          <div class="col-sm-12">
              <img src="./assets/images/download.jpg" alt="{{$post-> title}}" width="100%">
          </div>
          <div class="col-sm-12">
              <div class="text-center">
                  <h3>{{ $post -> title }}</h3>
                  {{-- <p class="py-2 text-muted text-center" id="post-body"><?php echo substr($post->body,0, 400) ?> <i class="fa fa-chevron-right bg-secondary text-white px-2 py-1 mx-2 rounded-circle"></i></p> --}}
                  <small class="text-right">Créé Le: {{ $post -> created_at }} Par {{$post->user->name}} </small>
              </div>
          </div>
        </a>
        @endforeach
      </div>
      <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }}
      </div>
    @else
      <p>No Posts Found!</p>
    @endif
@endsection

