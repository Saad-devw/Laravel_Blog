<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--  jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div id="app">
        @include('includes.navbar')

        <main class="py-4 container">
            @include('includes.messages')
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

            <script type="text/javascript">
                  $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
        
                  $('#search').on('keyup', function(){
                      var query = $(this).val();
        
                      $.ajax({
                          method:'POST',
                          url:"search",
                          data: JSON.stringify({
                            query:query
                          }),
                          headers:{
                              'Accept' : 'application/json',
                              'Content-Type' : 'application/json'
                          },
                          success:function(data){
                              // $('#files').html(data.table_data);
                              // $('#total_records').text(data.total_data);
                              console.log(data);
                          }
                      });
        
                      if(query == ''){
                          $('#count_records').css('display','none');
                      }
                      else{
                          $('#count_records').css('display','block');
                      }
                  })
          </script>
        </main>
    </div>
    
    @include('includes.footer')
</body>
</html>




