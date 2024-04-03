@extends('layouts.app')
@section('content')
<div class="container">

Formulario para crear clientes
<form action="{{url('/cliente')}}" method="POST" enctype="multipart/form-data">
@csrf
@include('clientes.form',['modo'=>'Guardar']);
</form>
</div>
@endsection

