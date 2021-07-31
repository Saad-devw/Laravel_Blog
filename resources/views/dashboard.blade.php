@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-info my-3">Add Post</a>
                    <!--{{ __('You are logged in!') }}-->
                    <h3>Your Posts :</h3>
                    @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action' =>['App\Http\Controllers\PostsController@destroy', $post-> id], 'method'=> 'POST', 'class'=> 'float-end']) !!}
                                            {{ Form::submit('Delete', ['class'=> 'btn btn-danger']) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="bg-light text-center py-3">No posts yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
