@extends('layouts.app')

@section('content')
    <div class="py-5 text-center">
      <h1>Welcome To Laravel</h1>
      <p>This is laravel application , designed by saad essadiki</p>
      @if (!Auth::check())
        <p><a href="/login" class="btn btn-primary btn-lg">Login</a> <a href="/register" class="btn btn-success btn-lg">Register</a></p>
      @else
        <h6 class="mt-5 bg-success p-3 rounded text-light shadow-lg">Bonjour, : {{ Auth::user()->name }} / {{ Auth::user()->email }}</h6>
      @endif
    </div>
@endsection
