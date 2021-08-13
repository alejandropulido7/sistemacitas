@extends('inventario.index')
    
@section('inventario')
<div class="container">
    <div class="row">
      <div class="col-sm-12"> 
    <ul class="nav-inv nav nav-tabs nav-justified mb-5">
        <li class="nav-item">
        <a class="nav-link active" href="{{ url('/inventario')}}">Inventario</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/productos')}}">Produtos</a>
        </li>
    </ul>
    </div> 
    </div> 
</div>
@endsection