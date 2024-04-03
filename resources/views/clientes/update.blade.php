@extends('layouts.app')
@section('content')
<div class="container">

Formulario para actualizar los datos del cliente
<form action="{{url('/cliente/'.$cliente->id)}}"method="POST" enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}
@include('clientes.form',['modo'=>'Actualizar']);
</form>
</div>
@endsection