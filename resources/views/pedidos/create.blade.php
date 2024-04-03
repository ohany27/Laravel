@extends('layouts.app')
@section('content')
<div class="container">
Formulario para crear pedidos
<form action="{{url('/pedido')}}"method="POST" enctype="multipart/form-data">
@csrf
@include('pedidos.form',['modo'=>'Guardar']);
</form>
</div>
@endsection

