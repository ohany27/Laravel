@extends('layouts.app')
@section('content')
<div class="container">

Formulario para actualizar los datos de los pedidos
<form action="{{url('/pedido/'.$pedido->id)}}"method="POST" enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}
@include('pedidos.form',['modo'=>'Actualizar']);
</form>

</div>
@endsection

