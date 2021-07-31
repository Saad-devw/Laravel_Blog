@extends('layouts.app')

@section('content')
    <div class="bg-light text-dark text-center mb-4">
      <h1>About Us :</h1>
    </div>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <p class="text-muted my-3">This a blog built with Laravel (PHP Framework) with full functionality Like:</p>
          <ul class="list-group text-center">
            <li class="list-group-item">Registration and Login</li>
            <li class="list-group-item">Password reset</li>
            <li class="list-group-item">creation of posts</li>
            <li class="list-group-item">Editing and Deleting posts</li>
          </ul>
          <p class="text-muted my-3">and you can consider this as a start up project to add more functionalities.</p>
          <p class="text-info text-right"><i>Happy Coding</i></p>
        </div>
      </div>
    </div>
@endsection