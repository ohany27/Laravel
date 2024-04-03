@extends('layouts.app')
@section('content')
<div class="container">
Lista datos de los pedidos <br>

<!-- Recibe la funcion mensaje desde el controller para mostrar un mensaje de confirmacion -->

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
    {{Session::get('mensaje')}}
    </div>
@endif


<a href="{{url('/pedido/create')}}" class="btn btn-success">Registrar nuevo pedido</a>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pedidos as $pedido)
        <tr>
            <td>{{$pedido->id_pedido}}</td>
            <td>{{$pedido->producto}}</td>
            <td>{{$pedido->precio}}</td>
            <td>{{$pedido->cliente->id}}</td>
            <td>{{$pedido->cliente->nombres}}</td>
            <td>{{$pedido->cliente->apellidos}}</td>
            <td>{{$pedido->cliente->correo}}</td>
          
            <td>
                <div class="d-flex">
                    <a href="{{url('/pedido/'.$pedido->id.'/edit')}}" class="btn btn-primary btn-sm mr-2">
                            Editar
                        </a> |

                    <form action="{{url('/pedido/'.$pedido->id)}}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type="submit" onclick="return confirm('¿Deseas Eliminar?')" value="Eliminar" class="btn btn-danger btn-sm">
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $pedidos->Links()!!}
</div>
@endsection
