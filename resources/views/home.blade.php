@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @auth
            <h3> Bienvenido {{ Auth::user()->nombreCompleto }}</h3>
        @else
            @include('auth.login');
        @endauth

    </div>
</div>
@endsection
