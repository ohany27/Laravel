@extends('layouts.app')
@section('content')
<div class="container">

Lista datos de los clientes

<!-- Recibe la funcion mensaje desde el controller para mostrar un mensaje de confirmacion -->

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
    {{Session::get('mensaje')}}
    </div>
@endif
<br>
<a href="{{url('/cliente/create')}}" class="btn btn-success" >Registrar nuevo cliente</a>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $datos)
        <tr>
            <td>{{$datos->id}}</td>
            <td>{{$datos->nombres}}</td>
            <td>{{$datos->apellidos}}</td>
            <td>{{$datos->correo}}</td>
            <td><img src="{{asset('storage').'/'.$datos->foto}}" width="80" height="100"> </td>
            <td>
                <div class="d-flex">
                    <a href="{{url('/cliente/'.$datos->id.'/edit')}}" class="btn btn-primary btn-sm mr-2">
                        Editar
                    </a>
                    |
                    <form action="{{url('/cliente/'.$datos->id)}}" method="POST" onsubmit="return confirm('¿Deseas Eliminar?')" class="mr-2">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
{!! $clientes->Links()!!}
</div>
@endsection