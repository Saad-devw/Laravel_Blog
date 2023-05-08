@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center">
      <div class="w-50 d-flex align-items-center justify-content-center col-sm-8 p-2">
        <label class="text-muted">Chercher un fichier <i class="fa fa-search"></i></label>
        <input id="search" type="text" class="form-control shadow-sm border p-2 rounded-1 w-100" placeholder="Tapez ici..">
      </div>

      <div id="count_records" class="col-sm-4 p-2">
        <h6>Fichiers Trouvé : <strong id="total_records"></strong></h6> 
      </div>
    </div>

    <h3 class="my-4">Tout Les Fichiers :</h3>
    <?php $count = 0; ?>
    @if (count($posts) > 0)
    <div class="row justify-content-center py-3 px-2 my-3 files" id="files">
      @foreach ($posts as $post)
      <a href="/storage/files/{{$post->file}}" download="{{$post->file}}" class="col-sm-3 m-2 border shadow-sm">
          <div class="col-sm-12">
              <img src="./assets/images/download.jpg" alt="{{$post-> title}}" width="100%">
          </div>
          <div class="col-sm-12">
              <div class="text-center">
                  <h3>{{ $post -> title }}</h3>
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
    <script>
      $(document).ready(function(){
          fetch_factures_data();
          function fetch_factures_data(query = ''){
              $.ajax({
                  url:"{{ route('posts.search') }}",
                  method:'GET',
                  data:{query:query},
                  dataType:'json',
                  success:function(data){
                      $('#files').html(data.table_data);
                      $('#total_records').text(data.total_data);
                  }
              });
  
              if(query == ''){
                  $('#count_records').css('display','none');
              }
              else{
                  $('#count_records').css('display','block');
              }
          }
  
          $(document).on('keyup', '#search', function(){
              var query = $(this).val();
              fetch_factures_data(query);
          })
      });
  </script>
@endsection

